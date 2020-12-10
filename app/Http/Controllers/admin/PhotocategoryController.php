<?php

namespace App\Http\Controllers\admin;

use App\Language;
use App\Photogallery;
use App\PhotoCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotoCategoryController extends Controller
{
  public function index(Request $request)
  {
    if ($request->has("search")) {
      $model = \DB::table("photogallerycategories")
        ->select(['photogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
        ->where("photogallerycategories.language_id", "=", $this->getLang())
        ->where("photogallerycategories.title", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("photogallerycategories")
        ->select(['photogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
        ->where("language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $languages = Language::where('status', 1)->get();

    return view("admin.photo_category.index", [
      "table" => $model,
      "language" => $languages,
    ]);
  }

  public function create()
  {
    $languages = Language::where('status', 1)->get();

    return view("admin.photocategory_add", [
      "languages" => $languages,
    ]);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'titles.*' => 'required|max:255',
      'cover' => 'required',
      'descriptions.*' => 'required',
    ]);

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new PhotoCategory();
      $model->title = $request->titles[$key] ?? null;
      $model->Description = $request->descriptions[$key] ?? null;
      $model->language_id = $value;
      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }

      $model->group = $grp_id;

      $model->save();
    }

    return redirect(route('photo-categories.index'))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = PhotoCategory::where('group', $id)->get();
    $lang = Language::all();

    return view("admin.photo_category.edit", [
      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id
    ]);
  }

  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'language_id' => 'required',
      'cover' => 'required',
      'Description' => 'required',
      'group' => 'required',
    ]);

    $grp_id = $request->input("group");

    foreach ($request->language_ids as $key => $value) {
      $model = PhotoCategory::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->title = $request->input("title")[$key] ?? null;
      $model->Description = $request->descriptions[$key] ?? null;

      if ($request->hasFile("cover")) {
        $model->cover = Storage::putFile('public', $request->file('cover'));
      }


      $model->update();
    }

    return redirect(route('photo-categories.index'))->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    PhotoCategory::where("group", $id)->delete();
    return redirect(route('photo-categories.index'))->with('success', 'Deleted!');
  }

  private function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", \App::getLocale())->first();
    return $model->id;
  }

  private function getGroupId()
  {
    return time();
  }
}
