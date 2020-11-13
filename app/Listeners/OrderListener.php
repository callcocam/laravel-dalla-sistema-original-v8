<?php

namespace App\Listeners;

use App\Mail\OrderMail;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class OrderListener
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if($event->event->status=='completed'){
           // Mail::to($event->event->client->email)->send(new OrderShipped($event->event, 'client'));
           // Mail::to($event->event->company->email)->send(new OrderShipped($event->event, 'company'));
        }
       }
}
