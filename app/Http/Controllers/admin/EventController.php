<?php

namespace App\Http\Controllers\admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventCategory;
use App\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
  public function index(Request $request)
  {

    if ($request->has("search")) {
      $table = \DB::table("events")
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
      $table = \DB::table("events")
        ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "events.language_id")
        ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
        ->where("events.language_id", "=", $this->getLang())
        ->where("eventcategories.language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $languages = Language::where('status', 1)->get();
    $categories = EventCategory::where("language_id", $this->getLang())->get();

    return view("admin.event.index", compact(
      "table",
      "languages",
      "categories"
    ));
  }

  public function create()
  {
    $languages = Language::where('status', 1)->get();
    $categories = EventCategory::where("language_id", $this->getLang())->get();

    return view("admin.event.create", compact("languages", "categories"));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_id' => 'required',
      'titles.*' => 'required|max:200|min:3|unique:events,title',
      'dateend' => 'required',
      'datestart' => 'required',
      'cover' => 'required',
    ]);
    // dd($request->language_ids);

    if ($validator->fails()) {
      return redirect(route('events.create'))
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = Event::create([
        'title' => $request->titles[$key],
        'description' => $request->descriptions[$key],
        'content' => $request->contents[$key],
        'organization' => $request->organizations[$key],
        'dateend' => $request->dateend,
        'datestart' => $request->datestart,
        'event_category_id' => $request->category_id,
        'group' => $grp_id,
        'language_id' => $value,
        'cover' => $request->file('cover')->getClientOriginalName(),
      ]);

      if ($request->hasFile('cover')) {
        Storage::putFileAs('public/photos', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      }
    }

    return redirect(route('events.edit', $model->group))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = Event::where('group', $id)->get();
    $languages = Language::all();
    $categories = EventCategory::where("language_id", $this->getLang())->get();;

    return view("admin.event.edit", [
      "model" => $model,
      "languages" => $languages,
      "grp_id" => $id,
      "categories" => $categories,
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'category_id' => 'required',
      'titles.*' => 'required|max:200|min:3|unique:events,title',
      'dateend' => 'required',
      'datestart' => 'required',
      'cover' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    foreach ($request->language_ids as $key => $value) {
      Event::where("group", $id)
        ->where("language_id", "=", $value)
        ->update([
          'title' => $request->titles[$key],
          'description' => $request->descriptions[$key],
          'content' => $request->contents[$key],
          'organization' => $request->organizations[$key],
          'dateend' => $request->dateend,
          'datestart' => $request->datestart,
          'event_category_id' => $request->category_id,
          'language_id' => $value,
          'cover' => $request->file('cover')->getClientOriginalName(),
        ]);

      if ($request->hasFile("cover")) {
        Storage::putFileAs('public/photos', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      }
    }

    return back()->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    Event::where('group', $id)->delete();
    return redirect(route('events.index'))->with('success', 'Deleted!');
  }

  private function getGroupId()
  {
    return time();
  }

  private function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", \App::getLocale())->first();

    return $model->id;
  }
}
