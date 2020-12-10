<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
  protected $table = 'languages';
  protected $fillable = ['id', 'language_name', 'language_prefix', 'status'];
}
