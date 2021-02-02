<?php

namespace App\Mail\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
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
        $this->replyTo($this->data['reply_email'], $this->data['reply_name'])
            ->to(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->from($this->data['reply_email'],  $this->data['reply_name'])
            ->subject('Novo Contato: ' . $this->data['reply_name']);
        return $this->markdown('web.email',[
            'name' => $this->data['reply_name'],
            'email' => $this->data['reply_email'],
            'message' => $this->data['message'],
            'cell' => $this->data['cell'],
        ]);
    }
}
