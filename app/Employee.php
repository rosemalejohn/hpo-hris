<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = ['employee_id' ,'first_name', 'middle_name', 'last_name', 'department_id', 'status'];

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function shifts(){
        return $this->belongsToMany('App\Shift', 'employee_shifts')->withPivot('id' ,'date_from', 'date_to');
    }

    public function employee_shifts(){
        return $this->hasMany('App\EmployeeShift');
    }

    public function employee_dtrs(){
        return $this->hasMany('App\EmployeeDtr', 'employee_id', 'employee_id');
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        if ($parent instanceof Shift) {
            return new EmployeeShiftPivot($parent, $attributes, $table, $exists);
        }
     
        return parent::newPivot($parent, $attributes, $table, $exists);
    }

}
