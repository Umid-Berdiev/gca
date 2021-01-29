<?php

namespace App\Http\Controllers;

use App\Language;
use App\tender;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{
  private function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", app()->getLocale())->first();
    if ($model)
      return $model->id;
    else {
      $model = Language::all()->where('status', '=', '1')->where("language_prefix", 'en')->first();
      return $model->id;
    }
  }
  public function ViewPhoto()
  {
    $model = "";
    $languages = Language::get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->get();
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getLang())
      ->where("eventcategories.language_id", "=", $this->getLang())->take(5)->orderBy('id', 'desc')->get();
    $model = DB::table("photogallerycategories")
      ->select(['photogallerycategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
      ->where("photogallerycategories.language_id", "=", $this->getLang())
      ->orderBy('id', 'desc')
      ->paginate(10);


    $category = DB::table("photogallerycategories")
      ->select(['photogallerycategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
      ->where("photogallerycategories.language_id", "=", $this->getLang())->get();

    return view('gca.media', [
      'newscat' => $category,
      'table' => $model,
      'tenders' => $tenders,
      'events' => $events,
    ]);
  }
}
