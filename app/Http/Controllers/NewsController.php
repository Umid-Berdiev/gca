<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tender;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
  public static  function  getlangid()
  {
    $model = Language::where('status', '1')->where("language_prefix", app()->getLocale())->first();
    if ($model)
      return $model->id;
    else {
      $model = Language::all()->where('status', '=', '1')->where("language_prefix", 'en')->first();
      return $model->id;
    }
  }
  private function getLang()
  {
    $model = Language::all()->where("language_prefix", "=", app()->getLocale())->first();

    return $model->id;
  }
  public function index($lang, $cat_id)
  {
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getLang())
      ->where("eventcategories.language_id", "=", $this->getLang())->take(5)->orderBy('id', 'desc')->get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->get();
    $languages = Language::get();
    $curcat = DB::table("postcategories")->where('group', '=', $cat_id)->where('language_id', '=', $this->getLang())->first();
    $category = DB::table("postcategories")
      ->select(['postcategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
      ->where("language_id", "=", $this->getLang())->get();

    $news = DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.viewcount', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")
      ->where("posts.language_id", "=", $this->getLang())
      ->where('posts.title', '<>', '')
      ->where("postgroups.post_category_group_id", $cat_id==1615268167?"=":"!=",$cat_id==1615268167?"1615268167":"1615268167")
      ->orderBy('posts.id', 'desc')
      ->paginate(16);
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
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getLang())
      ->where("eventcategories.language_id", "=", $this->getLang())->take(5)
      ->orderBy('id', 'desc')
      ->get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->get();
    $news_in = DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")
      ->where("posts.language_id", "=", $this->getLang())
      ->where("postgroups.post_category_group_id", "=", $cat_id)
      ->orderBy('posts.id', 'desc')->take(3)->get();
    $languages = Language::get();
    $curcat = DB::table("postcategories")->where('group', '=', $cat_id)->where('language_id', '=', $this->getLang())->first();

    $category = DB::table("postcategories")
      ->select(['postcategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
      ->where("language_id", "=", $this->getLang())->get();



    $news = DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.viewcount', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")
      ->where("posts.language_id", "=", $this->getLang())
      ->where("postgroups.post_category_group_id", $cat_id==1615268167?"=":"!=",$cat_id==1615268167?"1615268167":"1615268167")
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


    $news = DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.viewcount', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")
      ->whereBetween('posts.datetime', array($request->start, $request->finish))
      ->where("posts.language_id", "=", $this->getLang())
      ->where('posts.title', '<>', '')
      ->where("postgroups.post_category_group_id", "=", $request->cutcat)
      ->orderBy('posts.id', 'desc')
      ->paginate(10);

    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getLang())
      ->where("eventcategories.language_id", "=", $this->getLang())->take(5)->orderBy('id', 'desc')->get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->get();
    $languages = Language::get();
    $curcat = DB::table("postcategories")->where('group', '=', $request->cutcat)->where('language_id', '=', $this->getLang())->first();
    $category = DB::table("postcategories")
      ->select(['postcategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
      ->where("language_id", "=", $this->getLang())->get();


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
