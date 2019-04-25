<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderFinished extends Mailable
{
    use Queueable, SerializesModels;


    public $codeSeg;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $codeSeg, string $name)
    {
        $this->name = $name;
        $this->codeSeg = $codeSeg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('botiga@aldarullgrup.cat')
        ->subject("Comanda preparada")
        ->view('mails.confirmacio');
    }
}
