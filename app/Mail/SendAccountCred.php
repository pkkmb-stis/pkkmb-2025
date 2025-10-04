<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAccountCred extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.send-account-cred')
            ->subject('(No-Reply) Informasi Akun Website PKKMB 2025')
            ->with([
                'name' => $this->user['name'],
                'username' => $this->user['username'],
                'password' => $this->user['password'],
            ]);
    }
}
