<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandeFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;  // Pour stocker les données que vous souhaitez envoyer avec l'email

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data; 
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->subject('Demande d\'inscription')
                    ->view('demandeform')
                    ->with(['data' => $this->data]);
    }
}
