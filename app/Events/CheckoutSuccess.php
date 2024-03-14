<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Customers\src\Models\Customer;
use Modules\Orders\src\Models\Order;

class CheckoutSuccess
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $customer;
    public $order;
    public function __construct(Customer $customer, Order $order)
    {
        $this->customer = $customer;
        $this->order = $order;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
