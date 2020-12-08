<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendUser extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this
        ->subject('A User just requested for leave')
        ->view('emails.userEmail')
        ->with('data', $this->data);
    }
}


// public function build()
// {   
//     return $this->from('nwangumav@gmail.com')
//     ->subject('A User just requested for leave')
//     ->view('emails.userEmail')
//     ->with('data', $this->data);
// }