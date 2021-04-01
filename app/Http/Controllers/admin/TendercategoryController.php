<?php

namespace App\Http\Controllers\admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tendercategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TendercategoryController extends Controller
{
  public function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", app()->getLocale())->first();
    if ($model) {

      return $model->id;
    } else {
      $model = Language::where('status',  '1')->where("language_prefix", "en")->first();
      return $model->id;
    }
  }
  public function index(Request $request)
  {

    if ($request->has("search")) {
      $model = DB::table("tendercategories")
        ->select(['tendercategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "tendercategories.language_id")
        ->where("tendercategories.language_id", "=", $this->getLang())
        ->where("tendercategories.category_name", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = DB::table("tendercategories")
        ->select(['tendercategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "tendercategories.language_id")
        ->where("language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = Language::where('status', 1)->get();
    return view("admin.tendercategory", [
      "table" => $model,
      "language" => $lang,
    ]);
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_name' => 'required|max:255',
      'language_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
      $model = new tendercategory();
      $model->category_name = $request->input("category_name")[$key];
      $model->language_id = $value;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/tendercategory");
  }
  public function create()
  {
    $lang = Language::where('status', 1)->get();

    return view("admin.tendercategory_add", [

      "languages" => $lang,
    ]);
  }
  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'category_name' => 'required|max:255',
      'language_id' => 'required',
      'group' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $request->input("group");


    foreach ($request->language_ids as $key => $value) {
      $model = tendercategory::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->category_name = $request->input("category_name")[$key];


      $model->update();
    }
    return redirect("admin/tendercategory");
  }
  public function edit(Request $request, $id)
  {
    $model  = tendercategory::where('group', $id)->get();
    $lang = Language::all();
    return view("admin.tendercategory_edit", [

      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
    ]);
  }
  public function destroy(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $model = tendercategory::where('group', $id)->get();

    foreach ($model as $value) {
      $mod = tendercategory::find($value->id)->delete();
    }

    return redirect("admin/tendercategory");
  }
  private function getGroupId()
  {
    return time();
  }
}
