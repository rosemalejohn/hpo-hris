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

            $this->setLogs($this->getData(storage_path('files'.'/'.$filename)));

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

    public function store($user, $shifts){
        $userID = $user['user'];
        $date = $user['date'];
        $attendances = $user['attendance'];
        $late = null;
        $undertime = null;
        $overbreak = null;

        $employee_shift = null;

        foreach($shifts->first() as $shift){
            if(($date >= $shift['date_from']) && ($date <= $shift['date_to'])){
                foreach($shift['days'] as $value => $day){
                    if($day->day == date('D', strtotime($date))){
                        break;
                    }
                }
                $employee_shift = $shift;
                $start_time = $employee_shift['start_time'];
                $end_time = $employee_shift['end_time'];

                if($start_time < $attendances->first()){
                    $late = date_diff(new DateTime($start_time), new DateTime($attendances->first()));
                    $late = $late->format("%H:%i:%s");
                }
                if($attendances->last() < $end_time){
                    $undertime = date_diff(new DateTime($attendances->last()), new DateTime($end_time));
                    $undertime = $undertime->format("%H:%i:%s");
                }
            }
        }

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
            'undertime' => $undertime,
            'late' => $late,
            'overbreak' => $overbreak
            ]);
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
                        if($employee->shifts->count() == 0){
                            break;
                        } else{
                            if((count($attendances) % 2) == 0){
                                $this->store($user, $this->getShift($employee));
                            }
                        }
                    }
                }
            }
        }

        protected function getShift($employee){
            $shift = collect([
                'shifts' => value(function() use($employee){
                    $shifts = collect();
                    foreach($employee->employee_shifts()->orderBy('date_from', 'desc')->get() as $employee_shift){
                        $shifts->push([
                            'description' => $employee_shift->shift->description,
                            'start_time' => $employee_shift->shift->shift_from,
                            'end_time' => $employee_shift->shift->shift_to,
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
            }
