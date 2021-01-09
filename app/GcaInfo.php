<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GcaInfo extends Model
{
  public function news()
  {
    $lang_id = Language::where('language_prefix', \App::getLocale())->first();
    return $this->hasMany(Post::class, 'gcainfo_id', 'id')->where('language_id', $lang_id->id);
  }
}
