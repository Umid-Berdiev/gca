<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
  public function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", \App::getLocale())->first();
    if ($model)
      return $model->id;
    else {
      $model = Language::all()->where('status', '=', '1')->where("language_prefix", 'en')->first();
      return $model->id;
    }
  }
  public function translate(Request $request)
  {


    $myarr = [
      'title' => $request->input("title"),
      'description' => $request->input("description"),
      'tb_one_uz' => $request->input("tb_one_uz"),
      'tb_two_uz' => $request->input("tb_two_uz"),
      'tb_three_uz' => $request->input("tb_three_uz"),
      'tb_four_uz' => $request->input("tb_four_uz"),

      'tb_one_en' => $request->input("tb_one_en"),
      'tb_two_en' => $request->input("tb_two_en"),
      'tb_three_en' => $request->input("tb_three_en"),
      'tb_four_en' => $request->input("tb_four_en"),

      'tb_one_ru' => $request->input("tb_one_ru"),
      'tb_two_ru' => $request->input("tb_two_ru"),
      'tb_three_ru' => $request->input("tb_three_ru"),
      'tb_four_ru' => $request->input("tb_four_ru"),

      'map_target' => $request->input("map_target"),
      'bottom_title' => $request->input("bottom_title"),


      'bottom_table_tb_one_uz' => $request->input("bottom_table_tb_one_uz"),
      'bottom_table_tb_two_uz' => $request->input("bottom_table_tb_two_uz"),
      'bottom_table_tb_three_uz' => $request->input("bottom_table_tb_three_uz"),
      'bottom_table_tb_four_uz' => $request->input("bottom_table_tb_four_uz"),
      'bottom_table_tb_one_ru' => $request->input("bottom_table_tb_one_ru"),
      'bottom_table_tb_two_ru' => $request->input("bottom_table_tb_two_ru"),
      'bottom_table_tb_three_ru' => $request->input("bottom_table_tb_three_ru"),
      'bottom_table_tb_four_ru' => $request->input("bottom_table_tb_four_ru"),
      'bottom_table_tb_one_en' => $request->input("bottom_table_tb_one_en"),
      'bottom_table_tb_two_en' => $request->input("bottom_table_tb_two_en"),
      'bottom_table_tb_three_en' => $request->input("bottom_table_tb_three_en"),
      'bottom_table_tb_four_en' => $request->input("bottom_table_tb_four_en"),
      'rahbar' => $request->input("rahbar"),
      'lavozim' => $request->input("lavozim"),
      'kun' => $request->input("kun"),
      'soat' => $request->input("soat"),
    ];
    $dbs = DB::table('translate')->insert(
      ['type' => 'contact', 'jsons' => json_encode($myarr)]
    );


    return redirect("/admin/translate");
  }
  public function translate_footer(Request $request)
  {


    $myarr = [
      'telephone' => $request->input("telephone"),
      'devonxona' => $request->input("devonxona"),
      'fax' => $request->input("fax"),
      'manzil' => $request->input("manzil"),
      'obuna' => $request->input("obuna"),
      'email' => $request->input("email"),

    ];
    $dbs = DB::table('translate')->insert(
      ['type' => 'footer', 'jsons' => json_encode($myarr)]
    );


    return redirect("/admin/translate");
  }

  public function translate_svg(Request $request)
  {


    $myarr = array();

    foreach ($request->input("code") as $key => $val) {
      array_push($myarr, [$val => [
        'rahbar_uz' => $request->input("rahbar_uz")[$key],
        'rahbar_ru' => $request->input("rahbar_ru")[$key],
        'rahbar_en' => $request->input("rahbar_en")[$key],
        'telefon' => $request->input("telefon")[$key],
        'email' => $request->input("email")[$key],

      ]]);
    }
    $dbs = DB::table('translate')->insert(
      ['type' => 'svg', 'jsons' => json_encode($myarr)]
    );


    return redirect("/admin/translate");
  }
  public function index($lang, $type)
  {

    $toreturn = array();
    $title = "";


    switch ($type) {
      case "post":
        $model = DB::table("posts")
          ->select(['posts.*', 'languages.language_name'])

          ->leftJoin("languages", "languages.id", "=", "posts.language_id")
          ->where("posts.language_id", "=", $this->getLang())

          ->orderBy('posts.id', 'desc')
          ->limit(20)->get();


        foreach ($model as $value) {

          array_push(
            $toreturn,
            [
              'title' => $value->title,
              'description' => $value->decription,
              'link' => URL(App::getLocale() . '/posts/' . $value->category_group_id . '/' . $value->group)

            ]
          );
        }

        $title = "POST";
        break;
      case "event":
        $model = DB::table("events")
          ->select(['events.*', 'languages.language_name'])

          ->leftJoin("languages", "languages.id", "=", "events.language_id")
          ->where("events.language_id", "=", $this->getLang())

          ->orderBy('events.id', 'desc')
          ->limit(20)->get();


        foreach ($model as $value) {

          array_push(
            $toreturn,
            [
              'title' => $value->title,
              'description' => $value->description,
              'link' => URL(App::getLocale() . '/event/' . $value->event_category_id . '/' . $value->group)

            ]
          );
        }

        $title = "EVENT";
        break;
      case "tender":

        $model = DB::table("tenders")
          ->select(['tenders.*', 'languages.language_name'])

          ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
          ->where("tenders.language_id", "=", $this->getLang())

          ->orderBy('tenders.id', 'desc')
          ->limit(20)->get();


        foreach ($model as $value) {

          array_push(
            $toreturn,
            [
              'title' => $value->title,
              'description' => $value->deadline,
              'link' => URL(App::getLocale() . '/event/' . $value->tender_category_id . '/' . $value->group)

            ]
          );
        }

        $title = "TENDER";
        break;
      case "photo":

        $model = DB::table("photogalleries")
          ->select(['photogalleries.*', 'languages.language_name'])

          ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
          ->where("photogalleries.language_id", "=", $this->getLang())

          ->orderBy('photogalleries.id', 'desc')
          ->limit(20)->get();


        foreach ($model as $value) {

          array_push(
            $toreturn,
            [
              'title' => $value->name,
              'description' => $value->description,
              'link' => URL(App::getLocale() . '/photo/' . $value->category_id . '/' . $value->group)

            ]
          );
        }

        $title = "PHOTO GALLERY";
        break;
      case "video":
        $model = DB::table("videogalleries")
          ->select(['videogalleries.*', 'languages.language_name'])

          ->leftJoin("languages", "languages.id", "=", "videogalleries.language_id")
          ->where("videogalleries.language_id", "=", $this->getLang())

          ->orderBy('videogalleries.id', 'desc')
          ->limit(20)->get();


        foreach ($model as $value) {

          array_push(
            $toreturn,
            [
              'title' => $value->name,
              'description' => $value->description,
              'link' => URL(App::getLocale() . '/photo/' . $value->category_id . '/' . $value->group)

            ]
          );
        }

        $title = "VIDEO GALLERY";
        break;
      case "doc":
        $model = DB::table("docs")
          ->select(['docs.*', 'languages.language_name'])

          ->leftJoin("languages", "languages.id", "=", "docs.language_id")
          ->where("docs.language_id", "=", $this->getLang())

          ->orderBy('docs.id', 'desc')
          ->limit(20)->get();


        foreach ($model as $value) {

          array_push(
            $toreturn,
            [
              'title' => $value->title,
              'description' => $value->link,
              'link' => URL(App::getLocale() . '/photo/' . $value->doc_category_id . '/' . $value->group)

            ]
          );
        }

        $title = "DOC";
        break;
    }


    return response()->view('ress', [
      'table' => $toreturn,
      'title' => $title,
    ])->header('Content-Type', 'text/xml');
  }
}
