<?php

namespace App\Http\Controllers;

use App\Language;
use App\tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
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

  public function ViewVideo()
  {
    $model = "";
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->get();
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getLang())
      ->where("eventcategories.language_id", "=", $this->getLang())->take(5)->orderBy('id', 'desc')->get();

    $category = DB::table("videogallerycategories")
      ->select(['videogallerycategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "videogallerycategories.language_id")
      ->where("videogallerycategories.language_id", $this->getLang())->get();

    $model = DB::table("videogallerycategories")
      ->select(['videogallerycategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "videogallerycategories.language_id")
      ->where("videogallerycategories.language_id", $this->getLang())
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('gca.video', [
      'newscat' => $category,
      'table' => $model,
      'tenders' => $tenders,
      'events' => $events,
    ]);
  }
}
