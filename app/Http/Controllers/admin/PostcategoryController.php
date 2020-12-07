<?php

namespace App\Http\Controllers\admin;

use App\language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\postcategory;


class PostcategoryController extends Controller
{
  private function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }
  public function Index(Request $request)
  {

    if ($request->has("search")) {
      $model = \DB::table("postcategories")
        ->select(['postcategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
        ->where("postcategories.language_id", "=", $this->getlang())
        ->where("postcategories.category_name", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("postcategories")
        ->select(['postcategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
        ->where("language_id", "=", $this->getlang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = language::all()->where('status', '=', '1');
    return view("admin.postcategory", [
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
      $model = new postcategory();
      $model->category_name = $request->input("category_name")[$key];
      $model->language_id = $value;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/postcategory");
  }
  public function InsertShow()
  {
    $lang = language::all();
    return view("admin.postcategory_add", [

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
      $model = postcategory::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->category_name = $request->input("category_name")[$key];


      $model->update();
    }
    return redirect("admin/postcategory");
  }
  public function UpdateShow(Request $request)
  {
    $model  = postcategory::all()->where("group", "=", $request->input("id"));
    $lang = language::all();
    return view("admin.postcategory_edit", [

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
    $model = postcategory::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = postcategory::find($value->id)->delete();
    }

    return redirect("admin/postcategory");
  }
  private function getgroup_id()
  {
    return time();
  }
}
