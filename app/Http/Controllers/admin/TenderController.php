<?php

namespace App\Http\Controllers\admin;

use App\language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tendercategory;
use App\tender;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class TenderController extends Controller
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
      $model = \DB::table("tenders")
        ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
        ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
        ->where("tendercategories.language_id", "=", $this->getlang())
        ->where("tenders.language_id", "=", $this->getlang())
        ->where("tenders.title", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("tenders.description", "LIKE", '%' . $request->input("search") . '%')


        ->paginate(10);
    } else {
      $model = \DB::table("tenders")
        ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
        ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
        ->where("tendercategories.language_id", "=", $this->getlang())
        ->where("tenders.language_id", "=", $this->getlang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = language::all();
    $doccat = tendercategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.tender", [
      "table" => $model,
      "language" => $lang,
      "category" => $doccat,
    ]);
  }
  public function Insert(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'language_id' => 'required',


      'cover' => 'required',

      'deadline' => 'required',
      'tender_category_id' => 'required',


    ]);
    $grp_id = $this->getgroup_id();
    foreach ($request->input("language_id") as $key => $value) {
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
  public function InsertShow()
  {
    $lang = language::all();
    $doccat = tendercategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.tender_add", [

      "languages" => $lang,
      "category" => $doccat,
    ]);
  }
  public function Update(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'language_id' => 'required',




      'deadline' => 'required',
      'tender_category_id' => 'required',
      'group' => 'required',


    ]);


    $grp_id = $request->input("group");


    foreach ($request->input("language_id") as $key => $value) {
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
        $model->photo_url = Storage::putFile('public', $request->file('cover'));
      }






      $model->update();
    }
    return redirect("admin/tender");
  }
  public function UpdateShow(Request $request)
  {
    $model  = tender::all()->where("group", "=", $request->input("id"));
    $lang = language::all();
    $doccat = tendercategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.tender_edit", [

      "languages" => $lang,
      "model" => $model,
      "grp_id" => $request->input("id"),
      "category" => $doccat,
    ]);
  }
  public function Delete(Request $request)
  {
    $validatedData = $request->validate([

      'id' => 'required',

    ]);
    $model = tender::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = tender::find($value->id)->delete();
    }

    return redirect("admin/tender");
  }
  private function getgroup_id()
  {
    return time();
  }
}
