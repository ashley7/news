<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function branch()
    {
    	return $this->belongsTo('App\Branch');
    }

    public function account()
    {
    	return $this->hasMany('App\Account');
    }

    public function loan()
    {
    	return $this->hasMany('App\Loan');
    }
}
