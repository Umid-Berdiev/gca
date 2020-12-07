<?php

namespace App\Http\Controllers\admin;

use App\language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\doccategory;


class DoccategoryController extends Controller
{
  private function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }
  public function Index(Request $request)
  {

    if ($request->has("search")) {
      $model = \DB::table("doccategories")
        ->select(['doccategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "doccategories.language_id")
        ->where("doccategories.language_id", "=", $this->getlang())
        ->where("doccategories.category_name", "LIKE", '%' . $request->input("search") . '%')->orderBy('id', 'desc')->paginate(10);
    } else {
      $model = \DB::table("doccategories")
        ->select(['doccategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "doccategories.language_id")
        ->where("language_id", "=", $this->getlang())->orderBy('id', 'desc')->paginate(10);
    }


    $lang = language::all();
    return view("admin.doccategory", [
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
      $model = new doccategory();
      if (isset($request->input("category_name")[$key])) {
        $model->category_name = $request->input("category_name")[$key];
      } else {
        $model->category_name = "";
      }

      $model->language_id = $value;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/doccategory");
  }
  public function InsertShow()
  {
    $lang = language::all()->where('status', '=', '1');
    return view("admin.doccategory_add", [

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
      $model = doccategory::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      if (isset($request->input("category_name")[$key])) {
        $model->category_name = $request->input("category_name")[$key];
      } else {
        $model->category_name = "";
      }



      $model->update();
    }
    return redirect("admin/doccategory");
  }
  public function UpdateShow(Request $request)
  {
    $model  = doccategory::all()->where("group", "=", $request->input("id"));
    $lang = language::all()->where('status', '=', '1');
    return view("admin.doccategory_edit", [

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
    $model = doccategory::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = doccategory::find($value->id)->delete();
    }

    return redirect("admin/doccategory");
  }
  private function getgroup_id()
  {
    return time();
  }
}
