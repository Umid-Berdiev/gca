<?php

namespace App\Http\Controllers\admin;

use App\DocumentCategory;
use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class DocumentCategoryController extends Controller
{
  public function index(Request $request)
  {
    if ($request->has("search")) {
      $model = \DB::table("doccategories")
        ->select(['doccategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "doccategories.language_id")
        ->where("doccategories.language_id", $this->getLang())
        ->where("doccategories.category_name", "LIKE", '%' . $request->input("search") . '%')->orderBy('id', 'desc')->paginate(10);
    } else {
      $model = \DB::table("doccategories")
        ->select(['doccategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "doccategories.language_id")
        ->where("language_id", $this->getLang())->orderBy('id', 'desc')->paginate(10);
    }

    $lang = Language::all();

    return view("admin.document_category.index", [
      "table" => $model,
      "language" => $lang,
    ]);
  }

  public function create()
  {
    $languages = Language::where('status', '1')->get();
    return view("admin.document_category.create", compact('languages'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_names.*' => 'required|max:255',
    ]);
    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new DocumentCategory();
      if (isset($request->category_names[$key])) {
        $model->category_name = $request->category_names[$key];
      } else {
        $model->category_name = "";
      }

      $model->language_id = $value;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect(route('document-categories.index'))->with('success', 'New category created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = DocumentCategory::where("group", $id)->get();
    $lang = Language::where('status', '1')->get();

    return view("admin.document_category.edit", [
      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
    ]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'category_names.*' => 'required|max:255',
    ]);

    foreach ($request->language_ids as $key => $value) {
      $model = DocumentCategory::where("group", $id)
        ->where("language_id", $value)
        ->first();

      if (isset($request->category_names[$key])) {
        $model->category_name = $request->category_names[$key];
      } else {
        $model->category_name = "";
      }

      $model->update();
    }

    return redirect(route('document-categories.index'))->with('success', 'Category updated!');
  }

  public function destroy(Request $request, $id)
  {
    DocumentCategory::where("group", $id)->delete();
    return redirect(route('document-categories.index'))->with('success', 'Category deleted!');
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
