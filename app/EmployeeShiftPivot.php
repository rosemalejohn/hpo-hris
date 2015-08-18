<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeeShiftPivot extends Pivot
{
    //
	public function employee_shift_days(){
		return $this->hasMany('App\EmployeeShiftDay', 'employee_shift_id');
	}

}
