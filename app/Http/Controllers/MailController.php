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
            'email' => 'required|email|unique:obunas'
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

    public static function sendPost($post)
    {
        // dd($post);
        $users = Obuna::select('email')->get();
        foreach ($users as $user) {
            $text = "New post!\nTitile: $post->title\nContent: $post->content";
            Mail::raw($text, function ($message) use ($user) {
                $message->from(env('MAIL_FROM_ADDRESS', 'noreply@greencentralasia.org'), env('MAIL_FROM_NAME', 'greencentralasia.org'));
                $message->to($user->email);
                // $message->cc('umid-berdiev82@mail.ru', 'Bobur');
                $message->subject('Запрос на авторизацию!');
            });
        }
    }
}
