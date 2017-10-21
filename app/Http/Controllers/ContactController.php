<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailOptions;

class ContactController extends Controller
{
    public function index(){
        try{
            return view('user.contact');
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    public function sendMail(){
        try{
            $contact = Input::all();
            $name = $contact['name'];
            $email = $contact['email'];
            $msg = $contact['message'];

            Mail::plain('email.contact', ['name' => $name, 'email' => $email, 'msg'=> $msg ], function ($message) use ($email,$name)
            {
                $message->from($email, $name);
                $message->subject("Message received from $name@bydjfordjs.in");
                $message->to('bydjfordjsteam@gmail.com');

            });
            flash('Message sent', 'success');
            return view('user.contact');
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }
}
