<?php

namespace App\Http\Controllers\admin;

use App\language;
use App\PagesCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use App\PagesCategoriesGroup;

class PageCategoriesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $languages = language::all()->where('status', '=', '1');
    $languages_min = language::min('id');
    $page_categories = DB::table('pages_categories')
      ->Leftjoin('pages_categories_groups', 'pages_categories.category_group_id', '=', 'pages_categories_groups.id')
      ->select('pages_categories.*')
      ->where('pages_categories_groups.status', '=', 1)
      ->where('pages_categories.language_id', '=', $languages_min)
      ->orderBy('id', 'desc')
      ->get();

    return view('admin.pages_categories')->with('page_categories', $page_categories)->with('languages', $languages);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $languages = language::all()->where('status', '=', '1');
    return view('admin.page_categories_add')->with('languages', $languages);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // dd(Input::all());
    if ($request->has('category_name') && $request->has('language_id')) {

      $page_categories_group = new PagesCategoriesGroup();
      $page_categories_group->status = 1;
      $page_categories_group->save();
      $language_ids = Input::get('language_id');
      $catgory_names = Input::get('category_name');


      foreach ($language_ids as $key => $val) {
        if (isset($catgory_names[$key])) {
          $category_group_id = $page_categories_group->id;
          $pages_categories = new PagesCategories();
          $pages_categories->category_name = $catgory_names[$key];
          $pages_categories->language_id = $language_ids[$key];
          $pages_categories->category_group_id = $category_group_id;
          $pages_categories->save();
        } else {
          $category_group_id = $page_categories_group->id;
          $pages_categories = new PagesCategories();
          $pages_categories->category_name = "";
          $pages_categories->language_id = $language_ids[$key];
          $pages_categories->category_group_id = $category_group_id;
          $pages_categories->save();
        }
      }
      return redirect()->route('page_categories');
    }
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
  public function edit($id)
  {
    $languages = language::all()->where('status', '=', '1');
    $page_categories = PagesCategories::where('category_group_id', '=', $id)->get();
    return view('admin.pages_categories_edit')->with('languages', $languages)->with('page_categories', $page_categories);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {

    if ($request->has('category_name') && $request->has('language_id') && $request->has('page_categories_group_id')) {
      $language_ids = Input::get('language_id');
      $catgory_names = Input::get('category_name');
      // dd($language_ids);
      //PagesCategories::where('category_group_id','=',Input::get('page_categories_group_id'))->get();
      foreach ($language_ids as $key => $val) {
        PagesCategories::where('category_group_id', '=', Input::get('page_categories_group_id'))->where('language_id', '=', $language_ids[$key])
          ->update(['category_name' => $catgory_names[$key]]);
      }
      return redirect()->back();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if (isset($id)) {
      PagesCategoriesGroup::where('id', '=', $id)
        ->update(['status' => 0]);
      return redirect()->back();
    }
  }
}
