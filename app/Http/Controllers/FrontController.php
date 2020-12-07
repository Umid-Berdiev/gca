<?php

namespace App\Http\Controllers;

use App\doc;
use App\event;
use App\language;
use App\Mail\DemoMail;
use App\Raxbariyat;
use App\Statistica;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Mail;
use App\post;
use App\tender;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function checkcurrency()
  {
    //        $last = DB::table('translate')->where('type', "=", "kurs")->orderByDesc("id")->first();
    //        $date = new DateTime($last->timestamps ?? "2019-01-01");
    //        $current = time();
    //        if (($current - $date->getTimestamp()) >= 604800) {
    //            if (file_get_contents('http://cbu.uz/ru/arkhiv-kursov-valyut/json/') != null) {
    //                $filegetco = file_get_contents('http://cbu.uz/ru/arkhiv-kursov-valyut/json/');
    //
    //
    //                $dbs = DB::table('translate')->insert(
    //                    ['type' => 'kurs', 'jsons' => $filegetco]
    //                );
    //            }
    //        }
  }

  public function getEventDates()
  {
  }

  public function index()
  {

    //Mail::to('info@samar.uz')->send(new DemoMail());
    //return view('index');

    $eventsDate = event::select('datestart', 'dateend')->get();
    $eventDates = [];

    foreach ($eventsDate as $item) {

      $dateRange = CarbonPeriod::create($item->datestart, $item->dateend);

      foreach ($dateRange as $date) {
        $eventDates[] = $date->format('Y-m-d');
      }
    }


    $this->checkcurrency();
    $statisticas = \App\Statistica::where('photo_url', '<>', '')->where("language_id", "=", \App\Http\Controllers\NewsController::getlangid())->orderBy('id', 'desc')->take(10)->get();

    $events = \DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getlang())
      ->where("eventcategories.language_id", "=", $this->getlang())->take(5)
      ->orderBy('id', 'desc')->where('title', '<>', '')
      ->orderBy('id', 'desc')->take(2)
      ->get();


    $photos = \DB::table("photogalleries")
      ->select(['photogalleries.*', 'languages.language_name', 'photogallerycategories.title'])
      ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
      ->leftJoin("photogallerycategories", "photogallerycategories.group", "=", "photogalleries.category_id")
      ->where("photogalleries.language_id", "=", $this->getlang())
      ->where("photogallerycategories.language_id", "=", $this->getlang())
      ->orderBy('id', 'desc')
      ->get();
    //
    //        $photos = \DB::table("docs")
    //            ->get();


    if (count($docs = doc::where('doc_category_id', 1603263016)
      ->where('language_id', $this->getlang())
      ->orderBy('id', 'desc')
      ->get()) < 4) {
      $docs = doc::where('doc_category_id', 1603263016)
        ->where('language_id', $this->getlang())
        ->orderBy('id', 'desc')
        ->get();
    } else {
      $docs = doc::where('doc_category_id', 1603263016)
        ->where('language_id', $this->getlang())
        ->orderBy('id', 'desc')
        ->get()->take(3);
    }




    $posts = post::where('category_group_id', '=', '1603259067')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->take(2)->get();
    $posts_publications = post::where('category_group_id', '=', '1603259189')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->take(3)->get();

    if (count(post::where('category_group_id', '=', '1603259067')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->get()) > 4)
      $posts_for = post::where('category_group_id', '=', '1603259067')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->get()->random(4);
    else
      $posts_for = post::where('category_group_id', '=', '1603259067')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->get();



    //		  $posts = post::where('category_group_id', '=', '1545735855')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    //        $posts_publications = post::where('category_group_id', '=', '1603176830')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    //        $posts_for = post::where('category_group_id', '=', '1545735855')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->get();

    $languages = language::get();
    $tenders = tender::where('title', '<>', '')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->take(3)->get();
    $suv_xujaliks = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url')
      ->where('pages.title', '<>', '')
      ->where('pages.page_category_group_id', 1)
      ->where('languages.language_prefix', \App::getLocale())
      ->get();



    // dd($posts);
    return view('gca.index')
      ->with('languages', $languages)
      ->with('suv_xujaliks', $suv_xujaliks)
      ->with('posts', $posts)
      ->with('posts_for', $posts_for)
      ->with('statisticas', $statisticas)
      ->with('tenders', $tenders)
      ->with('eventDates', $eventDates)
      ->with('docs', $docs)
      ->with('photos', $photos)
      ->with('posts_publications', $posts_publications)
      ->with('events', $events);
  }

  public function getStatistika()
  {
    $posts = post::take(6)->where('category_group_id', '=', '1545735855')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $languages = language::get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $statistica = Statistica::where('photo_url', '<>', '')->where('language_id', '=', $this->getlang())->paginate(10);
    return view('statistica')
      ->with('languages', $languages)
      ->with('posts', $posts)
      ->with('tenders', $tenders)
      ->with('table', $statistica);
  }

  public function getRaxbariyat()
  {
    $posts = post::take(6)->where('category_group_id', '=', '1545735855')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $languages = language::get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getlang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $raxbariyat = Raxbariyat::where('fio', '<>', '')->where('language_id', '=', $this->getlang())->paginate(10);
    return view('raxbariyat')
      ->with('languages', $languages)
      ->with('posts', $posts)
      ->with('tenders', $tenders)
      ->with('raxbariyat', $raxbariyat);
  }

  public function getlang()
  {
    $model = language::all()->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }

  public function page($lang, $category_id, $id)
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
    $languages = language::where('status', 1)->get();
    $page_categories = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages_groups.status', '=', 1)
      ->where('pages.page_category_group_id', $category_id)
      ->where('pages_categories.language_id', $this->getlang())
      ->where('pages.language_id', $this->getlang())
      ->get();

    $page = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages_groups.status', '=', 1)
      ->where('pages.page_category_group_id', $category_id)
      ->where('pages.page_group_id', $id)
      ->where('pages_categories.language_id', $this->getlang())
      ->where('pages.language_id', $this->getlang())
      ->first();

    return view('gca.pages')
      ->with('page_categories', $page_categories)
      ->with('languages', $languages)
      ->with('events', $events)
      ->with('tenders', $tenders)
      ->with('page', $page);
  }

  public function pages($lang, $category_id)
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
    $languages = language::where('status', 1)->get();
    $page_categories = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages_groups.status', '=', 1)
      ->where('pages.page_category_group_id', $category_id)
      ->where('pages_categories.language_id', $this->getlang())
      ->where('pages.language_id', $this->getlang())
      ->get();


    return view('pages_cat')
      ->with('page_categories', $page_categories)
      ->with('tenders', $tenders)
      ->with('events', $events)
      ->with('languages', $languages);
  }

  public function post($category_id, $id)
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
    $languages = language::where('status', 1)->get();
    $page_categories = DB::table('postgroups')
      ->leftJoin('posts', 'posts.group', 'postgroups.id')
      ->leftJoin('languages', 'languages.id', 'posts.language_id')
      ->leftJoin('postcategories', 'postcategories.group', 'postgroups.post_category_group_id')
      ->select('posts.*', 'languages.language_name', 'languages.language_prefix', 'posts.cover', 'postcategories.category_name')
      ->where('postgroups.post_category_group_id', $category_id)
      ->where('postcategories.language_id', $this->getlang())
      ->where('posts.language_id', $this->getlang())
      ->get();

    //        dd($page_categories);

    $page = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages.page_category_group_id', $category_id)
      ->where('pages.page_group_id', $id)
      ->where('pages_categories.language_id', $this->getlang())
      ->where('pages.language_id', $this->getlang())
      ->first();

    return view('pages')
      ->with('page_categories', $page_categories)
      ->with('event', $events)
      ->with('events', $events)
      ->with('languages', $languages)
      ->with('page', $page);
  }
}
