<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable = [
        'department_code',
        'name',
        'description'
    ];

    public function employees(){
        return $this->hasMany('App\Employee');
    }

    public function isKiniteque(){
    	return $this->department_code === 'KSI';
    }

}
