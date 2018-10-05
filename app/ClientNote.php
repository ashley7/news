<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientNote extends Model
{
    protected $fillable = ['account_id','notes'];
}
