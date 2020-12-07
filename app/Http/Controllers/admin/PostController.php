<?php

namespace App\Http\Controllers\admin;

use App\GcaInfo;
use App\Http\Controllers\MailController;
use App\language;
use App\Obuna;
use App\PagesGroup;
use http\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\post;
use App\postcategory;
use App\postgroup;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
  public function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }


  public function index(Request $request)
  {
    if ($request->has("search")) {

      $model = DB::table("posts")
        ->select(['posts.*', 'languages.language_name'])

        ->leftJoin("languages", "languages.id", "=", "posts.language_id")
        ->where("posts.language_id", "=", $this->getlang())
        ->where("posts.title", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("posts.decription", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('posts.id', 'desc')
        ->paginate(10);
    } else {

      $model = DB::table("posts")
        ->select(['posts.*', 'languages.language_name'])

        ->leftJoin("languages", "languages.id", "=", "posts.language_id")
        ->where("posts.language_id", "=", $this->getlang())

        ->orderBy('posts.id', 'desc')
        ->paginate(10);
    }

    $lang = language::all()->where('status', '=', '1');

    return view("admin.post", [
      'table' => $model,
      'languages' => $lang,
    ]);
  }
  private function postgrp($post_category_group_id)
  {

    $model = new postgroup();
    $model->post_category_group_id = $post_category_group_id;
    $model->viewcount = 0;

    $model->save();

    return $model->id;
  }
  public function Insert(Request $request)
  {


    $validatedData = $request->validate([

      'post_category_id' => 'required',
      'datetime' => 'required',
      'country_id' => 'required',


    ]);


    $grp_id = $this->postgrp($request->input("post_category_id"));


    foreach ($request->input("language_id") as $key => $value) {
      $model = new post();
      $model->datetime = Input::get('datetime');
      if (isset($request->input("title")[$key]))
        $model->title = $request->input("title")[$key];
      else
        $model->title = "";
      if (isset($request->input("decription")[$key]))
        $model->decription = $request->input("decription")[$key];
      else
        $model->decription = "";
      if (isset($request->input("content")[$key]))
        $model->content = $request->input("content")[$key];
      else
        $model->content = "";
      if ($request->hasFile('cover')) {

        $model->cover = Storage::putFile('public', $request->file('cover'));
      } else {
        $model->cover = "";
      }

      $model->language_id = $value;
      $model->group = $grp_id;
      $model->category_group_id = $request->input("post_category_id");
      $model->gcainfo_id = $request->input("country_id");

      $model->save();
    }
    $obunas = Obuna::all();

    foreach ($obunas as $key => $obuna) {
      //MailController::send($request->input("title")[0],Input::get('datetime'),'<p>'.\URL::to('/uz/posts/'.$request->input("post_category_id").'/'.$grp_id).'</p></br>'.'<p>'.\URL::to('/ru/posts/'.$request->input("post_category_id").'/'.$grp_id).'</p></br>'.'<p>'.\URL::to('/en/posts/'.$request->input("post_category_id").'/'.$grp_id).'</p></br>','info@water.gov.uz',$obuna->email,'obuna',$obuna->id);

    }


    return redirect("admin/post");
  }
  public function Update(Request $request)
  {

    //dd($request->all());

    $validatedData = $request->validate([
      'post_category_id' => 'required',
      'country_id' => 'required',

    ]);




    $grp_id = $request->input("group");
    $grpupd = postgroup::all()->where("id", "=", $grp_id)->first();
    $grpupd->post_category_group_id =  $request->input("post_category_id");
    $grpupd->update();
    foreach ($request->input("language_id") as $key => $value) {
      $model =  post::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)->first();
      if (isset($request->input("title")[$key]))
        $model->title = $request->input("title")[$key];
      else
        $model->title = "";
      if ($request->input("decription")[$key])
        $model->decription = $request->input("decription")[$key];
      else
        $model->decription = "";
      if ($request->input("content")[$key])
        $model->content = $request->input("content")[$key];
      else
        $model->content = "";
      if ($request->input("post_category_id"))
        $model->category_group_id = $request->input("post_category_id");
      else
        $model->category_group_id = "";
      if ($request->input("country_id"))
        $model->gcainfo_id = $request->input("country_id");

      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }
      $model->datetime = Input::get('datetime');



      $model->update();
    }

    return redirect("admin/post");
  }
  public function UpdateShow(Request $request)
  {
    $validatedData = $request->validate([

      'id' => 'required',


    ]);

    $gcainfo = GcaInfo::all();

    $model = DB::table("posts")
      ->select(['posts.*', 'postgroups.post_category_group_id'])
      ->leftJoin("postgroups", "postgroups.id", "=", "posts.group")
      ->where("posts.group", "=", $request->input("id"))
      ->get();
    $cat = postcategory::all()->where("language_id", "=", $this->getlang());
    $lang = language::all();
    //dd($model);

    return view("admin.post_edit", [
      'model' => $model,
      'languages' => $lang,
      'category' => $cat,
      'gcainfo' => $gcainfo,
      'group' => $request->input("id"),
    ]);
  }
  public function Delete(Request $request)
  {

    $validatedData = $request->validate([

      'id' => 'required',

    ]);
    $model = post::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = post::find($value->id)->delete();
    }


    return redirect("admin/post");
  }
  public function InsertShow()
  {

    $model = language::all();

    $gcainfo = GcaInfo::all();
    $cat = postcategory::all()->where("language_id", "=", $this->getlang());
    return view('admin.post_add', [
      'languages' => $model,
      'category' => $cat,
      'gcainfo' => $gcainfo,
    ]);
  }
}
