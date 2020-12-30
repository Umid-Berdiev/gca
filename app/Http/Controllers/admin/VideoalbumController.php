<?php

namespace App\Http\Controllers\admin;

use App\Language;
use App\Videoalbum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VideoalbumController extends Controller
{
  public function index(Request $request)
  {
    if ($request->has("search")) {
      $model = \DB::table("videogallerycategories")
        ->select(['videogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "videogallerycategories.language_id")
        ->where("videogallerycategories.language_id", $this->getLang())
        ->where("videogallerycategories.title", "LIKE", '%' . $request->input("search") . '%')->paginate(10);
    } else {
      $model = \DB::table("videogallerycategories")
        ->select(['videogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "videogallerycategories.language_id")
        ->where("language_id", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $lang = Language::where('status', '1')->get();

    return view("admin.videoalbum.index", [
      "table" => $model,
      "language" => $lang,
    ]);
  }

  public function create()
  {
    $lang = Language::all()->where('status', '1');

    return view("admin.videoalbum.create", [
      "languages" => $lang,
    ]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'titles.*' => 'required|max:40',
      'language_ids.*' => 'required',
      'descriptions.*' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new Videoalbum();
      $model->title = $request->titles[$key];
      $model->Description = $request->descriptions[$key];
      $model->language_id = $value;
      $model->group = $grp_id;

      if ($request->hasFile("cover")) {
        $model->cover = $request->file('cover')->getClientOriginalName();
        Storage::putFileAs('public', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      } else $model->cover = "videogallery.png";

      $model->save();
    }

    return redirect(route('videoalbum.edit', $model->group))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = Videoalbum::where("group", $id)->get();
    $lang = Language::where('status', '1')->get();

    return view("admin.videoalbum.edit", [
      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'titles.*' => 'required|max:40',
      'language_ids.*' => 'required',
      'descriptions.*' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $id;

    foreach ($request->language_ids as $key => $value) {
      $model = Videoalbum::where("group", $grp_id)
        ->where("language_id", $value)
        ->first();
      $model->title = $request->titles[$key];
      $model->Description = $request->descriptions[$key];

      if ($request->hasFile("cover")) {
        $model->cover = $request->file('cover')->getClientOriginalName();
        Storage::putFileAs('public', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      } else $model->cover = "videogallery.png";

      if ($request->remove_cover == "on") {
        $model->cover = "videogallery.png";
      }

      $model->update();
    }

    return back()->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    Videoalbum::where("group", $id)->delete();
    return redirect(route('videoalbum.index'))->with('success', 'Deleted!');
  }

  private function getGroupId()
  {
    return time();
  }

  public function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", \App::getLocale())->first();
    if ($model) {
      return $model->id;
    } else {
      $model = Language::where('status', '1')->where("language_prefix", "en")->first();
      return $model->id;
    }
  }
}
