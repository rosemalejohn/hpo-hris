<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use Date;
use DateTime;
use DateInterval;
use App\Employee;
use App\EmployeeDtr;

class DtrController extends Controller
{
    //
    public function dtrToExcel(){
        $path = storage_path('files/DTR.xlsx'); //Path of the excel template to be loaded

        Excel::load($path, function($reader){ //load the excel file
            $sheet = $reader->sheet('Sheet1'); //select the Sheet1 of the excel file

            $index = 1;
            $staffname = null;

            foreach(EmployeeDtr::all() as $employee_dtr){ //get the employee logs within the provided days
                if($staffname != $employee_dtr->employee->name){
                    $index = $index + 2;
                }
                //assign the data to the variables
                $staffname = $employee_dtr->employee->name;
                $date = date('Y-m-d', strtotime($employee_dtr->start_of_duty));
                $login = date('H:i:s', strtotime($employee_dtr->start_of_duty));
                $logout = date('H:i:s', strtotime($employee_dtr->end_of_duty));
                $late = $employee_dtr->late;
                $undertime = $employee_dtr->undertime;

                //add a new row and put all the gathered datas
                $row = $sheet->appendRow($index, [
                    $staffname, $date, $login, $logout, '', '', $late, '', $undertime
                ]);
                ++$index; //increment the index to know what row are we
            }
        })->export('xlsx'); //download the excel file
    }

    public function dtrSummaryToExcel(){
        $path = storage_path('files/summary.xlsx');

        Excel::load($path, function($reader){
            $sheet = $reader->sheet('summary');
            $index = 3;

            foreach(Employee::with('employee_dtrs')->get() as $employee){
                $staffcode = $employee->employee_id;
                $staffname = $employee->name;
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

                    $late = computeTimeInterval($late->format('Y-m-d h:i:s'), '00:00:00')->format("%d %H:%I:%S");
                    $undertime = computeTimeInterval($undertime->format('Y-m-d h:i:s'), '00:00:00')->format("%d %H:%I:%S");
                    $overbreak = computeTimeInterval($overbreak->format('Y-m-d h:i:s'), '00:00:00')->format("%d %H:%I:%S");
                    $hrs_worked = computeTimeInterval($hrs_worked->format('Y-m-d h:i:s'), '00:00:00')->format("%d %H:%I:%S");

                    // dd($late);
                    return [
                        'late' => $late,
                        'undertime' => $undertime,
                        'overbreak' => $overbreak,
                        'hrs_worked' => $hrs_worked
                    ];
                });

                //add a new row and put all the gathered datas
                $row = $sheet->appendRow($index, [
                    $staffcode, $staffname, $computations['late'], $computations['undertime'], '', $computations['hrs_worked']
                ]);
                ++$index; //increment the index to know what row are we
            }
        })->export('xlsx');
    }

}
