<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function users()
    {
    	return $this->hasMany('App\User');
    }

    public function admin()
    {
    	return $this->hasOne('App\User');
    }

    public function group()
    {
    	return $this->hasMany('App\Group');
    }

}
