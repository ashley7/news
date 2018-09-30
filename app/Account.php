<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function loan()
    {
    	return $this->hasMany('App\Loan');
    }

    public function group()
    {
    	return $this->belongsTo('App\Group');
    }
}
