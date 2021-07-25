<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($name)
    {
        $this->name = $name;
    }


    public function build()
    {
        return $this->from('admoasis123@gmail.com', 'ChatO2O')
            ->subject('Welcome to ChatO2O')->view('welcome-mail', ['name'=> $this->name]);
    }
}
