<?php

namespace App\Http\Controllers\admin;

use App\language;
use App\Raxbariyat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class RaxbariyatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $raxbariyat = Raxbariyat::where('language_id','=',$this->getlang())->paginate(10);
        return view('admin.raxbariyat')->with('table',$raxbariyat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function getlang()
    {
               $model = language::all()->where('status','=','1')->where("language_prefix","=",\App::getLocale())->first();
        if($model)
        return $model->id;
        else
        {
            $model = language::all()->where('status','=','1')->where("language_prefix",'en')->first();
            return $model->id;


        }
    }
    public function create()
    {
        $lang = language::all();
        return view("admin.raxbariyat_add",[

            "languages"=>$lang,
        ]);
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

        $validatedData = $request->validate([
            'fio' => 'required|max:255',
            'major' => 'required|max:255',
            'language_id' => 'required',
            'qabul' => 'required',
            'short' => 'required',
            'vazifa' => 'required',
            'tel' => 'required',
            'faks' => 'required',
            'email' => 'required',
            'cover' => 'required',

        ]);
        $grp_id = $this->getgroup_id();
        foreach ($request->input("language_id") as $key=>$value) {
            $raxbariyat = new Raxbariyat();
            if (isset($request->input('fio')[$key]))
                $raxbariyat->fio = Input::get('fio')[$key];
            else
                $raxbariyat->fio = "";
            if (isset($request->input('major')[$key]))
                $raxbariyat->major = Input::get('major')[$key];
            else
                $raxbariyat->major = "";
            if (isset($request->input('qabul')[$key]))
                $raxbariyat->qabul = Input::get('qabul')[$key];
            else
                $raxbariyat->qabul = "";
            if (isset($request->input('short')[$key]))
                $raxbariyat->short = Input::get('short')[$key];
            else
                $raxbariyat->short = "";
            if (isset($request->input('vazifa')[$key]))
                $raxbariyat->vazifa = Input::get('vazifa')[$key];
            else
                $raxbariyat->vazifa = "";
            $raxbariyat->tel = Input::get('tel');
            $raxbariyat->faks = Input::get('faks');
            $raxbariyat->email = Input::get('email');
            $raxbariyat->photo_url =  Storage::putFile('public', $request->file('cover'));
            $raxbariyat->group = $grp_id;
            $raxbariyat->language_id = $value;

            $raxbariyat->save();

        }
        return redirect("/admin/raxbariyat");

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
    public function edit(Request $request)
    {
        $lang = language::all();
        $raxbariyat = Raxbariyat::where('group','=', Input::get('id'))->get();
        return view('admin.raxbariyat_edit')->with('raxbariyat',$raxbariyat)->with('languages',$lang);

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
            'fio' => 'required|max:255',
            'major' => 'required|max:255',
            'language_id' => 'required',
            'qabul' => 'required',
            'short' => 'required',
            'vazifa' => 'required',
            'tel' => 'required',
            'faks' => 'required',
            'email' => 'required',
            'group' => 'required',


        ]);

        $id = Input::get('group');
        foreach ($request->input("language_id") as $key=>$value) {
            $raxbariyat = Raxbariyat::all()
                ->where("group", "=", $id)
                ->where("language_id", "=", $value)
                ->first();
           // dd($raxbariyat);
            if (isset($request->input('fio')[$key]))
                $raxbariyat->fio = Input::get('fio')[$key];
            else
                $raxbariyat->fio = "";
            if (isset($request->input('major')[$key]))
                $raxbariyat->major = Input::get('major')[$key];
            else
                $raxbariyat->major = "";
            if (isset($request->input('qabul')[$key]))
                $raxbariyat->qabul = Input::get('qabul')[$key];
            else
                $raxbariyat->qabul = "";
            if (isset($request->input('short')[$key]))
                $raxbariyat->short = Input::get('short')[$key];
            else
                $raxbariyat->short = "";
            if (isset($request->input('vazifa')[$key]))
                $raxbariyat->vazifa = Input::get('vazifa')[$key];
            else
                $raxbariyat->vazifa = "";
            $raxbariyat->tel = Input::get('tel');
            $raxbariyat->faks = Input::get('faks');
            $raxbariyat->email = Input::get('email');
            if ($request->hasFile('cover'))
                $raxbariyat->photo_url =  Storage::putFile('public', $request->file('cover'));

            $raxbariyat->language_id = $value;

            $raxbariyat->update();


        }
        return redirect("admin/raxbariyat");

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
        $model = Raxbariyat::where("group","=",$request->input("id"))->delete();;



        return redirect("admin/raxbariyat");
    }

    private function getgroup_id(){
        return time();
    }
}
