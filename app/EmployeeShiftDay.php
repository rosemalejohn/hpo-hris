<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeShiftDay extends Model
{
    //
    protected $table = 'employee_shift_days';
    protected $fillable = [
            'employee_shift_id',
            'day_id'
    ];
    public $timestamps = false;

    public function employee_shift(){
        return $this->belongsTo('App\EmployeeShift');
    }

}
