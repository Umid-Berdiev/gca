<?php

namespace App\Http\Controllers\admin;

use App\language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\doccategory;
use App\doc;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


class DocController extends Controller
{
  private function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }
  public function Index(Request $request)
  {

    if ($request->has("search")) {
      $model = \DB::table("docs")
        ->select(['docs.*', 'languages.language_name', 'doccategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "docs.language_id")
        ->leftJoin("doccategories", "doccategories.group", "=", "docs.doc_category_id")
        ->where("docs.language_id", "=", $this->getlang())
        ->where("doccategories.language_id", "=", $this->getlang())
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
        ->where("docs.language_id", "=", $this->getlang())
        ->where("doccategories.language_id", "=", $this->getlang())
        ->orderBy('id', 'desc')
        ->paginate(10);
    }


    $lang = language::all()->where('status', '=', '1');
    $doccat = doccategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.doc", [
      "table" => $model,
      "language" => $lang,
      "category" => $doccat,
    ]);
  }
  public function Insert(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'language_id' => 'required',
      'files' => 'required',
      'r_number' => 'required',
      'r_date' => 'required',
      'doc_category_id' => 'required',


    ]);
    $grp_id = $this->getgroup_id();

    foreach ($request->input("language_id") as $key => $value) {
      $model = new doc();
      if (isset($request->input("title")[$key]))
        $model->title = $request->input("title")[$key];
      else
        $model->title = "";
      if (isset($request->input("description")[$key]))
        $model->description = $request->input("description")[$key];
      else
        $model->description = "";
      if (isset($request->input("link")[$key]))
        $model->link = $request->input("link")[$key];
      else
        $model->link = "";

      if (isset($request->input("other_link")[$key]))
        $model->other_link = $request->input("other_link")[$key];
      else
        $model->other_link = "";


      if (isset($request->input("r_number")[$key]))
        $model->r_number = $request->input("r_number")[$key];
      else
        $model->r_number = "";
      if (isset($request->input("r_date")[$key]))
        $model->r_date = $request->input("r_date")[$key];
      else
        $model->r_date = "0000-01-02";


      $model->group = $grp_id;
      $model->language_id = $value;
      if (isset($request->file("files")[$key])) {
        $file = $request->file("files")[$key];
        $model->files = Storage::putFile('public/upload', $request->file('files')[$key]);
        $model->file_type = $file->clientExtension();
        $model->file_size = $file->getClientSize();
      } else {
        $model->files = "";
        $model->file_type = '';
        $model->file_size = '';
      }

      if ($request->file("photo")) {
        $file = $request->file("photo");
        $model->photo_url = Storage::putFile('public/upload', $request->file('photo'));
      } else {
        $model->files = "";
        $model->file_type = '';
        $model->file_size = '';
      }

      $model->doc_category_id = $request->input("doc_category_id");
      $model->save();
    }

    return redirect("/admin/doc");
  }
  public function InsertShow()
  {
    $lang = language::all();
    $doccat = doccategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.doc_add", [

      "languages" => $lang,
      "category" => $doccat,
    ]);
  }
  public function Update(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'language_id' => 'required',
      'r_number' => 'required',
      'r_date' => 'required',
      'doc_category_id' => 'required',
      'group' => 'required',

    ]);


    $grp_id = $request->input("group");


    foreach ($request->input("language_id") as $key => $value) {
      $model = doc::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      if (isset($request->input("title")[$key]))
        $model->title = $request->input("title")[$key];
      else
        $model->title = "";
      if (isset($request->input("description")[$key]))
        $model->description = $request->input("description")[$key];
      else
        $model->description = "";
      if (isset($request->input("link")[$key]))
        $model->link = $request->input("link")[$key];
      else
        $model->link = "";

      if (isset($request->input("other_link")[$key]))
        $model->other_link = $request->input("other_link")[$key];
      else
        $model->other_link = "";



      if (isset($request->input("r_number")[$key]))
        $model->r_number = $request->input("r_number")[$key];
      else
        $model->r_number = "";
      if (isset($request->input("r_date")[$key]))
        $model->r_date = $request->input("r_date")[$key];
      else
        $model->r_date = "0000-01-02";
      $model->doc_category_id = $request->input("doc_category_id");
      if (isset($request->file("files")[$key])) {
        $file = $request->file("files")[$key];
        $model->files = Storage::putFile('public/upload', $request->file('files')[$key]);
        $model->file_type = $file->clientExtension();
        $model->file_size = $file->getClientSize();
      }

      $model->update();
    }
    return redirect("admin/doc");
  }
  public function UpdateShow(Request $request)
  {
    $model  = doc::all()->where("group", "=", $request->input("id"));
    $lang = language::all()->where('status', '=', '1');
    $doccat = doccategory::all()->where("language_id", "=", $this->getlang());
    return view("admin.doc_edit", [

      "languages" => $lang,
      "model" => $model,
      "grp_id" => $request->input("id"),
      "category" => $doccat,
    ]);
  }
  public function Delete(Request $request)
  {
    $validatedData = $request->validate([

      'id' => 'required',

    ]);
    $model = doc::all()->where("group", "=", $request->input("id"));

    foreach ($model as $value) {
      $mod = doc::find($value->id)->delete();
    }

    return redirect("admin/doc");
  }
  private function getgroup_id()
  {
    return time();
  }
}
