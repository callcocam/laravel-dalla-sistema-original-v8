<?php

namespace App\Events;

use App\Models\Admin\VisitsDistributor;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VisitorEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var VisitsDistributor
     */
    public $event;

    /**
     * Create a new event instance.
     *
     * @param VisitsDistributor $event
     */
    public function __construct(VisitsDistributor $event)
    {


        $this->event = $event;
    }

}
