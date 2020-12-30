<?php

namespace App\Http\Controllers\admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DocumentCategory;
use App\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
  public function index(Request $request)
  {
    if ($request->has("search")) {
      $model = \DB::table("docs")
        ->select(['docs.*', 'languages.language_name', 'doccategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "docs.language_id")
        ->leftJoin("doccategories", "doccategories.group", "=", "docs.doc_category_id")
        ->where("docs.language_id", "=", $this->getLang())
        ->where("doccategories.language_id", "=", $this->getLang())
        ->where("docs.title", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("docs.description", "LIKE", '%' . $request->input("search") . '%')
        ->orWhere("docs.r_number", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = \DB::table("docs")
        ->select(['docs.*', 'languages.language_name', 'doccategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "docs.language_id")
        ->leftJoin("doccategories", "doccategories.group", "=", "docs.doc_category_id")
        ->where("docs.language_id", "=", $this->getLang())
        ->where("doccategories.language_id", "=", $this->getLang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $lang = Language::where('status', '1')->get();
    $doccat = DocumentCategory::where("language_id", $this->getLang())->get();

    return view("admin.document.index", [
      "table" => $model,
      "language" => $lang,
      "category" => $doccat,
    ]);
  }

  public function create()
  {
    $languages = Language::all();
    $category = DocumentCategory::where("language_id", $this->getLang())->get();

    return view("admin.document.create", compact(
      "languages",
      "category",
    ));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'titles.*' => 'required|max:255',
      'descriptions.*' => 'required',
      'language_ids.*' => 'required',
      'files.*' => 'required',
      'register_numbers.*' => 'required',
      'register_dates.*' => 'required',
      'category_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->input("language_ids") as $key => $value) {
      $model = Document::create([
        'title' => $request->titles[$key],
        'description' => $request->descriptions[$key],
        'link' => $request->links[$key],
        'other_link' => $request->other_link,
        'r_number' => $request->register_numbers[$key],
        'r_date' => $request->register_dates[$key],
        'group' => $grp_id,
        'language_id' => $value,
        'doc_category_id' => $request->category_id
      ]);

      if (isset($request->file("files")[$key])) {
        $file = $request->file("files")[$key];
        $file_name = $file->getClientOriginalName();
        $model->update([
          'files' => $file_name,
          'file_type' => $file->clientExtension(),
          'file_size' => $file->getClientSize()
        ]);
        Storage::putFileAs('public/upload', $file, $file_name);
      }
    }

    return redirect(route('documents.edit', $model->group))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = Document::where("group", $id)->get();
    $languages = Language::where('status', '1')->get();
    $category = DocumentCategory::where("language_id", $this->getLang())->get();
    $grp_id = $id;

    return view("admin.document.edit", compact(
      "languages",
      "model",
      "grp_id",
      "category"
    ));
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'titles.*' => 'required|max:255',
      'descriptions.*' => 'required',
      'language_ids.*' => 'required',
      'files.*' => 'required',
      'register_numbers.*' => 'required',
      'register_dates.*' => 'required',
      'category_id' => 'required'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    foreach ($request->input("language_ids") as $key => $value) {
      $model = Document::where("group", $id)
        ->where("language_id", $value)
        ->update([
          'title' => $request->titles[$key],
          'description' => $request->descriptions[$key],
          'link' => $request->links[$key],
          'other_link' => $request->other_link,
          'r_number' => $request->register_numbers[$key],
          'r_date' => $request->register_dates[$key],
          'doc_category_id' => $request->category_id
        ]);

      if (isset($request->file("files")[$key])) {
        $file = $request->file("files")[$key];
        $file_name = $file->getClientOriginalName();
        $model->update([
          'files' => $file_name,
          'file_type' => $file->clientExtension(),
          'file_size' => $file->getClientSize()
        ]);
        Storage::putFileAs('public/upload', $file, $file_name);
      }

      if ($request->remove_cover == "on") {
        $model->cover = "null";
      }
    }

    return back()->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    Document::where("group", $id)->delete();
    return back()->with('success', 'Deleted!');
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
