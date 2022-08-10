<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Data Members
     */
    public $userName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name)
    {
        $this->userName = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ecom@yopmail.com', 'Ecom')
            ->view('emails.register')
            ->with('userName', $this->userName);
    }
}
