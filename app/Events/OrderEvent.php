<?php

namespace App\Events;

use App\Models\Admin\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Order
     */
    public $event;


    /**
     * Create a new event instance.
     *
     * @param Order $event
     */
    public function __construct(Order $event)
    {


        $this->event = $event;
    }

}
