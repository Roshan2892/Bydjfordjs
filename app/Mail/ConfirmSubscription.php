<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmSubscription extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $randomString, $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($name, $randomString, $email)
    {
        $this->name = $name;
        $this->randomString = $randomString;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.confirm_subscription')
            ->subject('Welcome to Bydjfordjs')
            ->with([
                'name' => $this->name,
                'url' => 'http://127.0.0.1:8000/unsubscribe/'.$this->email
            ]);
    }
}
