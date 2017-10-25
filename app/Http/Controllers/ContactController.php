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
        /*//try{
            $contact = Input::all();
            $name = $contact['name'];
            $email = $contact['email'];
            $msg = $contact['message'];

            Mail::send('email.contact', ['name' => $name, 'email' => $email, 'msg'=> $msg ], function ($message) use ($email,$name)
            {
                $message->from($email, $name);
                $message->subject("Message received from $name@bydjfordjs.in");
                $message->to('bydjfordjsteam@gmail.com');

            });
            flash('Message sent', 'success');
            return view('user.contact');
//        }catch(\Exception $exception){
//            return view('errors.error', compact('exception'));
//        }*/



        try{
            $contact = Input::all();
            $name = $contact['name'];
            $email = $contact['email'];
            $msg = $contact['message'];

            $url = env('ELASTIC_URL');

            $post = array('from' => $email,
                'fromName' => env('MAIL_FROM_NAME'),
                'apikey' => env('ELASTIC_KEY'),
                'subject' => "$name ($email) sent you a mail from bydjfordjs.in",
                'to' => env('MAIL_FROM_ADDRESS'),
                'bodyHtml' => $msg ."<br><br><br>" . env('APP_NAME'),
                'isTransactional' => true);

            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $post,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_SSL_VERIFYPEER => false
            ));

            $result=curl_exec ($ch);
            curl_close ($ch);


            flash('Message sent', 'success');
            return view('user.contact');

        }
        catch(\Exception $ex){
            return view('errors.error', compact('exception'));
        }
    }
}
