<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
	protected $fillable = ['title', 'description', 'content','language_id','page_group_id','page_category_group_id'];
}
