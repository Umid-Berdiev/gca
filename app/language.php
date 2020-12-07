<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class language extends Model
{
    protected $fillable = ['id', 'language_name', 'language_prefix','status'];
}
