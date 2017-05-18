<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name;
    public $message_text;
    public $download_url;
    public $receiver_user;
    public $file_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $receiver_user, $file_name, $message_text, $download_url)
    {
        $this->user_name = $user_name;
        $this->receiver_user = $receiver_user;
        $this->file_name = $file_name;
        $this->message_text = $message_text;
        $this->download_url = $download_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Up - new message')->view('email.mymail');
    }
}
