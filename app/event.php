<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $table = 'events';
  protected $guarded = [];
  protected $casts = [
    'datestart' => 'datetime:Y-m-d',
    'dateend' => 'datetime:Y-m-d',
  ];

  public function category()
  {
    return $this->belongsTo('App\EventCategory', 'event_category_id', 'group')->select('id', 'group', 'category_name');
  }

  public function language()
  {
    return $this->belongsTo('App\Language', 'language_id');
  }
}
