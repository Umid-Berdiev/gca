<?php

namespace App\Http\Controllers\admin;

use App\Language;
use App\Sorovvote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sorovnoma;
use App\Sorovnoma_atter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SorovnomaController extends Controller
{
  private function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", app()->getLocale())->first();
    if ($model)
      return $model->id;
    else {
      $model = Language::all()->where('status', '=', '1')->where("language_prefix", 'en')->first();
      return $model->id;
    }
  }
  public static function getsorovs($javob_id)
  {

    $total = sorovvote::all()->where("javob_grp_id", "=", $javob_id)->count();

    return $total;
  }
  public function IndexAtter(Request $request)
  {
    $model = DB::table("sorovnomas")
      ->select(['sorovnomas.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")
      ->where("languages.status", "=", 1)
      ->where("language_id", "=", $this->getLang())
      ->where("sorovnomas.group", "=", $request->input("id"))->first();

    $javobs = DB::table("sorovnoma_atters")
      ->select(['sorovnoma_atters.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
      ->where("languages.status", "=", 1)
      ->where("sorovnoma_atters.language_id", "=", $this->getLang())
      ->where("sorovnoma_atters.savol_id", "=", $model->group)->paginate(10);
    $lang = Language::where('status', 1)->get();

    return view("admin.sorovatter", [
      'savol' => $model,
      'table' => $javobs,
      'languages' => $lang,
    ]);
  }
  public function vote(Request $request)
  {
    $model = new sorovvote();
    $model->javob_grp_id = $request->post("id");
    $model->ip = $request->session()->getId();
    $model->save();

    $savol =  DB::table("sorovnomas")
      ->select(['sorovnomas.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")

      ->where("sorovnomas.language_id", "=", $request->input("lang"))


      ->first();

    $type = DB::table("sorovvotes")->where("ip", "=", Session::getId())->first();

    if ($type) {
      $tb = DB::table("sorovnoma_atters")
        ->select(['sorovnoma_atters.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
        ->where("sorovnoma_atters.language_id", "=", $request->input("lang"))
        ->where("sorovnoma_atters.savol_id", "=", $savol->group)->get();

      $total = 0;
      foreach ($tb as $value) {
        $tot =  \App\sorovvote::all()->where("javob_grp_id", "=", $value->group)->count();
        $total += $tot;
      }

      $table_return = [];

      foreach ($tb as $key => $value) {

        $counts = (\App\Http\Controllers\admin\SorovnomaController::getsorovs($value->group) * 100) / $total;

        array_push($table_return, ['text' => $value->javob, 'count' => $counts, 'count_round' => round($counts)]);
      }

      return [
        'savol' => $savol->savol,
        'javob' => $table_return,
        'type' => 'stat',

      ];
    } else {
      $tb = DB::table("sorovnoma_atters")
        ->select(['sorovnoma_atters.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
        ->where("sorovnoma_atters.language_id", "=", $request->input("lang"))
        ->where("sorovnoma_atters.savol_id", "=", $savol->group)->get();

      return [
        'savol' => $savol->savol,
        'javob' => $tb,
        'type' => 'check',

      ];
    }
  }
  public function index(Request $request)
  {

    if ($request->has("search")) {
      $model = DB::table("sorovnomas")
        ->select(['sorovnomas.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")
        ->where("languages.status", "=", 1)
        ->where("sorovnomas.language_id", "=", $this->getLang())
        ->where("sorovnomas.savol", "LIKE", '%' . $request->input("search") . '%')->paginate(10);
    } else {
      $model = DB::table("sorovnomas")
        ->select(['sorovnomas.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")
        ->where("languages.status", "=", 1)
        ->where("language_id", "=", $this->getLang())->paginate(10);
    }


    $lang = Language::where('status', 1)->get();
    return view("admin.sorov", [
      "table" => $model,
      "language" => $lang,
    ]);
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'savol' => 'required|max:255',
      'language_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
      $model = new Sorovnoma();
      $model->savol = $request->input("savol")[$key];
      $model->language_id = $value;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/sorov");
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
    $validator = Validator::make($request->all(), [
      'savol' => 'required|max:255',
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
      $model = Sorovnoma::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->savol = $request->input("savol")[$key];


      $model->update();
    }
    return redirect("admin/sorov");
  }
  public function edit(Request $request, $id)
  {
    $model  = Sorovnoma::where('group', $id)->get();
    $lang = Language::all();
    return view("admin.sorov_edit", [

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
    $model = Sorovnoma::where('group', $id)->get();

    foreach ($model as $value) {
      $mod = Sorovnoma::find($value->id)->delete();
    }

    return redirect("admin/sorov");
  }
  private function getGroupId()
  {
    return time();
  }
}
