<?php

namespace App\Http\Controllers\admin;

use App\Language;
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
  public function index()
  {
    $lang = Language::where('status', 1)->get();
    $statistica = Statistica::where("language_id", "=", $this->getLang())->orderBy('id', 'desc')->paginate('10');
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
    $lang = Language::where('status', 1)->get();
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
    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
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

  private function getGroupId()
  {
    return time();
  }
}
