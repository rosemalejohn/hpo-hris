<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use Validator;
use App\Employee;
use App\Shift;
use DateTime;
use App\EmployeeDtr;

class ExcelController extends Controller
{

    protected $collection;
    protected $cell;
    protected $employee;
    protected $employee_shift;

    protected $shift;

    public function getImport(){
        $page_title = 'Facetime import';
        return view('dtr.import')->with(compact('page_title'));
    }

    public function getAll(){
        $page_title = 'Employee Logs';
        return view('dtr.all')->with(compact('page_title'));
    }

    public function postImport(Request $request){
        $validator = Validator::make($request->all(), [
                'file' => 'required'  //Excel file validation not yet done for mimes
        ]);

        if($request->hasFile('file') && !$validator->fails() && $request->file('file')->isValid()){
            $file = $request->file('file');
            $filename = $this->nameFile($file->getClientOriginalName());
            $file->move(storage_path('files'), $filename);

            $this->getData(storage_path('files'.'/'.$filename));
            $this->setLogs();

            flash()->success('Import was successful. Employee logs saved to database.');
            return redirect()->back();
        } else{
            flash()->error('Oopss! There is something wrong with your files.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    protected function isLast($data, $index){
        return (count($data)-1) == $index;
    }

    public function store($userID, $date, $attendances){
        $start_time = $this->shift->first()->first()['start_time'];

        $late = 0;
        if($start_time < $attendances->first()){
            $late = date_diff(new DateTime($start_time), new DateTime($attendances->first()));
        }
        dd($late);

        $day = date('D', strtotime($attendances->first()));

        EmployeeDtr::create([
            'employee_id' => $userID,
            'start_of_duty' => $date.' '.$attendances->first(),
            'end_of_duty' => $date.' '.$attendances->last(),
            'first_out' => (empty($attendances[1]) || $this->isLast($attendances, 1) ? null : $date.' '.$attendances[1]),
            'first_in' => (empty($attendances[2]) || $this->isLast($attendances, 2) ? null : $date.' '.$attendances[2]),
            'second_out' => (empty($attendances[3]) || $this->isLast($attendances, 3) ? null : $date.' '.$attendances[3]),
            'second_in' => (empty($attendances[4]) || $this->isLast($attendances, 4) ? null : $date.' '.$attendances[4]),
            'third_out' => (empty($attendances[5]) || $this->isLast($attendances, 5) ? null : $date.' '.$attendances[5]),
            'third_in' => (empty($attendances[6]) || $this->isLast($attendances, 6) ? null : $date.' '.$attendances[6]),
            'late' => ''
        ]);
    }

    protected function getData($filepath){
        $excelPath = $filepath;
        $this->collection = collect();

        Excel::selectSheets('Sheet1')->load($excelPath, function($reader){
            $reader->noHeading();
            $reader->formatDates(false);

            $reader->get()->each(function($cell){
                $this->cell = $cell;
                $datas = [
                    'user' => $cell[0],
                    'date' => $cell[3],
                    'attendance' => value(function(){
                        $attendance = collect();
                        for($i = 4; $i<14; $i++){
                            if(empty($this->cell[$i])){
                                break;
                            } else{
                                $attendance->push($this->cell[$i]);
                            }
                        }
                        return $attendance;
                    })
                ];

                $this->collection->push($datas);
            });
        });

        $this->collection = $this->collection->groupBy('user')->values()->all();

        return $this->collection;
    }

    protected function nameFile($filename){
        $newFileName = strtolower(date('Y-m-d-H-i-s')).$filename;
        return $newFileName;
    }

    protected function setLogs(){
        foreach($this->collection as $employees){
            $userID = $employees->first()['user'];
            $employee = Employee::where('employee_id', $userID)->first();
            $this->getShift($employee);

            foreach($employees as $user){
                $date = $user['date'];
                $attendances = $user['attendance'];

                if(empty($employee)){
                    break;
                }else{

                    switch(count($attendances)){
                        case 8:
                            $this->store($userID, $date, $attendances);
                            break;
                        case 6:
                            $this->store($userID, $date, $attendances);
                            break;
                        case 4:
                            $this->store($userID, $date, $attendances);
                            break;
                        case 2:
                            $this->store($userID, $date, $attendances);
                            break;
                    }
                }
            }
        }
    }

    protected function getShift($employee){
        // $employee = Employee::with('shifts')->get();
        // dd($employee);

        $this->employee = $employee;
        $shift = collect([
            'shifts' => value(function(){
                $shifts = collect();
                foreach($this->employee->employee_shifts()->orderBy('date_from', 'desc')->get() as $employee_shift){
                    $this->employee_shift = $employee_shift;
                    $shifts->push([
                        'description' => $employee_shift->shift->description,
                        'start_time' => $employee_shift->shift->shift_from,
                        'end_time' => $employee_shift->shift->shift_to,
                        'days' => value(function(){
                            $days = collect();
                            foreach($this->employee_shift->employee_shift_days as $day){
                                $days->push($day->day);
                            }
                            return $days;
                        })
                    ]);
                }
                return $shifts;
            })
        ]);

        $this->shift = $shift;

    }
}
