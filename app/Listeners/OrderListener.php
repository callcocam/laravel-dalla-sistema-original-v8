<?php

namespace App\Listeners;

use App\Helpers\MetaHelper;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class OrderListener
{

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {

        if ($event->event->status == 'completed') {
            MetaHelper::make($event->event->client, $event->event->created_at->format('m'));
            Mail::to($event->event->client->email)->send(new OrderShipped($event->event, 'client'));
            //Mail::to($event->event->company->email)->send(new OrderShipped($event->event, 'company'));
        }
        if ($event->event->status == 'transit') {
            Mail::to($event->event->client->email)->send(new OrderShipped($event->event, 'client'));
        }
    }
}
