<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeShift extends Model
{

    protected $table = 'employee_shifts';

    protected $fillable = ['employee_id', 'shift_id'];

    public function employee(){
        return $this->belongsTo('App\Employee');
    }

    public function shift(){
        return $this->belongsTo('App\Shift');
    }

    public function employee_shift_days(){
        return $this->hasMany('App\EmployeeShiftDay');
    }

}
