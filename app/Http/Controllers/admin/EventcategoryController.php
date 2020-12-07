<?php

namespace App\Http\Controllers\admin;

use App\language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\eventcategory;


class EventcategoryController extends Controller
{
  private function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }
  public function Index(Request $request)
  {

    if ($request->has("search")) {
      $model = \DB::table("eventcategories")
        ->select(['eventcategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "eventcategories.language_id")
        ->where("eventcategories.language_id", "=", $this->getlang())
        ->where("eventcategories.category_name", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("eventcategories")
        ->select(['eventcategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "eventcategories.language_id")
        ->where("language_id", "=", $this->getlang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = language::all()->where('status', '=', '1');
    return view("admin.eventcategory", [
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
      $model = new eventcategory();
      if (isset($request->input("category_name")[$key]))
        $model->category_name = $request->input("category_name")[$key];
      else
        $model->category_name = "";
      $model->language_id = $value;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/eventcategory");
  }
  public function InsertShow()
  {
    $lang = language::all();
    return view("admin.eventcategory_add", [

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
      $model = eventcategory::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      if (isset($request->input("category_name")[$key]))
        $model->category_name = $request->input("category_name")[$key];
      else
        $model->category_name = "";


      $model->update();
    }
    return redirect("admin/eventcategory");
  }
  public function UpdateShow(Request $request)
  {
    $model  = eventcategory::all()->where("group", "=", $request->input("id"));
    $lang = language::all();
    return view("admin.eventcategory_edit", [

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
    $model = eventcategory::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = eventcategory::find($value->id)->delete();
    }

    return redirect("admin/eventcategory");
  }
  private function getgroup_id()
  {
    return time();
  }
}
