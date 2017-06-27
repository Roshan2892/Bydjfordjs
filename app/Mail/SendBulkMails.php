<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBulkMails extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email, $name, $message, $subject;
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
                'url' => 'http://127.0.0.1:8000/unsubscribe/'.$this->email
            ]);
    }
}
