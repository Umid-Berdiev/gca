<?php

namespace App\Http\Controllers\admin;

use App\language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tendercategory;


class TendercategoryController extends Controller
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
      $model = \DB::table("tendercategories")
        ->select(['tendercategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "tendercategories.language_id")
        ->where("tendercategories.language_id", "=", $this->getlang())
        ->where("tendercategories.category_name", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("tendercategories")
        ->select(['tendercategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "tendercategories.language_id")
        ->where("language_id", "=", $this->getlang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = language::all()->where('status', '=', '1');
    return view("admin.tendercategory", [
      "table" => $model,
      "language" => $lang,
    ]);
  }
  public function Insert(Request $request)
  {
    $validatedData = $request->validate([
      'category_name' => 'required|max:255',
      'language_id' => 'required',

    ]);
    $grp_id = $this->getgroup_id();
    foreach ($request->input("language_id") as $key => $value) {
      $model = new tendercategory();
      $model->category_name = $request->input("category_name")[$key];
      $model->language_id = $value;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/tendercategory");
  }
  public function InsertShow()
  {
    $lang = language::all()->where('status', '=', '1');

    return view("admin.tendercategory_add", [

      "languages" => $lang,
    ]);
  }
  public function Update(Request $request)
  {
    $validatedData = $request->validate([
      'category_name' => 'required|max:255',
      'language_id' => 'required',
      'group' => 'required',

    ]);
    $grp_id = $request->input("group");


    foreach ($request->input("language_id") as $key => $value) {
      $model = tendercategory::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->category_name = $request->input("category_name")[$key];


      $model->update();
    }
    return redirect("admin/tendercategory");
  }
  public function UpdateShow(Request $request)
  {
    $model  = tendercategory::all()->where("group", "=", $request->input("id"));
    $lang = language::all();
    return view("admin.tendercategory_edit", [

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
    $model = tendercategory::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = tendercategory::find($value->id)->delete();
    }

    return redirect("admin/tendercategory");
  }
  private function getgroup_id()
  {
    return time();
  }
}
