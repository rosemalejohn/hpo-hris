<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmployeeDtr extends Model
{
    //
    protected $table = 'employee_dtr';
    protected $fillable = ['employee_id','start_of_duty', 'first_out', 'first_in', 'second_out', 'second_in', 'third_out', 'third_in', 'end_of_duty', 'undertime', 'late', 'overbreak', 'remarks', 'shift_id'];

    public $timestamps = false;

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function shift(){
    	return $this->belongsTo(Shift::class);
    }
}