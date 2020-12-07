<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function send($first,$second,$fio,$from,$receiver,$type,$id = null,$link = null)
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
}