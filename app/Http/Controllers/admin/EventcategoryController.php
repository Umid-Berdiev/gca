<?php

namespace App\Http\Controllers\admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventCategoryController extends Controller
{
  public function index(Request $request)
  {
    if ($request->has("search")) {
      $model = DB::table("eventcategories")
        ->select(['eventcategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "eventcategories.language_id")
        ->where("eventcategories.language_id", "=", $this->getLang())
        ->where("eventcategories.category_name", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = DB::table("eventcategories")
        ->select(['eventcategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "eventcategories.language_id")
        ->where("language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $lang = Language::where('status', 1)->get();

    return view("admin.event_category.index", [
      "table" => $model,
      "language" => $lang,
    ]);
  }

  public function create()
  {
    $languages = Language::all();
    return view("admin.event_category.create", compact('languages'));
  }

  public function store(Request $request)
  {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
      'category_names.*' => 'required|max:40|min:3|unique:eventcategories,category_name',
      'language_ids.*' => 'required|exists:languages,id',
    ], $this->validationMessages());

    if ($validator->fails()) {
      return redirect(route('event-categories.create'))
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      EventCategory::create([
        'category_name' => $request->category_names[$key],
        'language_id' => $value,
        'group' => $grp_id
      ]);
    }

    return redirect(route('event-categories.index'))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = EventCategory::where('group', $id)->get();
    $lang = Language::all();

    return view("admin.event_category.edit", [
      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'category_names.*' => 'required|max:255',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    foreach ($request->language_ids as $key => $value) {
      EventCategory::where("group", $id)
        ->where("language_id", $value)
        ->update(['category_name' => $request->category_names[$key]]);
    }

    return redirect(route('event-categories.index'))->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    EventCategory::where('group', $id)->delete();
    return redirect(route('event-categories.index'))->with('success', 'Deleted!');
  }

  private function getGroupId()
  {
    return time();
  }

  private function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", app()->getLocale())->first();

    return $model->id;
  }

  private function validationMessages()
  {
    return [
      'required' => 'Обязательное :attribute поле',
      'unique' => ':input уже есть в базе',
      'exists' => ':input нет в базе',
      'min' => ':input минимум 3 буквы',
      'max' => ':input максимум 40 буквы',

    ];
  }
}
