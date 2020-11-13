<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    protected $order;
    protected $template;

    /**
     * Create a new message instance.
     *
     * @param $event
     * @param $template
     */
    public function __construct($event, $template)
    {
        $this->order = $event;
        $this->template = $template;
        $this->subject(sprintf("Pedido ( %s ) realizado no sistema %s", str_pad($this->order->id, 7, '0', STR_PAD_LEFT), $this->order->company->name ));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown(sprintf('emails.orders.%s', $this->template))
            ->with('client_title', sprintf("Prezado(a) Sr.(a) %s, seu pedido ( %s ) foi recebido com sucesso!!", $this->order->client->name, str_pad($this->order->id, 7, '0', STR_PAD_LEFT)))
            ->with('company_title', sprintf("O Sr.(a) %s, acaba de realizar um pedido,  ( %s )!!", $this->order->client->name, str_pad($this->order->id, 7, '0', STR_PAD_LEFT)))
            ->with('client_message', sprintf("Obrigado por sua preferencia, logo entraremos em contato"))
            ->with('company_message', sprintf("Aguardando retorno"))
            ->with('rows',$this->order)
            ->with('client', route('admin.clients.show', $this->order->client->id))
            ->with('url', route('admin.orders.show', $this->order->id));
    }
}
