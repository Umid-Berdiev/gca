<?php

namespace App\Http\Controllers\admin;

use App\language;
use App\videogallery;
use App\videogallerycategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\doccategory;
use App\doc;
use Illuminate\Support\Facades\Storage;


class VideoController extends Controller
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
      $model = \DB::table("videogalleries")
        ->select(['videogalleries.*', 'languages.language_name', 'videogallerycategories.title'])
        ->leftJoin("languages", "languages.id", "=", "videogalleries.language_id")
        ->leftJoin("videogallerycategories", "videogallerycategories.group", "=", "videogalleries.category_id")
        ->where("videogalleries.language_id", "=", $this->getlang())
        ->where("videogallerycategories.language_id", "=", $this->getlang())
        ->where("videogalleries.name", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("videogalleries.description", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("videogalleries")
        ->select(['videogalleries.*', 'languages.language_name', 'videogallerycategories.title'])
        ->leftJoin("languages", "languages.id", "=", "videogalleries.language_id")
        ->leftJoin("videogallerycategories", "videogallerycategories.group", "=", "videogalleries.category_id")
        ->where("videogalleries.language_id", "=", $this->getlang())
        ->where("videogallerycategories.language_id", "=", $this->getlang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }




    $lang = language::all()->where('status', '=', '1');
    $doccat = videogallerycategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.video", [
      "table" => $model,
      "language" => $lang,
      "category" => $doccat,
    ]);
  }
  public function Insert(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'description' => 'required|max:255',
      'language_id' => 'required',
      'cover' => 'required',

      'category_id' => 'required',


    ]);
    $grp_id = $this->getgroup_id();
    foreach ($request->input("language_id") as $key => $value) {
      $model = new videogallery();
      $model->name = $request->input("name")[$key];
      $model->description = $request->input("description")[$key];

      $model->category_id = $request->input("category_id");
      $model->group = $grp_id;
      $model->language_id = $value;
      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }


      $model->save();
    }

    return redirect("/admin/video");
  }
  public function InsertShow()
  {
    $lang = language::all()->where('status', '=', '1');
    $doccat = videogallerycategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.video_add", [

      "languages" => $lang,
      "category" => $doccat,
    ]);
  }
  public function Update(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'description' => 'required|max:255',
      'language_id' => 'required',


      'category_id' => 'required',
      'group' => 'required',

    ]);


    $grp_id = $request->input("group");


    foreach ($request->input("language_id") as $key => $value) {
      $model = videogallery::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->name = $request->input("name")[$key];
      $model->description = $request->input("description")[$key];

      $model->category_id = $request->input("category_id");
      $model->group = $grp_id;
      $model->language_id = $value;
      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }



      $model->update();
    }
    return redirect("admin/photo");
  }
  public function UpdateShow(Request $request)
  {
    $model  = videogallery::all()->where("group", "=", $request->input("id"));
    $lang = language::all();
    $doccat = videogallerycategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.video_edit", [

      "languages" => $lang,
      "model" => $model,
      "grp_id" => $request->input("id"),
      "category" => $doccat,
    ]);
  }
  public function Delete(Request $request)
  {
    $validatedData = $request->validate([

      'id' => 'required',

    ]);
    $model = videogallery::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = videogallery::find($value->id)->delete();
    }

    return redirect("admin/video");
  }
  private function getgroup_id()
  {
    return time();
  }
}
