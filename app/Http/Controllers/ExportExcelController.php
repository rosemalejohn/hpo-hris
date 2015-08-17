<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use App\EmployeeDtr;
use App\Employee;
use DateTime;

class ExportExcelController extends Controller
{
    
	public function export(){
		Excel::create('Sample', function($writer){

		})->download('xlsx');
	}

}
