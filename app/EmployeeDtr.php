<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmployeeDtr extends Model
{
    //
    protected $table = 'employee_dtr';
    protected $fillable = ['employee_id','start_of_duty', 'first_out', 'first_in', 'second_out', 'second_in', 'third_out', 'third_in', 'end_of_duty', 'undertime', 'late', 'overbreak'];

    public $timestamps = false;

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function filterByDate($date_from, $date_to){
    	$dtrs = DB::table($table)->whereBetween('start_of_duty', [$date_from, $date_to])->get();
    	return $dtrs;
    }
}
