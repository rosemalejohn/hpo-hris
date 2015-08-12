<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use DateTime;
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

            foreach(Employee::all() as $employee){
                $staffcode = $employee->employee_id;
                $staffname = $employee->name;
                $total_lates = value(function() use($employee){
                    $lates = 0;
                    foreach($employee->employee_dtrs as $dtr){
                        $lates = $lates + strtotime($dtr->late);
                    }
                    return date('H:i:s', $lates);
                });
                $total_undertime = value(function() use($employee){ //'use' function is used to access the variables outside the closure
                    $undertimes = 0;
                    foreach($employee->employee_dtrs as $dtr){
                        $undertimes = $undertimes + strtotime($dtr->undertime);
                    }
                    return date('H:i:s', $undertimes);
                });
                $total_hours_worked = value(function() use($employee){
                    $hrs_worked = 0;
                    foreach($employee->employee_dtrs as $dtr){
                        $worked = date_diff(new DateTime($dtr->start_of_duty), new DateTime($dtr->end_of_duty));
                        $worked = $worked->format("%H:%I:%S");
                        $hrs_worked = $hrs_worked + strtotime($worked);
                    }
                    return date('H:i:s', $hrs_worked);
                });

                //add a new row and put all the gathered datas
                $row = $sheet->appendRow($index, [
                    $staffcode, $staffname, $total_lates, $total_undertime, '', $total_hours_worked
                ]);
                ++$index; //increment the index to know what row are we
            }
        })->export('xlsx');
    }
}
