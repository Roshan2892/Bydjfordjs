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
        return view('user.contact');
    }

    public function sendMail(){
        $contact = Input::all();
        $name = $contact['name'];
        $email = $contact['email'];
        $msg = $contact['message'];
        //dd($message);
        //['name' => $name, 'email' => $email, 'message'=> $message ]

        // Mail::to('roshansuvarna2892@gmail.com')
        // 	// ->from($email)
        // 	// ->subject($message)
        // 	->send(new MailOptions());
        Mail::plain('user.mail', ['name' => $name, 'email' => $email, 'msg'=> $msg ], function ($message) use ($email,$name)
        {

            $message->from($email, $name);
            $message->subject("Message received from $name@bydjfordjs.in");
            $message->to('bydjfordjsteam@gmail.com');

        });
        flash('Message sent', 'success');
        return view('user.contact');
    }
}
