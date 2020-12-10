<?php

namespace App\Http\Controllers\admin;

use App\Language;
use App\Video;
use App\Videoalbum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class VideoController extends Controller
{
  public function index(Request $request)
  {
    if ($request->has("search")) {
      $model = \DB::table("videogalleries")
        ->select(['videogalleries.*', 'languages.language_name', 'videogallerycategories.title'])
        ->leftJoin("languages", "languages.id", "=", "videogalleries.language_id")
        ->leftJoin("videogallerycategories", "videogallerycategories.group", "=", "videogalleries.category_id")
        ->where("videogalleries.language_id", "=", $this->getLang())
        ->where("videogallerycategories.language_id", "=", $this->getLang())
        ->where("videogalleries.name", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("videogalleries.description", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("videogalleries")
        ->select(['videogalleries.*', 'languages.language_name', 'videogallerycategories.title'])
        ->leftJoin("languages", "languages.id", "=", "videogalleries.language_id")
        ->leftJoin("videogallerycategories", "videogallerycategories.group", "=", "videogalleries.category_id")
        ->where("videogalleries.language_id", "=", $this->getLang())
        ->where("videogallerycategories.language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $lang = Language::all()->where('status', '1');
    $doccat = Videoalbum::where("language_id", $this->getLang())->get();

    return view("admin.video.index", [
      "table" => $model,
      "language" => $lang,
      "category" => $doccat,
    ]);
  }

  public function create()
  {
    $lang = Language::where('status', 1)->get();
    $doccat = Videoalbum::where("language_id", $this->getLang())->get();
    return view("admin.video.create", [

      "languages" => $lang,
      "category" => $doccat,
    ]);
  }

  public function store(Request $request)
  {
    // dd($request->all());

    // $request->validate([
    //   'names' => 'required|array',
    //   'names.*' => 'required|string|max:255',
    //   'descriptions.*' => 'required|max:255',
    //   'links.*' => 'max:255',
    //   'language_id.*' => 'required',
    //   'cover' => 'required',
    //   'category_id' => 'required',
    // ]);

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new Video();
      $model->name = $request->input("names")[$key];
      $model->description = $request->input("descriptions")[$key];
      $model->youtube_link = $request->input("links")[$key];
      $model->category_id = $request->input("category_id");
      $model->group = $grp_id;
      $model->language_id = $value;

      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      } else {
        $model->cover = "null";
      }

      $model->save();
    }

    return redirect(route('video.index'));
  }

  public function edit(Request $request, $id)
  {
    $model  = Video::where("group", $id)->get();
    $lang = Language::all();
    $doccat = Videoalbum::where("language_id", $this->getLang())->get();

    return view("admin.video.edit", [
      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
      "category" => $doccat,
    ]);
  }

  public function update(Request $request, $id)
  {
    // $request->validate([
    //   'name' => 'required|max:255',
    //   'description' => 'required|max:255',
    //   'language_id' => 'required',
    //   'category_id' => 'required',
    //   'group' => 'required',
    // ]);

    foreach ($request->input("language_ids") as $key => $value) {
      $model = Video::where("group", $id)
        ->where("language_id", $value)
        ->first();
      $model->name = $request->input("names")[$key];
      $model->description = $request->input("descriptions")[$key];
      $model->youtube_link = $request->input("links")[$key];
      $model->category_id = $request->input("category_id");
      $model->group = $id;
      $model->language_id = $value;

      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      } else {
        $model->cover = "null";
      }

      $model->update();
    }

    return back();
  }

  public function show()
  {
    # code...
  }

  public function destroy($id)
  {
    $model = Video::all()->where("group", $id);

    foreach ($model as $value) {
      Video::find($value->id)->delete();
    }

    return back();
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

  private function getGroupId()
  {
    return time();
  }
}
