<?php

namespace App\Http\Controllers;

use App\language;
use App\menumaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
  private function getlang()
  {
    $model = language::all()->where('status', '=', '1')->where("language_prefix", "=", app()->getLocale())->first();
    if ($model)
      return $model->id;
    else {
      $model = language::all()->where('status', '=', '1')->where("language_prefix", 'en')->first();
      return $model->id;
    }
  }
  public function edits(Request $request)
  {
    $model = language::all()->where('status', '=', '1');

    $menu = DB::table("menumakers")->where("language_id", "=", $this->getlang())->where("parent_id", "=", 0)->get();

    $edits = DB::table("menumakers")->where("group", "=", $request->input('id'))->get();

    $doc = DB::table("doccategories")->where("language_id", "=", $this->getlang())->get();
    $event = DB::table("eventcategories")->where("language_id", "=", $this->getlang())->get();
    $page = DB::table("pages")->where("language_id", "=", $this->getlang())->get();
    $photo = DB::table("photogallerycategories")->where("language_id", "=", $this->getlang())->get();
    $video = DB::table("videogallerycategories")->where("language_id", "=", $this->getlang())->get();
    $tenders = DB::table("tendercategories")->where("language_id", "=", $this->getlang())->get();
    $postcategories = DB::table("postcategories")->where("language_id", "=", $this->getlang())->get();


    return view("admin.menubuildere", [
      'languages' => $model,
      'edit' => $edits,
      'grp_id' => $request->input('id'),
      'menues' => $menu,
      'categories' => [
        'doc' => $doc,
        'event' => $event,
        'page' => $page,
        'photo' => $photo,
        'video' => $video,
        'tender' => $tenders,
        'post' => $postcategories,
      ],
    ]);
  }
  public function editshow()
  {


    $menu = DB::table("menumakers")->where("language_id", "=", $this->getlang())->where("parent_id", "=", 0)->orderBy("orders")->get();





    return view("admin.menuedit", [

      'menues' => $menu,

    ]);
  }
  public function index()
  {
    $model = language::all()->where('status', '=', '1');

    $menu = DB::table("menumakers")->where("language_id", "=", $this->getlang())->where("parent_id", "=", 0)->get();


    $doc = DB::table("doccategories")->where("language_id", "=", $this->getlang())->get();
    $event = DB::table("eventcategories")->where("language_id", "=", $this->getlang())->get();
    $page = DB::table("pages")->where("language_id", "=", $this->getlang())->get();
    $photo = DB::table("photogallerycategories")->where("language_id", "=", $this->getlang())->get();
    $video = DB::table("videogallerycategories")->where("language_id", "=", $this->getlang())->get();
    $tenders = DB::table("tendercategories")->where("language_id", "=", $this->getlang())->get();
    $postcategories = DB::table("postcategories")->where("language_id", "=", $this->getlang())->get();


    return view("admin.menubuilder", [
      'languages' => $model,
      'menues' => $menu,
      'categories' => [
        'doc' => $doc,
        'event' => $event,
        'page' => $page,
        'photo' => $photo,
        'video' => $video,
        'tender' => $tenders,
        'post' => $postcategories,
      ],
    ]);
  }
  public function indexx($id)
  {
    $model = language::all()->where('status', '=', '1');

    $menu = DB::table("menumakers")
      ->where("language_id", "=", $this->getlang())
      ->where("parent_id", "=", 0)
      ->get();

    $parent = DB::table("menumakers")
      ->where("language_id", "=", $this->getlang())
      ->where("group", "=", $id)

      ->first();

    $doc = DB::table("doccategories")->where("language_id", "=", $this->getlang())->get();
    $event = DB::table("eventcategories")->where("language_id", "=", $this->getlang())->get();
    $page = DB::table("pages")->where("language_id", "=", $this->getlang())->get();
    $photo = DB::table("photogallerycategories")->where("language_id", "=", $this->getlang())->get();
    $video = DB::table("videogallerycategories")->where("language_id", "=", $this->getlang())->get();
    $tenders = DB::table("tendercategories")->where("language_id", "=", $this->getlang())->get();
    $postcategories = DB::table("postcategories")->where("language_id", "=", $this->getlang())->get();


    return view("admin.menubuilderparent", [
      'languages' => $model,
      'menues' => $menu,
      'parent_id' => $id,
      'parent' => $parent,
      'categories' => [
        'doc' => $doc,
        'event' => $event,
        'page' => $page,
        'photo' => $photo,
        'video' => $video,
        'tender' => $tenders,
        'post' => $postcategories,
      ],
    ]);
  }
  public function insert(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'menu_name' => 'required|max:255',
      'type' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getgroup_id();
    foreach ($request->input("language_id") as $key => $value) {
      $model = new menumaker();
      $model->alias_category_id = $request->input("alias_category_id") ?? null;
      $model->menu_name = $request->input("menu_name")[$key] ?? null;
      $model->type = $request->input("type");
      $model->link = $request->input("link") ?? null;
      if ($request->input('parent_id') != "null") {

        $model->parent_id = $request->input("parent_id");
      } else {
        $model->parent_id = 0;
      }

      $model->language_id = $value;
      $model->orders = 0;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/menu");
  }
  public function Update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'menu_name' => 'required|max:255',
      'type' => 'required',
      'grp_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $request->input("grp_id");
    foreach ($request->input("language_id") as $key => $value) {
      $model = menumaker::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->alias_category_id = $request->input("alias_category_id") ?? null;
      $model->menu_name = $request->input("menu_name")[$key] ?? null;
      $model->type = $request->input("type");
      $model->link = $request->input("link") ?? null;
      $model->parent_id = $request->input("parent_id") ?? 0;



      $model->save();
    }

    return redirect("/admin/menu/edits?id=" . $grp_id);
  }
  private function getgroup_id()
  {
    return time();
  }
  public function orderchange(Request $request)
  {
    //dd(Input::all());

    $at = DB::table("menumakers")
      ->where("group", "=", $request->input("id"))->first();


    $ordermin = DB::table("menumakers")
      ->where("parent_id", "=", $at->parent_id)->orderBy("orders")->first();
    $ordermax = DB::table("menumakers")
      ->where("parent_id", "=", $at->parent_id)->orderByDesc("orders")->first();








    if ($request->input("p") == "up") {

      // dd($at->parent_id);



      $older = menumaker::all()->where("parent_id", "=", $at->parent_id)
        ->where("orders", "=", $at->orders - 1);

      foreach ($older as $atx) {
        $ssx  = menumaker::all()->where("parent_id", "=", $at->parent_id)
          ->where("id", "=", $atx->id)->first();
        $ssx->orders = $atx->orders + 1;
        $ssx->update();
      }

      $ss  = menumaker::all()->where("group", "=", $at->group);

      foreach ($ss as $value) {
        $my = menumaker::all()->where("id", "=", $value->id)->first();
        if ($value->orders > $ordermin->orders) {
          $my->orders = $value->orders - 1;
          $my->update();
        }
      }
    } else {



      $older = menumaker::all()->where("parent_id", "=", $at->parent_id)
        ->where("orders", "=", $at->orders + 1);

      foreach ($older as $atx) {
        $ssx  = menumaker::all()->where("parent_id", "=", $at->parent_id)
          ->where("id", "=", $atx->id)->first();
        $ssx->orders = $atx->orders - 1;
        $ssx->update();
      }
      $ss  = menumaker::all()->where("group", "=", $at->group);

      foreach ($ss as $value) {
        $my = menumaker::all()->where("id", "=", $value->id)->first();
        if ($value->orders < $ordermax->orders) {
          $my->orders = $value->orders + 1;

          $my->update();
        }
      }
    }










    return redirect("/admin/menu/edit");
  }
  public function updateallorders()
  {
    $model = menumaker::all();

    /* for($i=0;$i<count($model);$i++){
            $me=menumaker::find($model[$i]->id);
            $me->orders= $i;
           // $me->update();

           // echo($me->id);
        }*/
  }

  public function  destroy(Request $request)
  {
    $menu  = menumaker::where('group', '=', $request->id)->delete();
    $parentmenu = menumaker::where('parent_id', '=', $request->id)->delete();

    return redirect()->back();
  }
}
