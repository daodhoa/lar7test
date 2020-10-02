<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifySignUp extends Mailable
{
    use Queueable, SerializesModels;

    private $link;

    /**
     * Create a new message instance.
     *
     * @param String $link
     */
    public function __construct(String $link)
    {
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.verify_sign_up')->with([
            'link' => $this->link
        ]);
    }
}
