<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBulkMails extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email, $name, $message, $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($email, $name, $subject, $message)
    {

        $this->email = $email;
        $this->name = $name;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('email.send_bulk_mails')
            ->subject($this->subject)
            ->with([
                'name' => $this->name,
                'desc' => $this->message,
                'url' => env('APP_URL').'/unsubscribe/'.$this->email
            ]);
    }
}
