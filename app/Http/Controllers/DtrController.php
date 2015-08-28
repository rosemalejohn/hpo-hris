<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ErrorException;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use Date;
use DateTime;
use App\Employee;
use App\EmployeeDtr;
use Validator;

class DtrController extends Controller
{
    protected $date_from = null;

    protected $date_to = null;
    //
    public function index()
    {
        $page_title = 'dtr';
        $data = 'Daily Time Record';
        return view('dtr.all')->with(compact('page_title', 'data'));
    }

    public function getImport()
    {
        $page_title = 'dtr-import';
        $data = 'Import DTR';
        return view('dtr.import')->with(compact('page_title', 'data'));
    }

    public function postImport(Request $request) //Import the excel file
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls',
            'date_from' => 'required',
            'date_to' => 'required'
        ]); //validates the excel file extension

        if (!$validator->fails() && $request->file('file')->isValid()) { //if validation is OK
            $file = $request->file('file'); //get the requested file
            $this->date_from = $request->date_from; 
            $this->date_to = $request->date_to;

            $filename = $this->nameFile($file->getClientOriginalName()); //name the file
            $file->move(storage_path('app/imports'), $filename); //move the imported file to the storage path
            try {
                $this->setLogs($this->getData(storage_path('app/imports/'.$filename)));
            } catch (ErrorException $ex) {
                flash()->error('An error occured. Check the excel file and try again.');
                return redirect()->back();
            }
            flash()->success('Import was successful. Employee logs saved to database.');
            return redirect()->back();
        } else {
            flash()->error('Oopss! Your file type is unknown. Please upload excel file only!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function store($user, $shifts) //store the logs into the database
    {
        $userID = $user['user']; //biometric ID
        $date = $user['date']; //attendance date
        $attendances = $user['attendance'];
        $late = 0;
        $undertime = 0;
        $total_overbreaks = new DateTime('00:00:00');

        foreach ($shifts as $shift) {
            
            if (($date >= $shift->pivot->date_from) && ($date <= $shift->pivot->date_to)) { //check if the date is between the date_from where the shift started and shift ended

                $start_time = $shift->shift_from; //get the shift start time
                $end_time = $shift->shift_to; //get the shift end time
                
                if ($shift->pivot->employee_shift_days->contains('day', strtolower(date('D', strtotime($date))))) {
                    $attendance_log_count = count($attendances);
                    $remarks = null;
                    $allowedBreaks = [];
                    $break_out = []; 
                    $break_in = [];

                    if ($attendances == null) {
                        $start_of_duty = '00:00:00';
                        $end_of_duty = '00:00:00';
                    } else {
                        $start_of_duty = $attendances->shift();
                        $end_of_duty = $attendances->pop();
                    }
                    
                    $data = ['employee_id' => $userID, 'start_of_duty' => $date.' '.$start_of_duty, 'end_of_duty' => $date.' '.$end_of_duty];
                    $break_key = ['first_out', 'first_in', 'second_out', 'second_in', 'third_out', 'third_in'];
                    $breaks = [];

                    $data = array_add($data, 'shift_id', $shift->id);

                    if ($attendances != null) {
                        foreach ($attendances as $key => $attendance) {
                            try {
                                $breaks = array_add($breaks, $break_key[$key], $attendance); 
                            } catch(ErrorException $ex) {
                                
                            }
                        }

                        if ($start_time < $start_of_duty) { //check if the employee is late
                            $employee = Employee::where('employee_id', $userID)->first();
                            $late = computeTimeInterval($start_time, $start_of_duty)->format("%H:%I:%S");
                            if ($employee->department->isKiniteque()) {
                                if($late < '00:16:00'){
                                    $late = "00:00:00";
                                }
                            }
                            $data = array_add($data, 'late', $late);
                        }
                        if ($end_of_duty < $end_time) { //check if the employee has undertime
                            $data = array_add($data, 'undertime', computeTimeInterval($end_of_duty, $end_time)->format("%H:%I:%S"));
                        }

                        foreach (array_flatten($breaks) as $key => $break) {
                            if ($key % 2 == 0) {
                                $break_out = array_add($break_out, $key, $break);
                            } else {
                                $break_in = array_add($break_in, $key - 1, $break);
                            }
                        }

                        if ($shift->working_hours == '08:00:00') {
                            $allowedBreaks = [0 => '00:30:00'];
                        } elseif ($shift->working_hours == '09:00:00') {
                            $allowedBreaks = [0 => '00:15:00', 2 => '01:00:00', 4 => '00:30:00'];
                        }

                        if ($shift->shift_to < $shift->shift_from) {
                            $data = array_add($data, 'remarks', 'Graveyard shift');
                        } else {
                            if ($attendance_log_count % 2 == 0) {
                                foreach($break_out as $key => $out){
                                    try{
                                        $total_overbreaks->add(computeBreaks($out, $break_in[$key], $allowedBreaks[$key]));
                                    }catch(ErrorException $ex){
                                        $total_overbreaks->add(computeTimeInterval($out, $break_in[$key]));
                                    }
                                }
                            } else {
                                $remarks = $remarks.' ODDLogs';
                                $data = array_add($data, 'remarks', $remarks);
                            }
                        }

                        $data = array_add($data, 'overbreak', $total_overbreaks->format('H:i:s'));
                        
                        // insert the data array into the create method and save to the database
                        foreach ($breaks as $value => $break) {
                            $data = array_add($data, $value, $date.' '.$break);
                        }
                    } else {
                        $data = array_add($data, 'remarks', 'ABSENT');
                    }

                    try {
                        EmployeeDtr::create($data);
                    } catch(QueryException $ex) {
                        return false;
                    }
                    return true;
                }
            }
        }
        
    }

    protected function getData($filepath)
    {
        $excelPath = $filepath;
        $collection = collect();

        Excel::selectSheets('Sheet1')->load($excelPath, function($reader) use($collection) {
            $reader->noHeading();
            $reader->formatDates(false);

            $reader->get()->each(function($cell) use($collection) {
                $datas = collect([
                    'user' => $cell[0],
                    'date' => $cell[3],
                    'attendance' => value(function() use($cell) {
                        $attendance = collect();
                        for($i = 4; $i<14; $i++) {
                            if (empty($cell[$i])) {
                                break;
                            } else{
                                $attendance->push($cell[$i]);
                            }
                        }
                        return $attendance;
                    })
                ]);
                $collection->push($datas);
            });
        });

        $collection = $collection->groupBy('user')->values()->all();
        return $collection;
    }

    protected function nameFile($filename) //naming the file method
    {
        $newFileName = strtolower(date('Y-m-d-H-i-s')).$filename;
        return $newFileName;
    }

    protected function setLogs($collection) //set the logs
    {
        foreach ($collection as $employees) {
            $userID = $employees->first()['user'];
            $employee = Employee::where('employee_id', $userID)->first();
            $currentDate = $this->date_from;
            $datesArray = [];

            $index = 0;
            do { //detecting absenses
                try {
                    $user = $employees[$index];
                    if (empty($employee)) {
                        break;
                    } else {
                        if (!$employee->shifts->isEmpty()) {
                            if ($currentDate != $user['date']) {
                                $newUser['user'] = $userID;
                                $newUser['date'] = $currentDate;
                                $newUser['attendance'] = null;
                                $this->store($newUser, $employee->shifts);
                                $currentDate = incrementDateByOneDay($currentDate);
                            } elseif ($currentDate == $user['date']) {
                                $this->store($user, $employee->shifts);
                                ++$index;
                                $currentDate = incrementDateByOneDay($currentDate);
                            }
                        } else {
                            break;
                        }
                    }
                } catch (ErrorException $ex) {
                    $newUser['user'] = $userID;
                    $newUser['date'] = $currentDate;
                    $newUser['attendance'] = null;
                    $this->store($newUser, $employee->shifts);
                    $currentDate = incrementDateByOneDay($currentDate);
                }
            } while ($currentDate <= $this->date_to);
        }
    }

    public function exportToExcel() //write to excel and export the file for download
    {
        $path = storage_path('app/DTRTemplates/DTRSummary.xlsx'); //Path of the excel template to be loaded

        Excel::load($path, function($reader) { //load the excel file
            $raw_sheet = $reader->sheet('raw'); //select the raw sheet of the excel file
            $summary_sheet = $reader->sheet('summary'); //select the summary sheet of the excel file
            $rawSheetIndex = 1;
            $summarySheetIndex = 3;

            $employees = Employee::has('employee_dtrs')->with('employee_dtrs', 'shifts')->orderBy('last_name')->get();

            foreach ($employees as $employee) { //get the employee logs within the provided days
                $rawSheetIndex = $rawSheetIndex + 2;
                $staffcode = $employee->employee_id;
                $staffname = strtoupper($employee->last_name).', '.$employee->first_name;

                $computations = value(function() use($employee) {
                    $late = new DateTime('00:00:00');
                    $undertime = new DateTime('00:00:00');
                    $overbreak = new DateTime('00:00:00');
                    $hrs_worked = new DateTime('00:00:00');

                    foreach ($employee->employee_dtrs as $dtr) {
                        $late->add(computeTimeInterval($dtr->late, '00:00:00'));
                        $undertime->add(computeTimeInterval($dtr->undertime, '00:00:00'));
                        $overbreak->add(computeTimeInterval($dtr->overbreak, '00:00:00'));
                        $hrs_worked->add(computeTimeInterval($dtr->end_of_duty, $dtr->start_of_duty));
                    }

                    //return an array with employee late, undertime, overbreak and hrs_worked value
                    return [
                        'late' => toMinutes(date_diff($late, new DateTime('00:00:00'))),
                        'undertime' => toMinutes(date_diff($undertime, new DateTime('00:00:00'))),
                        'overbreak' => toMinutes(date_diff($overbreak, new DateTime('00:00:00'))),
                        'hrs_worked' => toHours(date_diff($hrs_worked, new DateTime('00:00:00')))
                    ];
                });

                //add a new row and put all the gathered datas
                $row = $summary_sheet->appendRow($summarySheetIndex, [
                    $staffcode, $staffname, $computations['late'], $computations['undertime'],$computations['overbreak'] , '', $computations['hrs_worked']
                ]);
                ++$summarySheetIndex;

                foreach ($employee->employee_dtrs as $employee_dtr) {
                    // dd($employee_dtr);
                    //assign the data to the variables
                    $date = date('Y-m-d', strtotime($employee_dtr->start_of_duty));
                    $login = date('H:i:s', strtotime($employee_dtr->start_of_duty));
                    $logout = date('H:i:s', strtotime($employee_dtr->end_of_duty));
                    $late = $employee_dtr->late;
                    $undertime = $employee_dtr->undertime;

                    $lateToMinutes = stringToMinutes($late);
                    $undertimeToMinutes = stringToMinutes($undertime);

                    $shift_from = $employee_dtr->shift->shift_from;
                    $shift_to = $employee_dtr->shift->shift_to;
                    
                    if ($lateToMinutes > 200 && $lateToMinutes < 240) {
                        $lateToMinutes = 240;
                    }
                    if ($undertimeToMinutes > 200 && $undertimeToMinutes < 240) {
                        $undertimeToMinutes = 240;
                    }
                    //add a new row and put all the gathered datas
                    if ($employee_dtr->remarks == 'ABSENT') {
                        $login = 'ABSENT';
                        $logout = 'ABSENT';
                        $lateToMinutes = 480;
                    }
                    $row = $raw_sheet->appendRow($rawSheetIndex, [
                        $staffname, $date, $login, $logout, $shift_from, $shift_to, $late, $lateToMinutes, $undertime, $undertimeToMinutes, null, $employee_dtr->remarks
                    ]);
                    $staffname = null;
                    ++$rawSheetIndex; //increment the index to know what row are we
                }
            }
        })->download('xlsx'); //download the excel file
    }

    public function deleteAll()
    { //Clear and delete all the Employee DTR Logs. Delete the entire model
        if (EmployeeDtr::count() == 0) {
            flash()->success('DTR Logs already empty!');
        } else {
            EmployeeDtr::with('id')->delete();
            flash()->success('DTR Logs all cleared!');
        }
        return redirect()->back();
    }

}
