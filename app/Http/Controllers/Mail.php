<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    public $mailgun = new Mailgun(env('MAILGUN_KEY'));
    public $mailgunValidate = new Mailgun(env('MAILGUN_PUBKEY'));
    public $mailgunOptIn = $mailgun->OptInHandler();

    
}
