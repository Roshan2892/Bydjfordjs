<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mailgun\Mailgun;
use Illuminate\Support\Facades\Input;

class MailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $mailgun = new Mailgun(env('MAILGUN_KEY'));
        $mailgunValidate = new Mailgun(env('MAILGUN_PUBKEY'));
        $mailgunOptIn = $mailgun->OptInHandler();
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $name = $request->name;
        $email = $request->email;

        $validate = $mailgunValidate->get('address/validate', [
            'address' => $email
        ])->http_response_body;

        if($validate->is_valid){
            $hash = $mailgunOptIn->generateHash(env('MAILGUN_LIST'), env('MAILGUN_SECRET'), $email);
            $mailgun->sendMessage(env('MAILGUN_DOMAIN'), [
                'from' => 'noreply@bydjfordjs.com',
                'to' => $email,
                'subject' => 'Please confirm your subscription',
                'html' => "Hello {$name}, You have signed up to our mailing list. Please confirm below. <br><br> http://127.0.0.1:8000/subscribe/{$hash}"
            ]);

            $mailgun->post('lists/' . env('MAILGUN_LIST') . '/members', [
                'name' => $name,
                'address' => $email,
                'subscribed' => 'no'
            ]);
        }
    }

    public function confirmSubscriptions(Request $request)
    {
        $mailgun = new Mailgun(env('MAILGUN_KEY'));
        $mailgunValidate = new Mailgun(env('MAILGUN_PUBKEY'));
        $mailgunOptIn = $mailgun->OptInHandler();

        $url = $request->path();
        $token = substr($url, strpos($url, '/') + 1);
        $hash = $mailgunOptIn->validateHash(env('MAILGUN_SECRET'), $token);

        if($hash){
            $list = $hash['mailingList'];
            $email = $hash['recipientAddress'];

            $mailgun->put('lists/' . env('MAILGUN_LIST') . '/members/' . $email, [
                'subscribed' => 'yes'
            ]);

            $mailgun->sendMessage(env('MAILGUN_DOMAIN'), [
                'from' => 'noreply@bydjfordjsteam.com',
                'to' => $email,
                'subject' => 'You have just subscribed',
                'html' => 'Thanks for confirming, you are now subscribed'
            ]);

            return redirect()->to('/');
        }
    }

    public function showMailForm($value='')
    {
        // return view('')
    }

    public function sendBulkMails($value='')
    {
        # code...
    }
}
