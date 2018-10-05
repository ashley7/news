<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	protected $fillable = ['name','also_known_as','phone_number','business','title','id_number','id_type','language','addreess','addreess_period','stall_number','date_of_birth','marital_status','number_of_dependants','gender','group_id'];
    public function loan()
    {
    	return $this->hasMany('App\Loan');
    }

    public function group()
    {
    	return $this->belongsTo('App\Group');
    }
}
