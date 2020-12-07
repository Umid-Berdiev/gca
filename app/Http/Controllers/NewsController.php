<?php

namespace App\Http\Controllers;

use App\language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tender;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
  public static  function  getlangid()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();
    if ($model)
      return $model->id;
    else {
      $model = language::all()->where('status', '=', '1')->where("language_prefix", 'en')->first();
      return $model->id;
    }
  }
  private function getlang()
  {
    $model = language::all()->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }
  public function index($lang, $cat_id)
  {
    $events = \DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getlang())
      ->where("eventcategories.language_id", "=", $this->getlang())->take(5)->orderBy('id', 'desc')->get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->get();
    $languages = language::get();
    $curcat = \DB::table("postcategories")->where('group', '=', $cat_id)->where('language_id', '=', $this->getlang())->first();
    $category = \DB::table("postcategories")
      ->select(['postcategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
      ->where("language_id", "=", $this->getlang())->get();



    $news = \DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.viewcount', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")

      ->where("posts.language_id", "=", $this->getlang())
      ->where('posts.title', '<>', '')
      ->where("postgroups.post_category_group_id", "=", $curcat->group)
      ->orderBy('posts.id', 'desc')
      ->paginate(10);


    return view('gca.posts', [
      'newscat' => $category,
      'languages' => $languages,
      'tenders' => $tenders,
      'news' => $news,
      'events' => $events,
      'curcat' => $curcat,
    ]);
  }


  public function indexin($lang, $cat_id, $title)
  {
    $events = \DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getlang())
      ->where("eventcategories.language_id", "=", $this->getlang())->take(5)
      ->orderBy('id', 'desc')
      ->get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->get();
    $news_in = \DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")

      ->where("posts.language_id", "=", $this->getlang())
      ->where("postgroups.post_category_group_id", "=", $cat_id)
      ->orderBy('posts.id', 'desc')->take(3)->get();
    $languages = language::get();
    $curcat = \DB::table("postcategories")->where('group', '=', $cat_id)->where('language_id', '=', $this->getlang())->first();

    $category = \DB::table("postcategories")
      ->select(['postcategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
      ->where("language_id", "=", $this->getlang())->get();



    $news = \DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.viewcount', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")

      ->where("posts.language_id", "=", $this->getlang())
      ->where("postgroups.post_category_group_id", "=", $curcat->group)
      ->where("postgroups.id", "=", $title)
      ->first();

    $lastcount = $news->viewcount;
    $grpupd = \App\postgroup::all()->where("id", "=", $news->id)->first();
    $grpupd->viewcount = $lastcount + 1;
    $grpupd->update();



    return view('gca.post', [
      'newscat' => $category,
      'languages' => $languages,
      'news' => $news,
      'news_in' => $news_in,
      'events' => $events,
      'tenders' => $tenders,
      'curcat' => $curcat,
    ]);
  }

  public function download($id)
  {
    //PDF file is stored under project/public/download/info.

    $bk = DB::table("posts")
      ->where("group", "=", $id)->first();


    return response()->download(storage_path("app/" . $bk->cover));
  }
  public function PostsFilter(Request $request)
  {


    $news = \DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.viewcount', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")
      ->whereBetween('posts.datetime', array(Input::get('start'), Input::get('finish')))
      ->where("posts.language_id", "=", $this->getlang())
      ->where('posts.title', '<>', '')
      ->where("postgroups.post_category_group_id", "=", Input::get('cutcat'))
      ->orderBy('posts.id', 'desc')
      ->paginate(10);

    $events = \DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getlang())
      ->where("eventcategories.language_id", "=", $this->getlang())->take(5)->orderBy('id', 'desc')->get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->get();
    $languages = language::get();
    $curcat = \DB::table("postcategories")->where('group', '=', Input::get('cutcat'))->where('language_id', '=', $this->getlang())->first();
    $category = \DB::table("postcategories")
      ->select(['postcategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
      ->where("language_id", "=", $this->getlang())->get();


    return view('news', [
      'newscat' => $category,
      'languages' => $languages,
      'tenders' => $tenders,
      'news' => $news,
      'events' => $events,
      'curcat' => $curcat,
    ]);
  }
}
