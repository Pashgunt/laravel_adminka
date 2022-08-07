<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoveryPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected string $userName;
    protected string $accessToken;

    public function __construct(string $userName, string $accessToken)
    {
        $this->userName = $userName;
        $this->accessToken = $accessToken;
    }

    public function build()
    {
        return $this->view('mails.recovery')->with([
            "userName"=> $this->userName,
            "accessToken" => $this->accessToken
        ]);
    }
}
