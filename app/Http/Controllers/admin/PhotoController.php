<?php

namespace App\Http\Controllers\admin;

use App\Language;
use App\Photogallery;
use App\PhotoCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
  public function index(Request $request)
  {

    if ($request->has("search")) {
      $model = DB::table("photogalleries")
        ->select(['photogalleries.*', 'languages.language_name', 'photogallerycategories.title'])
        ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
        ->leftJoin("photogallerycategories", "photogallerycategories.group", "=", "photogalleries.category_id")
        ->where("photogalleries.language_id", "=", $this->getLang())
        ->where("photogallerycategories.language_id", "=", $this->getLang())
        ->where("photogalleries.name", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("photogalleries.name", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("photogalleries.description", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = DB::table("photogalleries")
        ->select(['photogalleries.*', 'languages.language_name', 'photogallerycategories.title'])
        ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
        ->leftJoin("photogallerycategories", "photogallerycategories.group", "=", "photogalleries.category_id")
        ->where("photogalleries.language_id", "=", $this->getLang())
        ->where("photogallerycategories.language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $lang = Language::where('status', 1)->get();
    $doccat = PhotoCategory::where("language_id", $this->getLang())->get();
    return view("admin.photo.index", [
      "table" => $model,
      "language" => $lang,
      "category" => $doccat,
    ]);
  }

  public function create()
  {
    $lang = Language::where('status', 1)->get();
    $doccat = PhotoCategory::where("language_id", $this->getLang())->get();
    return view("admin.photo.create", [
      "languages" => $lang,
      "category" => $doccat,
    ]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'names.*' => 'required|max:255',
      'descriptions.*' => 'required|max:255',
      'cover' => 'required'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new Photogallery();
      $model->name = $request->names[$key];
      $model->description = $request->descriptions[$key];
      $model->category_id = $request->category_id;
      $model->group = $grp_id;
      $model->language_id = $value;

      if ($request->hasFile("cover")) {
        $model->cover = $request->file('cover')->getClientOriginalName();
        Storage::putFileAs('public/photos', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      }

      $model->save();
    }

    return redirect(route('photos.edit', $model->group))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = Photogallery::where("group", $id)->get();
    $lang = Language::all();
    $doccat = PhotoCategory::where("language_id", $this->getLang())->get();

    return view("admin.photo.edit", [
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
      'cover' => 'required'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    foreach ($request->language_ids as $key => $value) {
      $model = Photogallery::where("group", $id)
        ->where("language_id", $value)
        ->first();
      $model->name = $request->names[$key];
      $model->description = $request->descriptions[$key];
      $model->category_id = $request->category_id;
      $model->group = $id;
      $model->language_id = $value;

      if ($request->hasFile("cover")) {
        $model->cover = $request->file('cover')->getClientOriginalName();
        Storage::putFileAs('public/photos', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      } else {
        $model->cover = "null";
      }

      if ($request->remove_cover == "on") {
        $model->cover = "null";
      }

      $model->update();
    }

    return back()->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    Photogallery::where("group", $id)->delete();
    return redirect(route('photos.index'))->with('success', 'Deleted!');
  }

  private function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", app()->getLocale())->first();
    return $model->id;
  }

  private function getGroupId()
  {
    return time();
  }
}
