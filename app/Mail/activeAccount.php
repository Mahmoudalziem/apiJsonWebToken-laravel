<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class activeAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$verify)
    {
        $this->verify = $verify;

        $this->email = $data['email'];

        $this->name = $data['name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailer/activeAccount')
                    ->subject('Active Account')
                    ->with([
                        'name' => $this->name,
                        'email' => $this->email,
                        'verify' => $this->verify
                    ]);
    }
}
