<?php

namespace App\Http\Controllers\admin;

use App\language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\eventcategory;
use App\event;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
  private function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }
  public function Index(Request $request)
  {

    if ($request->has("search")) {
      $model = \DB::table("events")
        ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "events.language_id")
        ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
        ->where("events.language_id", "=", $this->getlang())
        ->where("eventcategories.language_id", "=", $this->getlang())
        ->where("events.title", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("events.description", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("events.organization", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("events")
        ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "events.language_id")
        ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
        ->where("events.language_id", "=", $this->getlang())
        ->where("eventcategories.language_id", "=", $this->getlang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = language::all()->where('status', '=', '1');
    $doccat = eventcategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.event", [
      "table" => $model,
      "language" => $lang,
      "category" => $doccat,
    ]);
  }
  public function Insert(Request $request)
  {
    $validatedData = $request->validate([
      'language_id' => 'required',
      'event_category_id' => 'required',
      'dateend' => 'required',
      'datestart' => 'required',


    ]);
    $grp_id = $this->getgroup_id();
    foreach ($request->input("language_id") as $key => $value) {
      $model = new event();
      if (isset($request->input("title")[$key]))
        $model->title = $request->input("title")[$key];
      else
        $model->title = "";
      if (isset($request->input("description")[$key]))
        $model->description = $request->input("description")[$key];
      else
        $model->description = "";
      if (isset($request->input("content")[$key]))
        $model->content = $request->input("content")[$key];
      else
        $model->content = "";
      if ($request->input("organization")[$key])
        $model->organization = $request->input("organization")[$key];
      else
        $model->organization = "";

      $model->dateend = $request->input("dateend");
      $model->datestart = $request->input("datestart");
      $model->event_category_id = $request->input("event_category_id");
      $model->group = $grp_id;
      $model->language_id = $value;
      if ($request->hasFile("cover")) {
        $model->cover = Storage::disk('public')->put('photos/1', $request->file('cover'), 'public');
      } else {
        $model->cover = "";
      }


      $model->save();
    }

    return redirect("/admin/event");
  }
  public function InsertShow()
  {
    $lang = language::all()->where('status', '=', '1');
    $doccat = eventcategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.event_add", [

      "languages" => $lang,
      "category" => $doccat,
    ]);
  }
  public function Update(Request $request)
  {
    $validatedData = $request->validate([
      'language_id' => 'required',
      'dateend' => 'required',
      'datestart' => 'required',
      'event_category_id' => 'required',
      'group' => 'required',

    ]);


    $grp_id = $request->input("group");


    foreach ($request->input("language_id") as $key => $value) {
      $model = event::all()
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

      if (isset($request->input("content")[$key]))
        $model->content = $request->input("content")[$key];
      else
        $model->content = "";
      if (isset($request->input("organization")[$key]))
        $model->organization = $request->input("organization")[$key];
      else
        $model->organization = "";
      $model->dateend = $request->input("dateend");
      $model->datestart = $request->input("datestart");
      $model->event_category_id = $request->input("event_category_id");

      $model->language_id = $value;
      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }





      $model->update();
    }
    return redirect("admin/event");
  }
  public function UpdateShow(Request $request)
  {
    $model  = event::all()->where("group", "=", $request->input("id"));
    $lang = language::all();
    $doccat = eventcategory::all()->where("language_id", "=", $this->getlang());;
    return view("admin.event_edit", [

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
    $model = event::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = event::find($value->id)->delete();
    }

    return redirect("admin/event");
  }
  private function getgroup_id()
  {
    return time();
  }
}
