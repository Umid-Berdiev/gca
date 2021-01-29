<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use App\Obuna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public static function send($first, $second, $fio, $from, $receiver, $type, $id = null, $link = null)
    {
        $objDemo = new \stdClass();
        $objDemo->demo_one = $first;
        $objDemo->demo_two = $second;
        $objDemo->fio = $fio;
        $objDemo->type = $type;
        $objDemo->sender = $from;
        $objDemo->receiver = $receiver;
        $objDemo->id = $id;
        $objDemo->link = $link;
        Mail::to($receiver)->send(new DemoEmail($objDemo));
    }

    public function newObuna(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'requierd|email|unique:obunas'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Obuna::create([
            'email' => $request->email
        ]);
        return back()->with('success', 'Email is added');
    }
}
