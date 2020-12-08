<?php

namespace App\Listeners;

use App\Helpers\MetaHelper;
use App\Mail\OrderMail;
use App\Mail\OrderShipped;
use App\Models\Admin\Item;
use App\Models\Admin\Meta;
use Illuminate\Support\Facades\DB;
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
        if ($event->event->items):
            MetaHelper::make($event->event->client, $event->event->created_at->format('m'));
        endif;
        if ($event->event->status == 'completed') {
            Mail::to($event->event->client->email)->send(new OrderShipped($event->event, 'client'));
            //Mail::to($event->event->company->email)->send(new OrderShipped($event->event, 'company'));


        }
        if ($event->event->status == 'transit') {
            Mail::to($event->event->client->email)->send(new OrderShipped($event->event, 'client'));
        }
    }
}
