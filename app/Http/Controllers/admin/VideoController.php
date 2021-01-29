<?php

namespace App\Http\Controllers\admin;

use App\Language;
use App\Video;
use App\Videoalbum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
  public function index(Request $request)
  {
    if ($request->has("search")) {
      $model = DB::table("videogalleries")
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
      // $model = DB::table("videogalleries")
      //   ->select(['videogalleries.*', 'languages.language_name', 'videogallerycategories.title'])
      //   ->leftJoin("languages", "languages.id", "=", "videogalleries.language_id")
      //   ->leftJoin("videogallerycategories", "videogallerycategories.group", "=", "videogalleries.category_id")
      //   ->where("videogalleries.language_id", "=", $this->getLang())
      //   ->where("videogallerycategories.language_id", "=", $this->getLang())
      //   ->orderBy('id', 'desc')
      //   ->paginate(10);
      $videos = Video::with('category')->where('language_id', $this->getLang())->latest()->paginate(10);
    }

    $languages = Language::where('status', '1')->get();
    $categories = Videoalbum::where("language_id", $this->getLang())->get();
    // dd($videos);
    return view("admin.video.index", compact('videos', 'languages'));
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
    $validator = Validator::make($request->all(), [
      'names.*' => 'required|max:255',
      'descriptions.*' => 'required|max:255',
      'category_id' => 'required'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $youtube_link = $request->youtube_link;
    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new Video();
      $model->name = $request->names[$key];
      $model->description = $request->descriptions[$key];
      $model->youtube_link = $youtube_link;
      $model->category_id = $request->category_id;
      $model->group = $grp_id;
      $model->language_id = $value;

      if ($youtube_link) {
        $youtube_link_cover = 'https://img.youtube.com/vi/' . $youtube_link . '/sddefault.jpg';
        $img_name = $youtube_link . '-' . basename($youtube_link_cover);
        // \Image::make($youtube_link_cover)->save(public_path('images\\videos\\' . $img_name));
        $img = \Image::make($youtube_link_cover)->encode();
        Storage::put('public/videos/' . $img_name, $img);
        $model->cover = $img_name;
      } else $model->cover = "";

      $model->save();
    }

    return redirect(route('video.edit', $model->group))->with('success', 'Created!');
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
    $validator = Validator::make($request->all(), [
      'names.*' => 'required|max:255',
      'descriptions.*' => 'required|max:255',
      'category_id' => 'required'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $youtube_link = $request->youtube_link;

    foreach ($request->language_ids as $key => $value) {
      $model = Video::where("group", $id)
        ->where("language_id", $value)
        ->first();
      $model->name = $request->names[$key];
      $model->description = $request->descriptions[$key];
      $model->youtube_link = $youtube_link;
      $model->category_id = $request->category_id;
      $model->group = $id;
      $model->language_id = $value;

      if ($youtube_link) {
        $youtube_link_cover = 'https://img.youtube.com/vi/' . $youtube_link . '/sddefault.jpg';
        $img_name = $youtube_link . '-' . basename($youtube_link_cover);
        // \Image::make($youtube_link_cover)->save(public_path('images\\videos\\' . $img_name));
        $img = \Image::make($youtube_link_cover)->encode();
        Storage::put('public/videos/' . $img_name, $img);
        $model->cover = $img_name;
      } else $model->cover = "";

      if ($request->remove_cover == "on") {
        $model->cover = "";
      }

      $model->update();
    }

    return back()->with('success', 'Updated');
  }

  public function show()
  {
    # code...
  }

  public function destroy($id)
  {
    Video::where("group", $id)->delete();
    return redirect(route('video.index'))->with('success', 'Deleted!');
  }

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

  private function getGroupId()
  {
    return time();
  }
}
