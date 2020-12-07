<?php

namespace App\Http\Controllers;

use App\Contact;
use App\CvForm;
use App\Mail\DemoEmail;
use App\ObjectSend;
use App\Obuna;
use Illuminate\Http\Request;
use App\language;
use App\tender;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $events = \DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getlang())
      ->where("eventcategories.language_id", "=", $this->getlang())->take(5)->get();
    $last_month = Carbon::now()->addMonth(-1);
    $now = Carbon::now();

    $last_month1 = Carbon::now()->addMonth(-1)->toDateString();
    $now1 = Carbon::now()->toDateString();
    $all = ObjectSend::whereBetween('created_at', [$last_month, $now])->get()->count();
    $fiz = ObjectSend::whereBetween('created_at', [$last_month, $now])->where('object_type', '=', 'Жисмоний шахс')->count();
    $yur = ObjectSend::whereBetween('created_at', [$last_month, $now])->where('object_type', '=', 'Юридик шахс')->count();
    $worked = ObjectSend::whereBetween('created_at', [$last_month, $now])->where('status', '=', 1)->count();
    $finished = ObjectSend::whereBetween('created_at', [$last_month, $now])->where('status', '=', 3)->count();
    $languages = language::where('status', 1)->get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getlang())->get();
    return view('send_doc')
      ->with('languages', $languages)
      ->with('tenders', $tenders)
      ->with('all', $all)
      ->with('fiz', $fiz)
      ->with('yur', $yur)
      ->with('last_month', $last_month)
      ->with('now', $now)
      ->with('last_month1', $last_month1)
      ->with('events', $events)
      ->with('now1', $now1)
      ->with('worked', $worked)
      ->with('finished', $finished);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  public function indexContact()
  {
    $contacts = Contact::paginate(15);

    return view('admin.contact')->with('contacts', $contacts);
  }

  public function ContactSearch(Request $request)
  {
    $validatedData = $request->validate([

      'search' => 'required',
    ]);

    $contacts = Contact::where('fio', 'LIKE', '%' . Input::get('search') . '%')->paginate(15);

    if ($request->has('search')) {
      return view('admin.contact')->with('contacts', $contacts);
    } else
      return redirect()->back()->with('contacts', $contacts);
  }

  public function indexCV()
  {
    $cvs = CvForm::orderBy('id', 'desc')->paginate(15);
    return view('admin.cv')->with('cvs', $cvs);
  }
  public  function indexCVedit($id)
  {
    $cv = CvForm::where('id', '=', $id)->first();

    return view('admin.cv_edit')->with('cv', $cv);
  }

  public function cvSave(Request $request)
  {
    $cv = CvForm::find(Input::get('id'));

    $cv->status = Input::get('status');
    $cv->update();

    MailController::send($cv->unique_number, '', $cv->status, 'murojaat@minwater.uz', $cv->email, 'murojat_re');

    return redirect()->back();
  }
  public function CvSearch(Request $request)
  {
    $validatedData = $request->validate([

      'search' => 'required',
    ]);

    $cvs = CvForm::where('fio', 'LIKE', '%' . Input::get('search') . '%')->paginate(15);

    if ($request->has('search')) {
      return view('admin.cv')->with('cvs', $cvs);
    } else
      return redirect()->back()->with('cvs', $cvs);
  }
  public function indexMurojat()
  {
    $objects = ObjectSend::orderBy('id', 'desc')->paginate(10);

    return view('admin.murojat')->with('objects', $objects);
  }
  public function Murojat_edit($id)
  {
    $object = ObjectSend::find($id);
    return view('admin.murojat_edit')->with('object', $object);
  }
  public function murojat_update(Request $request)
  {
    $object = ObjectSend::find(Input::get('id'));
    $object->status = Input::get('status');
    $object->update();

    MailController::send($object->unique_number, '', $object->status, 'murojaat@minwater.uz', $object->email, 'murojat_re');



    return redirect()->back();
  }
  public function murojatSearch(Request $request)
  {
    $validatedData = $request->validate([

      'search' => 'required',
    ]);
    $objects = ObjectSend::where('fio', 'LIKE', '%' . Input::get('search') . '%')->paginate(15);

    if ($request->has('search')) {
      return view('admin.murojat')->with('objects', $objects);
    } else
      return redirect()->back()->with('objects', $objects);
  }

  public function check(Request $request)
  {

    $validatedData = $request->validate([
      'aplication_id' => 'required|max:255',

    ]);

    $object_app = ObjectSend::where('unique_number', '=', Input::get('aplication_id'))->first();

    return redirect()->back()->with('check', $object_app);
  }

  public function  contact()
  {
    $events = \DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $this->getlang())
      ->where("eventcategories.language_id", "=", $this->getlang())->take(5)->get();
    $languages = language::where('status', 1)->get();
    $tenders = tender::take(3)->where('title', '<>', '')->where('language_id', '=', $this->getlang())->get();
    return view('gca.contact')
      ->with('languages', $languages)
      ->with('events', $events)
      ->with('tenders', $tenders);
  }

  public function  contact_post(Request $request)
  {
    $request->validate([
      'fio' => 'required',
      'phone' => 'required',
      'email' => 'required',
    ]);
    $contact = new Contact();
    $contact->fio = Input::get('fio');
    $contact->email = Input::get('email');
    $contact->phone = Input::get('phone');
    $contact->comment = Input::get('comment');
    $contact->save();

    //        MailController::send(Input::get('fio'),Input::get('comment'),'','info@water.gov.uz','murojaat@minwater.uz','contact');
    //        MailController::send(Input::get('fio'),Input::get('comment'),'','info@water.gov.uz',Input::get('email'),'contact_client');

    return redirect()->back()->with('message', 'Мурожаатингиз қабул қилинди');
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
      'fio' => 'required|max:255',
      'birth' => 'required',
      'passport' => 'required',
      'adress' => 'required',
      'index' => 'required',
      'email' => 'required|email',
      'phone_number' => 'required',
      'object_type' => 'required',
      'comment' => 'required',
    ]);

    $object_send = new ObjectSend();
    $object_send->fio = Input::get('fio');
    $object_send->birth = Input::get('birth');
    $object_send->passport = Input::get('passport');
    $object_send->adress = Input::get('adress');
    $object_send->index = Input::get('index');
    $object_send->email = Input::get('email');
    $object_send->phone_number = Input::get('phone_number');
    $object_send->object_type = Input::get('object_type');
    $object_send->comment = Input::get('comment');
    $object_send->status = 0;
    $object_send->unique_number = "BCM" . Carbon::now()->timestamp;;
    $object_send->save();

    MailController::send($object_send->unique_number, Input::get('comment'), Input::get('fio'), 'info@water.gov.uz', 'murojaat@minwater.uz', 'murojat');
    MailController::send($object_send->unique_number, '', Input::get('fio'), 'info@water.gov.uz', Input::get('email'), 'murojat_client');

    return redirect()->back()->with('message', $object_send->unique_number);
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
  public function destroy($id)
  {
    //
  }
  public function getlang()
  {
    $model = language::all()->where("language_prefix", "=", \App::getLocale())->first();

    return $model->id;
  }

  public function obuna(Request $request)
  {
    $validatedData = $request->validate([
      'email' => 'required|max:255|email',

    ]);

    $obuna = new Obuna();
    $obuna->email = Input::get('email');
    $obuna->save();

    return redirect()->back()->with('message', '');
  }

  public function orpho(Request $request)
  {

    $validatedData = $request->validate([
      'errortxt' => 'required',
      'comment' => 'required',
    ]);

    MailController::send($request->input('errortxt'), '', $request->input('comment'), 'info@water.gov.uz', 'murojaat@minwater.uz', 'orph');
    return redirect()->back();
  }

  public function deleteObune(Request $request)
  {
    $model = Obuna::where('id', "=", $request->input("id"))->delete();

    return redirect(App::getLocale() . '/');
  }
}
