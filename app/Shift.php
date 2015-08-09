<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';

    protected $fillable = ['description', 'shift_from', 'shift_to', 'working hours', 'break'];

    public function employees(){
        return $this->belongsToMany('App\Employee', 'employee_shifts')->withPivot('date_from', 'date_to');
    }

    public function employee_shifts(){
        return $this->hasMany('App\EmployeeShift');
    }

    public function employee_shift_days(){
        return $this->hasManyThrough('App\EmployeeShiftDay', 'App\EmployeeShift');
    }

}
