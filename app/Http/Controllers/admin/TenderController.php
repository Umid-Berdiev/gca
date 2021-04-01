<?php

namespace App\Http\Controllers\admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tendercategory;
use App\Tender;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class TenderController extends Controller
{
  public function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", app()->getLocale())->first();
    if ($model) {

      return $model->id;
    } else {
      $model = Language::where('status', '1')->where("language_prefix", "en")->first();
      return $model->id;
    }
  }
  public function index(Request $request)
  {

    if ($request->has("search")) {
      $model = DB::table("tenders")
        ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
        ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
        ->where("tendercategories.language_id", "=", $this->getLang())
        ->where("tenders.language_id", "=", $this->getLang())
        ->where("tenders.title", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("tenders.description", "LIKE", '%' . $request->input("search") . '%')


        ->paginate(10);
    } else {
      $model = DB::table("tenders")
        ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
        ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
        ->where("tendercategories.language_id", "=", $this->getLang())
        ->where("tenders.language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = Language::all();
    $doccat = tendercategory::where("language_id", $this->getLang())->get();
    return view("admin.tender", [
      "table" => $model,
      "language" => $lang,
      "category" => $doccat,
    ]);
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'language_id' => 'required',
      'cover' => 'required',
      'deadline' => 'required',
      'tender_category_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
      $model = new tender();
      if (isset($request->input("title")[$key]))
        $model->title = $request->input("title")[$key];
      else
        $model->title = "";
      if (isset($request->input("description")[$key]))
        $model->description = $request->input("description")[$key];
      else
        $model->description = "";

      $model->deadline = $request->input("deadline");

      $model->tender_category_id = $request->input("tender_category_id");
      $model->group = $grp_id;
      $model->received = $request->input("received") ?? 0;
      $model->viewcount = 0;
      $model->language_id = $value;

      if ($request->hasFile("cover")) {
        $image      = $request->file('cover');
        $model->cover = Storage::disk('public')->put('photos/1', $image, 'public');
      }


      $model->save();
    }

    return redirect("/admin/tender");
  }
  public function create()
  {
    $lang = Language::all();
    $doccat = tendercategory::where("language_id", $this->getLang())->get();
    return view("admin.tender_add", [

      "languages" => $lang,
      "category" => $doccat,
    ]);
  }
  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'language_id' => 'required',
      'deadline' => 'required',
      'tender_category_id' => 'required',
      'group' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $request->input("group");


    foreach ($request->language_ids as $key => $value) {
      $model = tender::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      if (isset($request->input("title")[$key]))
        $model->title = $request->input("title")[$key];
      else
        $model->title = "";
      if (isset($request->input("description")[$key]))
        $model->description = $request->input("description")[$key];
      else
        $model->description = "";

      $model->deadline = $request->input("deadline");

      $model->tender_category_id = $request->input("tender_category_id");
      $model->group = $grp_id;
      $model->received = $request->input("received") ?? 0;
      $model->viewcount = 0;
      $model->language_id = $value;
      if ($request->hasFile("cover")) {
        $model->photo_url = Storage::putFileAs('public', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      }






      $model->update();
    }
    return redirect("admin/tender");
  }
  public function edit(Request $request, $id)
  {
    $model  = tender::where('group', $id)->get();
    $lang = Language::all();
    $doccat = tendercategory::where("language_id", $this->getLang())->get();
    return view("admin.tender_edit", [

      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
      "category" => $doccat,
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

    $model = tender::where('group', $id)->get();

    foreach ($model as $value) {
      $mod = tender::find($value->id)->delete();
    }

    return redirect("admin/tender");
  }
  private function getGroupId()
  {
    return time();
  }
}
