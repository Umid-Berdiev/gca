<?php

namespace App\Http\Controllers\admin;

use App\Language;
use App\Links;
use App\LinksCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class LinksController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $model = \DB::table("links")
      ->select(['links.*', 'languages.language_name', 'links_categories.title as category_name'])
      ->leftJoin("languages", "languages.id", "=", "links.language_id")
      ->leftJoin("links_categories", "links_categories.group", "=", "links.category_group")
      ->where("links_categories.language_id", "=", $this->getLang())
      ->where("links.language_id", "=", $this->getLang())
      ->orderBy('id', 'desc')
      ->paginate(10);


    return view('admin.links')->with('table', $model);
  }

  public function indexCategories()
  {
    $model = \DB::table("links_categories")
      ->select(['links_categories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "links_categories.language_id")
      ->where("language_id", "=", $this->getLang())
      ->orderBy('order')
      ->paginate(10);
    return view('admin.links_categories')->with('table', $model);
  }
  private function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", \App::getLocale())->first();
    if ($model)
      return $model->id;
    else {
      $model = Language::all()->where('status', '=', '1')->where("language_prefix", 'en')->first();
      return $model->id;
    }
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $lang = Language::where('status', 1)->get();
    $category = LinksCategories::where('language_id', '=', $this->getLang())->get();

    return view('admin.links_add')
      ->with('languages', $lang)
      ->with('category', $category);
  }
  public function createCategories()
  {
    $lang = Language::where('status', 1)->get();

    return view('admin.links_categories_add')->with('languages', $lang);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'language_id' => 'required',
      'cover' => 'required',
      'links_category_id' => 'required',
      'link' => 'required',


    ]);

    // dd(Input::all());
    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
      $model = new Links();
      if (isset($request->input("title")[$key]))
        $model->title = $request->input("title")[$key];
      else
        $model->title = "";
      $model->category_group = $request->input("links_category_id");
      $model->group = $grp_id;
      $model->language_id = $value;
      $model->link = Input::get('link');

      if ($request->hasFile('cover')) {
        $model->photo_url =  Storage::putFile('public', $request->file('cover'));
      }


      $model->save();
    }

    return redirect("/admin/links");
  }
  public function categories_store(Request $request)
  {
    $validatedData = $request->validate([
      'category_name' => 'required|max:255',
      'language_id' => 'required',

    ]);
    $max_id = LinksCategories::max('id');
    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
      $model = new LinksCategories();
      if (isset($request->input("category_name")[$key]))
        $model->title = $request->input("category_name")[$key];
      else
        $model->title = "";
      $model->language_id = $value;
      $model->group = $grp_id;
      $model->order = $max_id + 1;

      $model->save();
    }

    return redirect("/admin/links/categories");
  }
  private function getGroupId()
  {
    return time();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, $id)
  {

    $model  = Links::all()->where("group", "=", $request->input("id"));
    $lang = Language::all();
    $category_id = Links::where("group", "=", $request->input("id"))->first();
    $doccat = LinksCategories::where("language_id", $this->getLang())->get();

    //dd($model);
    return view("admin.links_edit", [

      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
      "category_id" => $category_id,
      "category" => $doccat,
    ]);
  }

  public function editCategories(Request $request)
  {
    $model  = LinksCategories::all()->where("group", "=", $request->input("id"));
    $lang = Language::all();
    return view("admin.links_categories_edit", [

      "languages" => $lang,
      "model" => $model,
      "grp_id" => $id,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'language_id' => 'required',
      'links_category_id' => 'required',
      'link' => 'required',
      'group' => 'required',


    ]);

    //dd(Input::all());

    $grp_id = $request->input("group");


    foreach ($request->language_ids as $key => $value) {
      $model = Links::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      if (isset($request->input("title")[$key]))
        $model->title = $request->input("title")[$key];
      else
        $model->title = "";
      $model->category_group = $request->input("links_category_id");
      $model->link = $request->input("link");
      $model->group = $grp_id;
      $model->language_id = $value;
      if ($request->hasFile('cover')) {
        $model->photo_url =  Storage::putFile('public', $request->file('cover'));
      }


      $model->update();
    }
    return redirect("admin/links");
  }

  public function categories_update(Request $request)
  {
    $validatedData = $request->validate([
      'category_name' => 'required|max:255',
      'language_id' => 'required',
      'group' => 'required',

    ]);
    $grp_id = $request->input("group");


    foreach ($request->language_ids as $key => $value) {
      $model = LinksCategories::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->title = $request->input("category_name")[$key];


      $model->update();
    }
    return redirect("/admin/links/categories/");
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $validatedData = $request->validate([

      'id' => 'required',

    ]);
    Links::where("group", "=", $request->input("id"))->delete();


    return redirect("/admin/links/");
  }
  public function categories_destroy(Request $request)
  {

    $validatedData = $request->validate([

      'id' => 'required',

    ]);
    LinksCategories::where("group", "=", $request->input("id"))->delete();


    return redirect("/admin/links/categories/");
  }
}
