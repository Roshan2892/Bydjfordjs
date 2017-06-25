<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Subscription;

class SubscribeToNewsletters extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $name, $randomString;

    public function __construct($name, $randomString)
    {
        $this->name = $name;
        $this->randomString = $randomString;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.subscribe')
            ->subject('Bydjfordjs - Subscribe to Newsletters')
            ->with([
                'name' => $this->name,
                'url' => 'http://127.0.0.1:8000/subscribe/'.$this->randomString
            ]);
    }
}
