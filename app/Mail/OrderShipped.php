<?php

namespace App\Mail;

use App\Comanda;
use App\Cart;
use App\ExtraType;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;


    public $comanda;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comanda $comanda)
    {
        $this->comanda = $comanda;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $types = ExtraType::all();
        return $this->from('botiga@aldarullgrup.cat')
        ->subject("Comanda Enregistrada")
        ->view('mails.comanda')->with('types',$types);
    }
}
