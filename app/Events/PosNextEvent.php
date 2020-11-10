<?php

namespace App\Events;

use App\Models\Admin\EventNext;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PosNextEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var EventNext
     */
    public $event;


    /**
     * Create a new event instance.
     *
     * @param EventNext $event
     * @param $request
     */
    public function __construct(EventNext $event)
    {


        $this->event = $event;
    }

}
