<?php

namespace App\Http\Controllers\admin;

use App\language;
use App\photogallery;
use App\photogallerycategory;
use App\videogallerycategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\doccategory;
use App\doc;
use Illuminate\Support\Facades\Storage;


class PhotoController extends Controller
{
  private function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }
  public function Index(Request $request)
  {

    if ($request->has("search")) {
      $model = \DB::table("photogalleries")
        ->select(['photogalleries.*', 'languages.language_name', 'photogallerycategories.title'])
        ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
        ->leftJoin("photogallerycategories", "photogallerycategories.group", "=", "photogalleries.category_id")
        ->where("photogalleries.language_id", "=", $this->getlang())
        ->where("photogallerycategories.language_id", "=", $this->getlang())
        ->where("photogalleries.name", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("photogalleries.name", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("photogalleries.description", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("photogalleries")
        ->select(['photogalleries.*', 'languages.language_name', 'photogallerycategories.title'])
        ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
        ->leftJoin("photogallerycategories", "photogallerycategories.group", "=", "photogalleries.category_id")
        ->where("photogalleries.language_id", "=", $this->getlang())
        ->where("photogallerycategories.language_id", "=", $this->getlang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = language::all()->where('status', '=', '1');
    $doccat = photogallerycategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.photo", [
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
      $model = new photogallery();
      $model->name = $request->input("name")[$key] ?? "";
      $model->description = $request->input("description")[$key] ?? "";

      $model->category_id = $request->input("category_id") ?? "";
      $model->group = $grp_id ?? "";
      $model->language_id = $value;
      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }


      $model->save();
    }

    return redirect("/admin/photo");
  }
  public function InsertShow()
  {
    $lang = language::all()->where('status', '=', '1');
    $doccat = photogallerycategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.photo_add", [

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
      $model = photogallery::all()
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
    $model  = photogallery::all()->where("group", "=", $request->input("id"));
    $lang = language::all();
    $doccat = photogallerycategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.photo_edit", [

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
    $model = photogallery::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = photogallery::find($value->id)->delete();
    }

    return redirect("admin/photo");
  }
  private function getgroup_id()
  {
    return time();
  }
}
