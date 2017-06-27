<?php

namespace App\Http\Controllers;

use App\Mail\SendBulkMails;
use App\Subscription;
use Illuminate\Http\Request;
use App\Mail\SubscribeToNewsletters;
use App\Mail\ConfirmSubscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin')->except('subscribe', 'confirmSubscriptions','unsubscribe');
    } 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $name = $request->name;
        $email = $request->email;

        $subscription_table = DB::table('subscriptions')
            ->get()
            ->where('email','=', $email);
        if(count($subscription_table) >= 1){
            flash('You are already subscribed', 'danger');
            return redirect()->back();
        }
        else{
            $subscription = new Subscription;
            $subscription->name = $name;
            $subscription->email = $email;
            $randomString =str_random(30);
            $subscription->random_string = $randomString;
            $subscription->subscribed = 0;
            $subscription->save();
            Mail::to($email)->send(new SubscribeToNewsletters($name, $randomString));
            flash('A mail has been sent to your inbox', 'success');
            return redirect()->back();
        }
    }

    public function confirmSubscriptions(Request $request)
    {
        $randomString = substr($request->path(),10);
        $subscription = Subscription::get()->where('random_string', $randomString)->first();
        if($subscription->subscribed == 0){
            $email = $subscription->email;
            $name = $subscription->name;
            $randomString = str_random(30);
            DB::table('subscriptions')
                ->where('id',$subscription->id)
                ->update(['subscribed' => 1]);
            Mail::to($email)->send(new ConfirmSubscription($name, $randomString, $email));
            flash('You are now subscribed', 'success');
        }
        return redirect()->to('/');
    }

    public function showMailForm()
    {
        return view('admin.mails.mail');
    }

    public function sendBulkMails(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'description' => 'required'
        ]);

        $subject = $request['subject'];
        $message = $request['description'];
        $subscription = Subscription::get()->where('subscribed', 1);
        foreach ($subscription as $sub) {
            Mail::to($sub->email)->queue(new SendBulkMails($sub->email, $sub->name, $subject, $message));
        }
        flash('Mail has been sent', 'success');
        return redirect()->back();
    }

    public function unsubscribe(Request $request)
    {
        $email = substr($request->path(),12);
        $subscription = Subscription::get()->where('email', $email)->first();

        if($subscription->subscribed == 1){
            DB::table('subscriptions')->where('email',$email)->delete();
            flash('You are unsubscribed', 'danger');
        }
        return redirect()->to('/');
    }
}
