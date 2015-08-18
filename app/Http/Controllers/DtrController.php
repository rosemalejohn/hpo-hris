<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    //
    public function index(){
        $page_title = 'Employee Logs';
        return view('dtr.all')->with(compact('page_title'));
    }

    public function getImport(){
        $page_title = 'Facetime import';
        return view('dtr.import')->with(compact('page_title'));
    }

    public function postImport(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx'  //Excel file validation not yet done for mimes
        ]);

        if($request->hasFile('file') && !$validator->fails() && $request->file('file')->isValid()){
            $file = $request->file('file');
            $filename = $this->nameFile($file->getClientOriginalName());
            $file->move(storage_path('files'), $filename);
            
            $this->setLogs($this->getData(storage_path('files'.'/'.$filename)));

            flash()->success('Import was successful. Employee logs saved to database.');
            return redirect()->back();
        } else{
            flash()->error('Oopss! Your file type is unknown. Please upload excel file only!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function store($user, $shifts){
        //Declare variables
        $userID = $user['user'];
        $date = $user['date'];
        $attendances = $user['attendance'];
        $late = 0;
        $undertime = 0;
        $overbreak = 0;
        $total_overbreaks = new DateTime('00:00:00');

        foreach($shifts->first() as $shift){

            if(($date >= $shift['date_from']) && ($date <= $shift['date_to'])){ //check if the date is between the date_from where the shift started and shift ended

                $start_time = $shift['start_time']; //get the shift start time
                $end_time = $shift['end_time']; //get the shift end time

                //foreach($shift['days'] as $day){ //loop through days in the shift
                //    if($day->day == strtolower(date('D', strtotime($date)))){ //check if the date day is equal to the shift day
                        $data = [
                            'employee_id' => $userID, //employee biometric id
                            'start_of_duty' => $date.' '.$attendances->first(), //start of duty in one day
                            'end_of_duty' => $date.' '.$attendances->last(), //end of duty

                            //employee breaks in a day
                            'first_out' => (empty($attendances[1]) || $this->isLast($attendances, 1) ? null : $date.' '.$attendances[1]),
                            'first_in' => (empty($attendances[2]) || $this->isLast($attendances, 2) ? null : $date.' '.$attendances[2]),
                            'second_out' => (empty($attendances[3]) || $this->isLast($attendances, 3) ? null : $date.' '.$attendances[3]),
                            'second_in' => (empty($attendances[4]) || $this->isLast($attendances, 4) ? null : $date.' '.$attendances[4]),
                            'third_out' => (empty($attendances[5]) || $this->isLast($attendances, 5) ? null : $date.' '.$attendances[5]),
                            'third_in' => (empty($attendances[6]) || $this->isLast($attendances, 6) ? null : $date.' '.$attendances[6])
                        ];

                        if($start_time < $attendances->first()){ //check if the employee is late
                            $late = computeTimeInterval($start_time, $attendances->first())->format("%H:%I:%S");
                        }

                        if($attendances->last() < $end_time){ //check if the employee has undertime
                            $undertime = computeTimeInterval($attendances->last(), $end_time)->format("%H:%I:%S");
                        }

                        if($shift['working_hours'] == '08:00:00'){ //check if the employee_shift working hrs is 8 hrs
                            //compute the overbreak
                            //if the employee working hrs is 8hrs then the break is only 30minutes
                            $total_overbreaks->add(computeBreaks($data['first_out'], $data['first_in'], '00:30:00'));
                            $total_overbreaks->add(computeTimeInterval($data['second_out'], $data['second_in']));
                            $total_overbreaks->add(computeTimeInterval($data['third_out'], $data['third_in']));

                        } elseif($shift['working_hours'] == '09:00:00'){ //check if the employee_shift working hrs is 8 hrs
                            $total_overbreaks->add(computeBreaks($data['first_out'], $data['first_in'], '00:15:00'));
                            $total_overbreaks->add(computeBreaks($data['second_out'], $data['second_in'], '01:00:00'));
                            $total_overbreaks->add(computeBreaks($data['third_out'], $data['third_in'], '00:15:00'));
                        }
                        //add the late, undertime and overbreak into the data array
                        $data = array_add($data, 'late', $late);
                        $data = array_add($data, 'undertime', $undertime);
                        $data = array_add($data, 'overbreak', $total_overbreaks->format('H:i:s'));
                        // insert the data array into the create method and save to the database
                        EmployeeDtr::create($data);
                        break;
                //    }
                //}
            }
        }
    }

    protected function isLast($data, $index){
        return (count($data)-1) == $index;
    }

    protected function getData($filepath){
        $excelPath = $filepath;
        $collection = collect();

        Excel::selectSheets('Sheet1')->load($excelPath, function($reader) use($collection){
            $reader->noHeading();
            $reader->formatDates(false);

            $reader->get()->each(function($cell) use($collection){
                $datas = collect([
                    'user' => $cell[0],
                    'date' => $cell[3],
                    'attendance' => value(function() use($cell){
                        $attendance = collect();
                        for($i = 4; $i<14; $i++){
                            if(empty($cell[$i])){
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

    protected function nameFile($filename){
        $newFileName = strtolower(date('Y-m-d-H-i-s')).$filename;
        return $newFileName;
    }

    protected function setLogs($collection){
        foreach($collection as $employees){
            $userID = $employees->first()['user'];
            $employee = Employee::where('employee_id', $userID)->first();
            foreach($employees as $user){
                $date = $user['date'];
                $attendances = $user['attendance'];

                if(empty($employee)){
                    break;
                }else{
                    if($employee->shifts->count() == 0){ //check if the employee has available shifts
                        break;
                    } else{
                        if((count($attendances) % 2) == 0){ //check if attendance count is even
                            $this->store($user, $this->getShift($employee));
                        }
                    }
                }
            }
        }
    }

    protected function getShift($employee){ //collect all the data required to compute the employee logs
        $shift = collect([
            'shifts' => value(function() use($employee){
                $shifts = collect();
                foreach($employee->employee_shifts()->orderBy('date_from', 'desc')->get() as $employee_shift){
                    $shifts->push([
                        'description' => $employee_shift->shift->description,
                        'start_time' => $employee_shift->shift->shift_from,
                        'end_time' => $employee_shift->shift->shift_to,
                        'break' => $employee_shift->shift->break,
                        'working_hours' => $employee_shift->shift->working_hours,
                        'date_from' => $employee_shift->date_from,
                        'date_to' => $employee_shift->date_to,
                        'days' => $employee_shift->employee_shift_days
                    ]);
                }
                return $shifts;
            })
        ]);
        return $shift;
    }

    public function exportToExcel(){
        $path = storage_path('files/DTRTemplates/dtrsummary.xlsx'); //Path of the excel template to be loaded

        Excel::load($path, function($reader){ //load the excel file
            $raw_sheet = $reader->sheet('raw'); //select the raw sheet of the excel file
            
            $rawSheetIndex = 1;

            $staffname = null;

            foreach(EmployeeDtr::all() as $employee_dtr){ //get the employee logs within the provided days
                if($staffname != $employee_dtr->employee->first_name.' '.$employee_dtr->employee->middle_name.' '.$employee_dtr->employee->last_name){
                    $rawSheetIndex = $rawSheetIndex + 2;
                }
                //assign the data to the variables
                $staffname = $employee_dtr->employee->first_name.' '.$employee_dtr->employee->middle_name.' '.$employee_dtr->employee->last_name;
                $date = date('Y-m-d', strtotime($employee_dtr->start_of_duty));
                $login = date('H:i:s', strtotime($employee_dtr->start_of_duty));
                $logout = date('H:i:s', strtotime($employee_dtr->end_of_duty));
                $late = $employee_dtr->late;
                $undertime = $employee_dtr->undertime;

                //add a new row and put all the gathered datas
                $row = $raw_sheet->appendRow($rawSheetIndex, [
                    $staffname, $date, $login, $logout, '', '', $late, '', $undertime
                ]);
                ++$rawSheetIndex; //increment the index to know what row are we
            }

            $summarySheetIndex = 3;
            $summary_sheet = $reader->sheet('summary'); //select the summary sheet of the excel file

            foreach(Employee::with('employee_dtrs')->get() as $employee){
                $staffcode = $employee->employee_id;
                $staffname = $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name;
                $computations = value(function() use($employee){
                    $late = new DateTime('00:00:00');
                    $undertime = new DateTime('00:00:00');
                    $overbreak = new DateTime('00:00:00');
                    $hrs_worked = new DateTime('00:00:00');

                    foreach($employee->employee_dtrs as $dtr){
                        $late->add(computeTimeInterval($dtr->late, '00:00:00'));
                        $undertime->add(computeTimeInterval($dtr->undertime, '00:00:00'));
                        $overbreak->add(computeTimeInterval($dtr->overbreak, '00:00:00'));
                        $hrs_worked->add(computeTimeInterval($dtr->end_of_duty, $dtr->start_of_duty));
                    }

                    //return an array with employee late, undertime, overbreak and hrs_worked value
                    return [
                        'late' => date_diff($late, new DateTime('00:00:00'))->format("%d days %h hrs, %i min, %s sec"),
                        'undertime' => date_diff($undertime, new DateTime('00:00:00'))->format("%d days %h hrs, %i min, %s sec"),
                        'overbreak' => date_diff($overbreak, new DateTime('00:00:00'))->format("%d days %h hrs, %i min, %s sec"),
                        'hrs_worked' => date_diff($hrs_worked, new DateTime('00:00:00'))->format("%d days %h hrs, %i min, %s sec")
                    ];
                });

                //add a new row and put all the gathered datas
                $row = $summary_sheet->appendRow($summarySheetIndex, [
                    $staffcode, $staffname, $computations['late'], $computations['undertime'], '', $computations['hrs_worked']
                ]);
                ++$summarySheetIndex; //increment the index to know what row are we
            }
        })->download('xlsx'); //download the excel file
    }

}