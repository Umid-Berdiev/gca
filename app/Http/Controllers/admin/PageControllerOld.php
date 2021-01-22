<?php

namespace App\Http\Controllers\admin;

use App\Language;
use App\Page;
use App\PagesCategories;
use App\PageCategoryGroup;
use App\PageGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\tender;

class PageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $tenders = tender::take(3)->where('language_id', '=', $this->getLang())->get();
    $languages = Language::where('status', 1)->get();
    $languages_min = Language::min('id');
    $pages = DB::table('pages_groups')
      ->leftJoin('pages', 'pages.page_group_id', '=', 'pages_groups.id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', '=', 'pages.page_category_group_id')
      ->select('pages.*', 'pages_categories.*')
      ->where('pages.language_id', '=', $languages_min)
      ->where('pages_groups.status', '=', 1)
      ->where('pages_categories.language_id', '=', $languages_min)
      ->orderBy('pages_groups.id', 'desc')
      ->paginate(10);
    return view('admin.pages')
      ->with('languages', $languages)
      ->with('tenders', $tenders)
      ->with('pages', $pages);
  }

  public function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", \App::getLocale())->first();

    return $model->id;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $languages = Language::where('status', 1)->get();
    $languages_min = Language::min('id');
    $page_categories = DB::table('pages_categories')
      ->Leftjoin('pages_categories_groups', 'pages_categories.category_group_id', '=', 'pages_categories_groups.id')
      ->select('pages_categories.*')
      ->where('pages_categories_groups.status', '=', 1)
      ->where('pages_categories.language_id', '=', $languages_min)
      ->get();
    return view('admin.pages_add')
      ->with('languages', $languages)
      ->with('page_categories', $page_categories);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    if (
      $request->has('language_id') &&
      $request->has('title') &&
      $request->has('description') &&
      $request->has('content') &&
      $request->has('categories')
    ) {
      $page_group = new PageGroup();
      $page_group->viewers = 0;
      $page_group->status = 1;
      $page_group->page_category_group_id = $request->categories;
      $page_group->user_id = Auth::id();


      /* $image = $request->file('photos');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/photos/1');
            $image->move($destinationPath, $name);
             $page_group->photo_url = $name;*/

      if ($request->hasFile('photos'))
        $page_group->photo_url = Storage::putFile('public/photos/1/', $request->file('photos'));
      $page_group->save();





      $language_id = $request->language_id;
      $title = $request->title;
      $description = $request->description;
      $content = $request->content;

      foreach ($language_id as $key => $val) {
        $pages = new Page();
        if (isset($title[$key])) {
          $pages->title = $title[$key];
        } else {
          $pages->title = "";
        }
        if (isset($description[$key])) {
          $pages->description = $description[$key];
        } else {
          $pages->description = "";
        }
        if (isset($content[$key])) {
          $pages->content = $content[$key];
        } else {
          $pages->content = "";
        }

        $pages->page_group_id = $page_group->id;
        $pages->language_id = $language_id[$key];
        $pages->page_category_group_id =  $request->categories;
        $pages->save();
      }
      return redirect(route('pages'));
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $languages_min = Language::min('id');
    $languages = Language::where('status', 1)->get();
    $page_categories = DB::table('pages_categories')
      ->Leftjoin('pages_categories_groups', 'pages_categories.category_group_id', '=', 'pages_categories_groups.id')
      ->select('pages_categories.*')
      ->where('pages_categories_groups.status', '=', 1)
      ->where('pages_categories.language_id', '=', $languages_min)
      ->get();
    $pages = Page::where('page_group_id', '=', $id)->get();
    $page_group = PageGroup::where('id', '=', $id)->first();

    return view('admin.pages_edit')
      ->with('languages', $languages)
      ->with('page_categories', $page_categories)
      ->with('pages', $pages)
      ->with('page_group', $page_group);
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
    if ($request->has('page_group_id')) {
      $page_group_id = $request->page_group_id;
      $page_category_group_id = $request->categories;


      $language_id = $request->language_id;
      $title = $request->title;
      $description = $request->description;
      $content = $request->content;
      $pages_id = $request->page_id;
      if ($request->file('photos')) {
        $image = $request->file('photos');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = storage_path('app/public/photos/1');
        $image->move($destinationPath, $name);

        $pages_group = PageGroup::where('id', $page_group_id)
          ->update([
            'page_category_group_id' => $page_category_group_id,
            'photo_url' => $name
          ]);
      } else {
        $pages_group = PageGroup::where('id', $page_group_id)
          ->update([
            'page_category_group_id' => $page_category_group_id,
          ]);
      }
      foreach ($language_id as $key => $val) {
        $pages = Page::find($pages_id[$key]);

        if (isset($title[$key])) {
          $pages->title = $title[$key];
        } else {
          $pages->title = "";
        }
        if (isset($description[$key])) {
          $pages->description = $description[$key];
        } else {
          $pages->description = "";
        }
        if (isset($content[$key])) {
          $pages->content = $content[$key];
        } else {
          $pages->content = "";
        }

        $pages->page_category_group_id =  $page_category_group_id;
        $pages->save();
      }
    }
    return redirect()->back();
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
      PageGroup::where('id', '=', $id)
        ->update(['status' => 0]);
      return redirect()->back();
    }
  }
}
