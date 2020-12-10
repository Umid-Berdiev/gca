<?php

namespace App\Http\Controllers\admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\eventcategory;
use App\event;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
  private function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", \App::getLocale())->first();

    return $model->id;
  }
  public function index(Request $request)
  {

    if ($request->has("search")) {
      $model = \DB::table("events")
        ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "events.language_id")
        ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
        ->where("events.language_id", "=", $this->getLang())
        ->where("eventcategories.language_id", "=", $this->getLang())
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
        ->where("events.language_id", "=", $this->getLang())
        ->where("eventcategories.language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = Language::where('status', 1)->get();
    $doccat = eventcategory::where("language_id", $this->getLang())->get();
    return view("admin.event", [
      "table" => $model,
      "language" => $lang,
      "category" => $doccat,
    ]);
  }
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'language_id' => 'required',
      'event_category_id' => 'required',
      'dateend' => 'required',
      'datestart' => 'required',


    ]);
    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
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
  public function create()
  {
    $lang = Language::where('status', 1)->get();
    $doccat = eventcategory::where("language_id", $this->getLang())->get();
    return view("admin.event_add", [

      "languages" => $lang,
      "category" => $doccat,
    ]);
  }
  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'language_id' => 'required',
      'dateend' => 'required',
      'datestart' => 'required',
      'event_category_id' => 'required',
      'group' => 'required',

    ]);


    $grp_id = $request->input("group");


    foreach ($request->language_ids as $key => $value) {
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
  public function edit(Request $request, $id)
  {
    $model  = event::where('group', $id)->get();
    $lang = Language::all();
    $doccat = eventcategory::where("language_id", $this->getLang())->get();;
    return view("admin.event_edit", [

      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
      "category" => $doccat,
    ]);
  }
  public function destroy(Request $request, $id)
  {
    $validatedData = $request->validate([

      'id' => 'required',

    ]);
    $model = event::where('group', $id)->get();

    foreach ($model as $value) {
      $mod = event::find($value->id)->delete();
    }

    return redirect("admin/event");
  }
  private function getGroupId()
  {
    return time();
  }
}
