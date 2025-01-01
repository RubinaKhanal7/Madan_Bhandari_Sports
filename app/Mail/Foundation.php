<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Foundation extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $verificationToken;

    public function __construct($data, $verificationToken)
    {
        $this->data = $data;
        $this->verificationToken = $verificationToken;
    }

    public function build()
    {
        return $this->view('frontend.includes.contact')
                    ->with([
                        'name' => $this->data['name'],
                        'email' => $this->data['email'],
                        'verificationUrl' => route('frontend.includes.contact', $this->verificationToken),
                    ]);
    }
}
