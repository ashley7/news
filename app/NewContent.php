<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewContent extends Model
{
    protected $fillable = ["title","description","file_url"];
}
