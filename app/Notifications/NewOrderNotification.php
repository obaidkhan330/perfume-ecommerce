<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database']; // sirf database me save hoga
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'new_order',
            'order_id' => $this->order->id,
            'message' => "New order #{$this->order->id} placed",
            'customer_name' => $this->order->customer_name ?? null,
            'total' => $this->order->total ?? null,
        ];
    }

    public function toArray($notifiable)
    {
        return $this->toDatabase($notifiable);
    }
}
