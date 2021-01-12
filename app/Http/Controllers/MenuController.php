<?php

namespace App\Http\Controllers;

use App\Language;
use App\MenuMaker;
use App\Page;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MenuController extends Controller
{
  public function edits(Request $request)
  {
    $model = Language::where('status', 1)->get();
    $menu = \DB::table("menumakers")->where("language_id", "=", $this->getLang())->where("parent_id", "=", 0)->get();
    $edits = \DB::table("menumakers")->where("group", "=", $request->input('id'))->get();
    $doc = \DB::table("doccategories")->where("language_id", "=", $this->getLang())->get();
    $event = \DB::table("eventcategories")->where("language_id", "=", $this->getLang())->get();
    $page = \DB::table("pages")->where("language_id", "=", $this->getLang())->get();
    $photo = \DB::table("photogallerycategories")->where("language_id", "=", $this->getLang())->get();
    $video = \DB::table("videogallerycategories")->where("language_id", "=", $this->getLang())->get();
    $tenders = \DB::table("tendercategories")->where("language_id", "=", $this->getLang())->get();
    $postcategories = \DB::table("postcategories")->where("language_id", "=", $this->getLang())->get();

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
    $menu = \DB::table("menumakers")->where("language_id", "=", $this->getLang())->where("parent_id", "=", 0)->orderBy("orders")->get();

    return view("admin.menuedit", [
      'menues' => $menu,
    ]);
  }

  public function index()
  {
    $model = Language::where('status', 1)->get();
    $menu = \DB::table("menumakers")->where("language_id", "=", $this->getLang())->where("parent_id", "=", 0)->get();
    $doc = \DB::table("doccategories")->where("language_id", "=", $this->getLang())->get();
    $event = \DB::table("eventcategories")->where("language_id", "=", $this->getLang())->get();
    $page = \DB::table("pages")->where("language_id", "=", $this->getLang())->get();
    $photo = \DB::table("photogallerycategories")->where("language_id", "=", $this->getLang())->get();
    $video = \DB::table("videogallerycategories")->where("language_id", "=", $this->getLang())->get();
    $tenders = \DB::table("tendercategories")->where("language_id", "=", $this->getLang())->get();
    $postcategories = \DB::table("postcategories")->where("language_id", "=", $this->getLang())->get();

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
    $model = Language::where('status', 1)->get();

    $menu = \DB::table("menumakers")
      ->where("language_id", "=", $this->getLang())
      ->where("parent_id", "=", 0)
      ->get();

    $parent = \DB::table("menumakers")
      ->where("language_id", "=", $this->getLang())
      ->where("group", "=", $id)

      ->first();

    $doc = \DB::table("doccategories")->where("language_id", "=", $this->getLang())->get();
    $event = \DB::table("eventcategories")->where("language_id", "=", $this->getLang())->get();
    $page = \DB::table("pages")->where("language_id", "=", $this->getLang())->get();
    $photo = \DB::table("photogallerycategories")->where("language_id", "=", $this->getLang())->get();
    $video = \DB::table("videogallerycategories")->where("language_id", "=", $this->getLang())->get();
    $tenders = \DB::table("tendercategories")->where("language_id", "=", $this->getLang())->get();
    $postcategories = \DB::table("postcategories")->where("language_id", "=", $this->getLang())->get();

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
    $validatedData = $request->validate([
      'menu_name' => 'required|max:255',
      'type' => 'required',
    ]);

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new MenuMaker();
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

  public function update(Request $request)
  {
    // dd($request->all());
    $request->validate([
      'menu_name' => 'required|max:255',
      'type' => 'required',
      'grp_id' => 'required',
    ]);

    $grp_id = $request->input("grp_id");

    foreach ($request->language_ids as $key => $lang_id) {
      $model = MenuMaker::where("group", $grp_id)
        ->where("language_id", $lang_id)->first();

      // $arr = [
      //   1 => ['class' => "\App\Link", 'link_name' => 'link'],
      //   2 => "\App\Post",
      // ];

      if (isset($request->type) && $request->type == 3 && isset($request->alias_category_id)) {
        $page = Page::where('page_group_id', $request->alias_category_id)->first();
        $link = "/page/" . $page->page_category_group_id . "/" . $page->page_group_id;
      }

      // if (isset($request->type) && isset($request->alias_category_id)) {
      //   $page = $arr[$request->type]::where('page_group_id', $request->alias_category_id)->first();
      //   // dd($page);
      //   $link = "/page/" . $page->page_category_group_id . "/" . $page->page_group_id;
      // }

      $model->update([
        'alias_category_id' => $request->alias_category_id ?? null,
        'menu_name' => $request->menu_name[$key] ?? null,
        'type' => $request->type,
        'link' => $link ?? null,
        'parent_id' => $request->parent_id ?? 0,
      ]);
    }

    return redirect("/admin/menu/edits?id=" . $grp_id);
  }

  public function orderchange(Request $request)
  {
    $at = \DB::table("menumakers")
      ->where("group", "=", $request->input("id"))->first();

    $ordermin = \DB::table("menumakers")
      ->where("parent_id", "=", $at->parent_id)->orderBy("orders")->first();
    $ordermax = \DB::table("menumakers")
      ->where("parent_id", "=", $at->parent_id)->orderByDesc("orders")->first();

    if ($request->input("p") == "up") {
      $older = MenuMaker::all()->where("parent_id", "=", $at->parent_id)
        ->where("orders", "=", $at->orders - 1);

      foreach ($older as $atx) {
        $ssx  = MenuMaker::all()->where("parent_id", "=", $at->parent_id)
          ->where("id", "=", $atx->id)->first();
        $ssx->orders = $atx->orders + 1;
        $ssx->update();
      }

      $ss  = MenuMaker::all()->where("group", "=", $at->group);

      foreach ($ss as $value) {
        $my = MenuMaker::all()->where("id", "=", $value->id)->first();
        if ($value->orders > $ordermin->orders) {
          $my->orders = $value->orders - 1;
          $my->update();
        }
      }
    } else {
      $older = MenuMaker::all()->where("parent_id", "=", $at->parent_id)
        ->where("orders", "=", $at->orders + 1);

      foreach ($older as $atx) {
        $ssx  = MenuMaker::all()->where("parent_id", "=", $at->parent_id)
          ->where("id", "=", $atx->id)->first();
        $ssx->orders = $atx->orders - 1;
        $ssx->update();
      }

      $ss  = MenuMaker::all()->where("group", "=", $at->group);

      foreach ($ss as $value) {
        $my = MenuMaker::all()->where("id", "=", $value->id)->first();
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
    $model = MenuMaker::all();

    /* for($i=0;$i<count($model);$i++){
            $me=MenuMaker::find($model[$i]->id);
            $me->orders= $i;
           // $me->update();

           // echo($me->id);
        }*/
  }

  public function destroy(Request $request)
  {
    $menu  = MenuMaker::where('group', Input::get('id'))->delete();
    $parentmenu = MenuMaker::where('parent_id', Input::get('id'))->delete();

    return redirect()->back();
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

  private function getGroupId()
  {
    return time();
  }
}
