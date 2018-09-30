<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function account()
    {
    	return $this->belongsTo('App\Account');
    }

    public function payment()
    {
    	return $this->hasMany('App\Payment');
    }
}
