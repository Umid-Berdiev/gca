<?php

namespace App\Http\Controllers;

use App\Document;
use App\Event;
use App\Language;
use App\Raxbariyat;
use App\Statistics;
use Carbon\CarbonPeriod;
use App\Post;
use App\Tender;
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

  public function index()
  {

    //Mail::to('info@samar.uz')->send(new DemoMail());
    //return view('index');

    $eventsDate = Event::select('datestart', 'dateend')->get();
    $eventDates = [];

    foreach ($eventsDate as $item) {
      $dateRange = CarbonPeriod::create($item->datestart, $item->dateend);
      foreach ($dateRange as $date) {
        $eventDates[] = $date->format('Y-m-d');
      }
    }

    $this->checkcurrency();
    $statisticas = \App\Statistics::where('photo_url', '<>', '')->where("language_id", "=", \App\Http\Controllers\NewsController::getlangid())->orderBy('id', 'desc')->take(10)->get();

    // $events = DB::table("events")
    //   ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
    //   ->leftJoin("languages", "languages.id", "=", "events.language_id")
    //   ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
    //   ->where('events.title', '<>', '')
    //   ->where("events.language_id", "=", $this->getLang())
    //   ->where("eventcategories.language_id", "=", $this->getLang())->take(5)
    //   ->orderBy('id', 'desc')->where('title', '<>', '')
    //   ->orderBy('id', 'desc')->take(2)
    //   ->get();

    $events = Event::where('language_id', $this->getLang())
      ->whereDate('dateend', '>=', now())
      ->with('category')
      // ->with('language')
      ->latest()
      ->take(3)
      ->get();

    $photos = DB::table("photogalleries")
      ->select(['photogalleries.*', 'languages.language_name', 'photogallerycategories.title'])
      ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
      ->leftJoin("photogallerycategories", "photogallerycategories.group", "=", "photogalleries.category_id")
      ->where("photogalleries.language_id", "=", $this->getLang())
      ->where("photogallerycategories.language_id", "=", $this->getLang())
      ->orderBy('created_at', 'desc')
      ->get();

    $videos = DB::table("videogalleries")
      ->select(['videogalleries.*', 'languages.language_name', 'videogallerycategories.title'])
      ->leftJoin("languages", "languages.id", "=", "videogalleries.language_id")
      ->leftJoin("videogallerycategories", "videogallerycategories.group", "=", "videogalleries.category_id")
      ->where("videogalleries.language_id", "=", $this->getLang())
      ->where("videogallerycategories.language_id", "=", $this->getLang())
      ->orderBy('created_at', 'desc')
      ->get();

    $media_gallery = $photos->merge($videos)->sortByDesc('created_at');
    // dd($media_gallery);

    if (count($docs = Document::where('doc_category_id', 1603263016)
      ->where('language_id', $this->getLang())
      ->orderBy('id', 'desc')
      ->get()) < 4) {
      $docs = Document::where('doc_category_id', 1603263016)
        ->where('language_id', $this->getLang())
        ->orderBy('id', 'desc')
        ->get();
    } else {
      $docs = Document::where('doc_category_id', 1603263016)
        ->where('language_id', $this->getLang())
        ->orderBy('id', 'desc')
        ->get()->take(3);
    }

    // $posts = Post::where('category_group_id', '=', '1603259067')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->take(2)->get();
    // $posts_publications = Post::where('category_group_id', '=', '1603259189')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->take(3)->get();
    $posts = Post::where('language_id', $this->getLang())->where("category_group_id","!=","1615268167")->latest()->take(4)->get();
    $posts_publications = Post::where('language_id', $this->getLang())->where("category_group_id","!=","1615268167")->latest()->skip(3)->take(4)->get();

    if (count(Post::where('category_group_id', '=', '1603259067')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->get()) > 4)
      $posts_for = Post::where('category_group_id', '=', '1603259067')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->get()->random(4);
    else
      $posts_for = Post::where('category_group_id', '=', '1603259067')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->get();

    //		  $posts = Post::where('category_group_id', '=', '1545735855')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    //        $posts_publications = Post::where('category_group_id', '=', '1603176830')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    //        $posts_for = Post::where('category_group_id', '=', '1545735855')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->get();

    $languages = Language::get();
    $tenders = tender::where('title', '<>', '')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->take(3)->get();
    $suv_xujaliks = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url')
      ->where('pages.title', '<>', '')
      ->where('pages.page_category_group_id', 1)
      ->where('languages.language_prefix', app()->getLocale())
      ->get();

    // dd($videos);
    return view('gca.index')
      ->with('languages', $languages)
      ->with('suv_xujaliks', $suv_xujaliks)
      ->with('posts', $posts)
      ->with('posts_for', $posts_for)
      ->with('statisticas', $statisticas)
      ->with('tenders', $tenders)
      ->with('eventDates', $eventDates)
      ->with('docs', $docs)
      // ->with('photos', $photos)
      ->with('media_gallery', $media_gallery)
      ->with('posts_publications', $posts_publications)
      ->with('events', $events);
  }

  public function getStatistika()
  {
    $posts = Post::take(6)->where('category_group_id', '=', '1545735855')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $languages = Language::get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $statistica = Statistics::where('photo_url', '<>', '')->where('language_id', '=', $this->getLang())->paginate(10);
    return view('statistica')
      ->with('languages', $languages)
      ->with('posts', $posts)
      ->with('tenders', $tenders)
      ->with('table', $statistica);
  }

  public function getRaxbariyat()
  {
    $posts = Post::take(6)->where('category_group_id', '=', '1545735855')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $languages = Language::get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getLang())->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $raxbariyat = Raxbariyat::where('fio', '<>', '')->where('language_id', '=', $this->getLang())->paginate(10);
    return view('raxbariyat')
      ->with('languages', $languages)
      ->with('posts', $posts)
      ->with('tenders', $tenders)
      ->with('raxbariyat', $raxbariyat);
  }

  public function getLang()
  {
    $model = Language::all()->where("language_prefix", "=", app()->getLocale())->first();

    return $model->id;
  }

  public function page($lang, $category_id, $id)
  {
    // dd('ok');
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
    $languages = Language::where('status', 1)->get();
    $page_categories = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages_groups.status', '=', 1)
      ->where('pages.page_category_group_id', $category_id)
      ->where('pages_categories.language_id', $this->getLang())
      ->where('pages.language_id', $this->getLang())
      ->get();

    $page = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages_groups.status', '=', 1)
      ->where('pages.page_category_group_id', $category_id)
      ->where('pages.page_group_id', $id)
      ->where('pages_categories.language_id', $this->getLang())
      ->where('pages.language_id', $this->getLang())
      ->first();
    // dd($page);
    return view('gca.pages')
      ->with('page_categories', $page_categories)
      ->with('languages', $languages)
      ->with('events', $events)
      ->with('tenders', $tenders)
      ->with('page', $page);
  }

  public function pages($lang, $category_id)
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
    $languages = Language::where('status', 1)->get();
    $page_categories = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages_groups.status', '=', 1)
      ->where('pages.page_category_group_id', $category_id)
      ->where('pages_categories.language_id', $this->getLang())
      ->where('pages.language_id', $this->getLang())
      ->get();


    return view('pages_cat')
      ->with('page_categories', $page_categories)
      ->with('tenders', $tenders)
      ->with('events', $events)
      ->with('languages', $languages);
  }

  public function post($category_id, $id)
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
    $languages = Language::where('status', 1)->get();
    $page_categories = DB::table('postgroups')
      ->leftJoin('posts', 'posts.group', 'postgroups.id')
      ->leftJoin('languages', 'languages.id', 'posts.language_id')
      ->leftJoin('postcategories', 'postcategories.group', 'postgroups.post_category_group_id')
      ->select('posts.*', 'languages.language_name', 'languages.language_prefix', 'posts.cover', 'postcategories.category_name')
      ->where('postgroups.post_category_group_id', $category_id)
      ->where('postcategories.language_id', $this->getLang())
      ->where('posts.language_id', $this->getLang())
      ->get();

    //        dd($page_categories);

    $page = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages.page_category_group_id', $category_id)
      ->where('pages.page_group_id', $id)
      ->where('pages_categories.language_id', $this->getLang())
      ->where('pages.language_id', $this->getLang())
      ->first();

    return view('pages')
      ->with('page_categories', $page_categories)
      ->with('event', $events)
      ->with('events', $events)
      ->with('languages', $languages)
      ->with('page', $page);
  }
}