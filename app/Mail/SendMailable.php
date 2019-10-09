<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $myotp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email');
    }
    public function set($customsubject,$otp,$name)
    {
        $this->from[0] = array(
            'address' => 'gogreen.s4u@gmail.com',
            'name'=>'DTHOCM',
        );
        $this->subject = $customsubject;
        $this->myotp = $otp;
        $this->name = $name;
    }
}
