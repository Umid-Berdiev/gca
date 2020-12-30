<?php

namespace App\Http\Controllers\admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostCategory;
use Illuminate\Support\Facades\Validator;

class PostCategoryController extends Controller
{
  public function index(Request $request)
  {
    if ($request->has("search")) {
      $model = \DB::table("postcategories")
        ->select(['postcategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
        ->where("postcategories.language_id", "=", $this->getLang())
        ->where("postcategories.category_name", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("postcategories")
        ->select(['postcategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
        ->where("language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $lang = Language::where('status', 1)->get();

    return view("admin.post_category.index", [
      "table" => $model,
      "language" => $lang,
    ]);
  }

  public function create()
  {
    $languages = Language::all();
    return view("admin.post_category.create", compact('languages'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_names.*' => 'required|max:50',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      PostCategory::create([
        'category_name' => $request->category_names[$key],
        'language_id' => $value,
        'group' => $grp_id,
      ]);
    }

    return redirect(route('post-categories.index'))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = PostCategory::where('group', $id)->get();
    $lang = Language::all();

    return view("admin.post_category.edit", [
      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'category_names.*' => 'required|max:50',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    foreach ($request->language_ids as $key => $value) {
      $model = PostCategory::where("group", $id)
        ->where("language_id", $value)
        ->first();
      $model->category_name = $request->category_names[$key];
      $model->update();
    }

    return redirect(route('post-categories.index'))->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    PostCategory::where('group', $id)->delete();
    return redirect(route('post-categories.index'))->with('success', 'Deleted!');
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
