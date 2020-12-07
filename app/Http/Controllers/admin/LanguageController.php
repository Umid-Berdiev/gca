<?php

namespace App\Http\Controllers\admin;

use App\language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;

class LanguageController extends Controller
{
    public function index() {
        $model = DB::table("languages")->paginate(10);
     return view('admin.lang',[
            'table'=>$model

        ]);
    }
    public function Insert(Request $request) {
        $validatedData = $request->validate([
            'language_name' => 'required|max:255',
            'language_prefix' => 'required|max:255',

        ]);

            $model = new language();
            $model->language_name = $request->post("language_name");
            $model->language_prefix = $request->post("language_prefix");
            $model->status = 1;
            $model->save();

            return redirect("admin/language");

    }
    public function Update(Request $request) {

        $validatedData = $request->validate([
            'language_name' => 'required|max:255',
            'id' => 'required',
            'language_prefix' => 'required|max:255',

        ]);

        $model = language::all()->where("id","=",$request->post("id"))->first();
        $model->language_name = $request->post("language_name");
        $model->language_prefix = $request->post("language_prefix");

        $model->update();

        return redirect("admin/language");

    }
    public function UpdateShow(Request $request) {


        $model = language::all()->where("id","=",$request->get("id"))->first();


        return view("admin.langedit",[
            'model'=>$model
        ]);



    }
    public function Delete(Request $request) {


        $validatedData = $request->validate([

            'id' => 'required',


        ]);


	    $model = language::all()->where("id","=",$request->post("id"))->first();
	    $model->status = 0;
	    $model->delete();



        return redirect("admin/language");

    }
    public function Show() {


        return view('admin.langinser');
    }

}
