<?php

namespace App\Http\Controllers\admin;

use App\language;
use App\Statistica;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class StatisticaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  private function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", \App::getLocale())->first();
    if ($model)
      return $model->id;
    else {
      $model = language::all()->where('status', '=', '1')->where("language_prefix", 'en')->first();
      return $model->id;
    }
  }
  public function index()
  {
    $lang = language::all()->where('status', '=', '1');
    $statistica = Statistica::where("language_id", "=", $this->getlang())->orderBy('id', 'desc')->paginate('10');
    return view('admin.statistica')
      ->with('statistica', $statistica);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $lang = language::all()->where('status', '=', '1');
    return view('admin.statistica_add')
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
      'name' => 'required',


    ]);
    $grp_id = $this->getgroup_id();
    foreach ($request->input("language_id") as $key => $value) {
      $statistica = new Statistica();
      $statistica->name = Input::get('name');
      if (isset($request->file('cover')[$key])) {
        $statistica->photo_url =  Storage::putFile('public', $request->file('cover')[$key]);
      } else {
        $statistica->photo_url = "";
      }
      $statistica->group  = $grp_id;
      $statistica->language_id  = $value;
      $statistica->save();
    }
    return redirect('/admin/statistica');
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
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $statistica = Statistica::where('group', '=', Input::get('id'))->first();

    $statistica->delete();

    return redirect('admin/statistica');
  }

  private function getgroup_id()
  {
    return time();
  }
}
