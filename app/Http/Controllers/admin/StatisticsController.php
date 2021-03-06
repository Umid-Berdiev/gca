<?php

namespace App\Http\Controllers\admin;

use App\Language;
use App\Statistics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class StatisticsController extends Controller
{
  public function index()
  {
    $statistics = Statistics::where("language_id", $this->getLang())->paginate(10);
    return view('admin.statistics.index', compact('statistics'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $languages = Language::where('status', 1)->get();
    return view('admin.statistics.create', compact('languages'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
      'names.*' => 'required',
      'photo_url' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $statistics = new Statistics();
      $statistics->name = $request->names[$key];
      $statistics->group = $grp_id;
      $statistics->language_id = $value;

      if ($request->hasFile('photo_url')) {
        $statistics->photo_url = $request->file('photo_url')->getClientOriginalName();
        Storage::putFileAs('public/statistics', $request->file('photo_url'), $request->file('photo_url')->getClientOriginalName());
      } else $statistics->photo_url = "";

      $statistics->save();
    }

    return redirect(route('statistics.edit', $statistics->group))->with('success', 'Created!');
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
    $languages = Language::where('status', 1)->get();
    $models  = Statistics::where('group', $id)->get();
    $group_id = $id;

    return view('admin.statistics.edit', compact('languages', 'models', 'group_id'));
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
    $validator = Validator::make($request->all(), [
      'names.*' => 'required',
      // 'photo_url' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    foreach ($request->language_ids as $key => $value) {
      $stat = Statistics::where("group", $id)->where("language_id", $value)->first();
      $stat->name = $request->names[$key];

      if ($request->hasFile('photo_url')) {
        $stat->photo_url = $request->file('photo_url')->getClientOriginalName();
        Storage::putFileAs('public/statistics', $request->file('photo_url'), $request->file('photo_url')->getClientOriginalName());
      }

      $stat->update();
    }

    return back()->with('success', 'Updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $stats = Statistics::where('group', $id)->get();
    foreach ($stats as $stat) {
      if (Storage::exists('public/statistics/' . $stat->photo_url)) {
        // dd('file exists');
        Storage::delete('public/statistics/' . $stat->photo_url);
      }
      $stat->delete();
    }

    return redirect(route('statistics.index'))->with('success', 'Deleted!');
  }

  private function getGroupId()
  {
    return time();
  }

  private function getLang()
  {
    $current_locale = app()->getLocale() ?? 'en';
    $model = Language::where('status', '1')->where("language_prefix", $current_locale)->first();

    return $model->id;
  }
}
