<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    
	protected $fillable = [
		'title', 'description', 'start', 'end'
	];

}
