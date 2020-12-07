<?php

namespace App\Http\Controllers\admin;

use App\language;
use App\photogallery;
use App\photogallerycategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\doccategory;
use Illuminate\Support\Facades\Storage;


class PhotocategoryController extends Controller
{
  private function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }
  public function Index(Request $request)
  {

    if ($request->has("search")) {
      $model = \DB::table("photogallerycategories")
        ->select(['photogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
        ->where("photogallerycategories.language_id", "=", $this->getlang())
        ->where("photogallerycategories.title", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("photogallerycategories")
        ->select(['photogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
        ->where("language_id", "=", $this->getlang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = language::all()->where('status', '=', '1');
    return view("admin.photocategory", [
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
      $model = new photogallerycategory();
      $model->title = $request->input("title")[$key] ?? null;
      $model->Description = $request->input("Description")[$key] ?? null;
      $model->language_id = $value;
      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }

      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/photocategory");
  }
  public function InsertShow()
  {
    $lang = language::all()->where('status', '=', '1');
    return view("admin.photocategory_add", [

      "languages" => $lang,
    ]);
  }
  public function Update(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'language_id' => 'required',
      'cover' => 'required',
      'Description' => 'required',
      'group' => 'required',

    ]);
    $grp_id = $request->input("group");


    foreach ($request->input("language_id") as $key => $value) {
      $model = photogallerycategory::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->title = $request->input("title")[$key] ?? null;
      $model->Description = $request->input("Description")[$key] ?? null;

      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }


      $model->update();
    }
    return redirect("admin/photocategory");
  }
  public function UpdateShow(Request $request)
  {
    $model  = photogallerycategory::all()->where("group", "=", $request->input("id"));
    $lang = language::all();
    return view("admin.photocategory_edit", [

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
    $model = photogallerycategory::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = photogallerycategory::find($value->id)->delete();
    }

    return redirect("admin/photocategory");
  }
  private function getgroup_id()
  {
    return time();
  }
}
