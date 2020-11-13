<?php

namespace App\Listeners;

use App\Models\Admin\PosEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PosListener
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event = $event->event;

        if($event->pos_event()->first()){

            return true;

        }

        $event->pos_event()->getRelated()->saveBy([
            'event_id'=>$event->id,
            'status'=>'published',
            'updated_at'=>date("y-m-d")
        ]);
    }
}
