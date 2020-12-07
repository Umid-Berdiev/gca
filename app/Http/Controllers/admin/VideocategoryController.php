<?php

namespace App\Http\Controllers\admin;

use App\language;
use App\photogallery;
use App\videogallerycategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;


class VideocategoryController extends Controller
{
  public function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();
    if ($model) {

      return $model->id;
    } else {
      $model = language::all()->where('status', '=', '1')->where("language_prefix", "en")->first();
      return $model->id;
    }
  }
  public function Index(Request $request)
  {

    if ($request->has("search")) {
      $model = \DB::table("videogallerycategories")
        ->select(['videogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "videogallerycategories.language_id")
        ->where("videogallerycategories.language_id", "=", $this->getlang())
        ->where("videogallerycategories.title", "LIKE", '%' . $request->input("search") . '%')->paginate(10);
    } else {
      $model = \DB::table("videogallerycategories")
        ->select(['videogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "videogallerycategories.language_id")
        ->where("language_id", "=", $this->getlang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = language::all()->where('status', '=', '1');
    return view("admin.videocategory", [
      "table" => $model,
      "language" => $lang,
    ]);
  }
  public function Insert(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'language_id' => 'required',
      'cover' => 'required',
      'Description' => 'required',

    ]);
    $grp_id = $this->getgroup_id();
    foreach ($request->input("language_id") as $key => $value) {
      $model = new videogallerycategory();
      $model->title = $request->input("title")[$key];
      $model->Description = $request->input("Description")[$key];
      $model->language_id = $value;
      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }

      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/videocategory");
  }
  public function InsertShow()
  {
    $lang = language::all()->where('status', '=', '1');
    return view("admin.videocategory_add", [

      "languages" => $lang,
    ]);
  }
  public function Update(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'language_id' => 'required',

      'Description' => 'required',
      'group' => 'required',

    ]);
    $grp_id = $request->input("group");



    foreach ($request->input("language_id") as $key => $value) {
      $model = videogallerycategory::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->title = $request->input("title")[$key];
      $model->Description = $request->input("Description")[$key];

      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }



      $model->update();
    }
    return redirect("admin/videocategory");
  }
  public function UpdateShow(Request $request)
  {
    $model  = videogallerycategory::all()->where("group", "=", $request->input("id"));
    $lang = language::all()->where('status', '=', '1');
    return view("admin.videocategory_edit", [

      "languages" => $lang,
      "model" => $model,
      "grp_id" => $request->input("id"),
    ]);
  }
  public function Delete(Request $request)
  {
    $validatedData = $request->validate([

      'id' => 'required',

    ]);
    $model = videogallerycategory::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = videogallerycategory::find($value->id)->delete();
    }

    return redirect("admin/videocategory");
  }
  private function getgroup_id()
  {
    return time();
  }
}
