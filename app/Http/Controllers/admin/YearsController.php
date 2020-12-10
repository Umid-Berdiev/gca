<?php

namespace App\Http\Controllers\admin;

use App\Language;
use App\Years;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class YearsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function getLang()
  {
    $model = Language::where('status', '1')->where("language_prefix", \App::getLocale())->first();
    if ($model) {

      return $model->id;
    } else {
      $model = Language::where('status',  '1')->where("language_prefix", "en")->first();
      return $model->id;
    }
  }
  public function index()
  {
    $years = Years::where("language_id", "=", $this->getLang())->orderBy('id', 'desc')->paginate('10');
    return view('admin.years')
      ->with('years', $years);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $lang = Language::where('status', 1)->get();
    return view('admin.years_add')
      ->with('languages', $lang);
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
      'language_id' => 'required',
      'cover' => 'required',


    ]);
    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
      $years = new Years();
      if (isset($request->file('cover')[$key])) {
        $years->photo_url =  \Storage::putFile('public', $request->file('cover')[$key]);
      } else {
        $years->photo_url = "";
      }
      $years->group  = $grp_id;
      $years->language_id  = $value;
      $years->save();
    }
    return redirect('/admin/years');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request)
  {

    $lang = Language::all();
    $years = Years::where('group', '=', Input::get('id'))->get();
    return view('admin.years_edit')->with('years', $years)->with('languages', $lang);
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
      'language_id' => 'required',



    ]);
    $id = Input::get('group');

    foreach ($request->language_ids as $key => $value) {
      $years = Years::all()
        ->where("group", "=", $id)
        ->where("language_id", "=", $value)
        ->first();
      if (isset($request->file('cover')[$key])) {

        $years->photo_url =  Storage::putFile('public', $request->file('cover')[$key]);
      }
      $years->language_id = $value;

      $years->update();
    }
    return redirect("admin/years");
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
    $model = Years::where("group", "=", $request->input("id"))->delete();;



    return redirect("admin/years");
  }

  private function getGroupId()
  {
    return time();
  }
}
