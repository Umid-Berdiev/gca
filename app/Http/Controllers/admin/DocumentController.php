<?php

namespace App\Http\Controllers\admin;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DocumentCategory;
use App\Document;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


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
    $request->validate([
      'titles.*' => 'required|max:255',
      'descriptions.*' => 'required|max:255',
      'language_ids.*' => 'required',
      'files.*' => 'required',
      'register_numbers.*' => 'required',
      'register_date.*' => 'required',
      'doc_category_id' => 'required',
    ]);

    $grp_id = $this->getGroupId();
    // dd($request->all());
    foreach ($request->input("language_ids") as $key => $value) {
      $model = new Document();

      $model->title = $request->input("titles")[$key];
      $model->description = $request->input("descriptions")[$key];
      $model->link = $request->input("links")[$key];
      $model->other_link = $request->input("other_link");
      $model->r_number = $request->input("register_numbers")[$key];
      $model->r_date = $request->input("register_dates")[$key];
      $model->group = $grp_id;
      $model->language_id = $value;

      if (isset($request->file("files")[$key])) {
        $file = $request->file("files")[$key];
        $model->files = Storage::put('public/upload', $request->file('files')[$key]);
        $model->file_type = $file->clientExtension();
        $model->file_size = $file->getClientSize();
      } else {
        $model->files = "";
        $model->file_type = '';
        $model->file_size = '';
      }

      $model->doc_category_id = $request->input("category_id");
      $model->save();
    }

    return redirect(route('documents.index'));
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
    // dd($request->all(), $id);
    $request->validate([
      // 'titles.*' => 'required|max:255',
      // 'descriptions.*' => 'required|max:255',
      // 'language_ids.*' => 'required',
      // 'files.*' => 'required',
      // 'register_numbers.*' => 'required',
      // 'register_date.*' => 'required',
      // 'doc_category_id' => 'required',
    ]);

    $grp_id = $request->input("group");

    foreach ($request->input("language_ids") as $key => $value) {
      $model = Document::where("group", $grp_id)
        ->where("language_id", $value)
        ->first();

      $model->title = $request->input("titles")[$key];
      $model->description = $request->input("descriptions")[$key];
      $model->link = $request->input("links")[$key];
      $model->other_link = $request->input("other_link");
      $model->r_number = $request->input("register_numbers")[$key];
      $model->r_date = $request->input("register_dates")[$key];
      $model->doc_category_id = $request->input("category_id");
      // dd($request->file('files')[$key]->getClientOriginalName());
      if (isset($request->file("files")[$key])) {
        $file = $request->file("files")[$key];
        $extension = $file->getClientOriginalExtension();  //Get Image Extension
        $file_name = $file->getClientOriginalName();

        $model->files = Storage::putFileAs('public/upload', $file, $file_name);
        $model->file_type = $file->clientExtension();
        $model->file_size = $file->getClientSize();
      }

      $model->update();
    }
    return back();
  }

  public function destroy(Request $request, $id)
  {
    Document::where("group", $id)->delete();
    return back();
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
