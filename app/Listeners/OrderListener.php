<?php

namespace App\Listeners;

use App\Helpers\MetaHelper;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\InvalidEmailException;

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
            MetaHelper::make($event->event->client, $event->event->created_at);
            try {
                Mail::to($event->event->client->email)->send(new OrderShipped($event->event, 'client'));
            }catch (\Exception $exception){}
            //Mail::to($event->event->company->email)->send(new OrderShipped($event->event, 'company'));
            MetaHelper::score($event->event->client);

        }
        if ($event->event->status == 'transit') {
            Mail::to($event->event->client->email)->send(new OrderShipped($event->event, 'client'));
        }
    }
}
