<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UfoRecord extends Model
{
    //
	
	protected $fillable = [
        'datetime', 'city', 'state', 'country', 'shape', 'duration (seconds)', 'duration (hours/min)', 'comments', 'date posted', 'latitude',
       'longitude']
    ];
}
