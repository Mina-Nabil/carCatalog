<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestInfo extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $mail;
    private $phone;
    private $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $mail, $phone, $body)
    {
        $this->name= $name;
        $this->mail= $mail;
        $this->phone= $phone;
        $this->body= $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['name'] = $this->name;
        $data['mail'] = $this->mail;
        $data['phone'] = $this->phone;
        $data['body'] = $this->body;
        return $this->view('mails.info', $data);
    }
}
