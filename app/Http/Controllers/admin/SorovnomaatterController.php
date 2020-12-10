<?php

namespace App\Http\Controllers\admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sorovnoma;
use App\Sorovnoma_atter;
use Illuminate\Support\Facades\Input;


class SorovnomaatterController extends Controller
{
  private function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", \App::getLocale())->first();
    if ($model)
      return $model->id;
    else {
      $model = Language::all()->where('status', '=', '1')->where("language_prefix", 'en')->first();
      return $model->id;
    }
  }
  public function index(Request $request)
  {


    $model = \DB::table("sorovnomas")
      ->select(['sorovnomas.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")
      ->where("sorovnomas.group", "=", $request->input("id"))
      ->orWhere("sorovnomas.id", "=", $request->input("id"))
      ->first();
    //dd($model);

    if ($request->has("search")) {

      $javobs = \DB::table("sorovnoma_atters")
        ->select(['sorovnoma_atters.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
        ->where("languages.status", "=", 1)
        ->where("sorovnoma_atters.language_id", "=", $this->getLang())
        ->where("sorovnoma_atters.savol_id", "=", $model->group)
        ->where("sorovnoma_atters.javob", "LIKE", '%' . $request->input("search") . '%')
        ->paginate(10);
    } else {
      $javobs = \DB::table("sorovnoma_atters")
        ->select(['sorovnoma_atters.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
        ->where("languages.status", "=", 1)
        ->where("sorovnoma_atters.language_id", "=", $this->getLang())
        ->where("sorovnoma_atters.savol_id", "=", $model->group)->paginate(10);
    }
    $lang = Language::where('status', 1)->get();
    return view("admin.sorovatter", [
      'savol' => $model,
      'table' => $javobs,
      'languages' => $lang,
    ]);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'javob' => 'required|max:255',
      'language_id' => 'required',
      'savol_id' => 'required',

    ]);
    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
      $model = new Sorovnoma_atter();
      $model->javob = $request->input("javob")[$key];
      $model->savol_id = $request->input("savol_id");
      $model->language_id = $value;
      $model->order = 0;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/sorovatter?id=" . $request->input("savol_id"));
  }
  public function create()
  {
    $lang = Language::all();
    return view("admin.sorov_add", [

      "languages" => $lang,
    ]);
  }
  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'javob' => 'required|max:255',
      'language_id' => 'required',
      'savol_id' => 'required',
      'group' => 'required',

    ]);
    $grp_id = $request->input("group");


    foreach ($request->language_ids as $key => $value) {
      $model = Sorovnoma_atter::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->where("savol_id", "=", $request->input("savol_id"))
        ->first();
      $model->javob = $request->input("javob")[$key];


      $model->update();
    }
    return redirect("admin/sorovatter?id=" . $request->input("savol_id"));
  }
  public function edit(Request $request, $id)
  {
    $model  = Sorovnoma_atter::all()->where("group", "=", $request->input("id"))->all();



    $lang = Language::where('status', 1)->get();
    return view("admin.sorovatter_edit", [

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
    $model = Sorovnoma_atter::where('group', $id)->get();

    foreach ($model as $value) {
      $mod = Sorovnoma_atter::find($value->id)->delete();
    }

    return back();
  }
  private function getGroupId()
  {
    return time();
  }
}
