<?php

namespace App\Http\Controllers\admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\eventcategory;


class EventcategoryController extends Controller
{
  private function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", \App::getLocale())->first();

    return $model->id;
  }
  public function index(Request $request)
  {

    if ($request->has("search")) {
      $model = \DB::table("eventcategories")
        ->select(['eventcategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "eventcategories.language_id")
        ->where("eventcategories.language_id", "=", $this->getLang())
        ->where("eventcategories.category_name", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("eventcategories")
        ->select(['eventcategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "eventcategories.language_id")
        ->where("language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = Language::where('status', 1)->get();
    return view("admin.eventcategory", [
      "table" => $model,
      "language" => $lang,
    ]);
  }
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'category_name' => 'required|max:255',
      'language_id' => 'required',

    ]);
    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
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
  public function create()
  {
    $lang = Language::all();
    return view("admin.eventcategory_add", [

      "languages" => $lang,
    ]);
  }
  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'category_name' => 'required|max:255',
      'language_id' => 'required',
      'group' => 'required',

    ]);
    $grp_id = $request->input("group");


    foreach ($request->language_ids as $key => $value) {
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
  public function edit(Request $request, $id)
  {
    $model  = eventcategory::where('group', $id)->get();
    $lang = Language::all();
    return view("admin.eventcategory_edit", [

      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
    ]);
  }
  public function destroy(Request $request, $id)
  {
    $validatedData = $request->validate([

      'id' => 'required',

    ]);
    $model = eventcategory::where('group', $id)->get();

    foreach ($model as $value) {
      $mod = eventcategory::find($value->id)->delete();
    }

    return redirect("admin/eventcategory");
  }
  private function getGroupId()
  {
    return time();
  }
}
