<?php

namespace App\Events;

use App\Models\Admin\EventLast;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PosLastEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var EventLast
     */
    public $event;


    /**
     * Create a new event instance.
     *
     * @param EventLast $event
     * @param $request
     */
    public function __construct(EventLast $event)
    {


        $this->event = $event;
    }

}
