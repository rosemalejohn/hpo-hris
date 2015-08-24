<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';

    protected $fillable = ['description', 'shift_from', 'shift_to', 'working hours', 'break'];

    public function employees(){
        return $this->belongsToMany('App\Employee', 'employee_shifts')->withPivot('id', 'date_from', 'date_to');
    }

    public function employee_shifts(){
        return $this->hasMany('App\EmployeeShift');
    }

    public function employee_shift_days(){
        return $this->hasManyThrough('App\EmployeeShiftDay', 'App\EmployeeShift');
    }

    public function employee_dtr(){
        return $this->hasOne(EmployeeDtr::class);
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        if ($parent instanceof Employee) {
            return new EmployeeShiftPivot($parent, $attributes, $table, $exists);
        }
     
        return parent::newPivot($parent, $attributes, $table, $exists);
    }

}