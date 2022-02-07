<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailEstoque extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $param;
    public function __construct($param = null)
    {
        $this->param = $param;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('giseletbrin@gmail.com')
            ->subject('Envio de email Teste')
            ->view('emails.estoque_list')
            ->with([
                'estoque' => $this->param['estoque']
        ]);
    }
}
