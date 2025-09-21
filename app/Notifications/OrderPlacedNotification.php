<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database']; // database notifications ke liye
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'order_placed',
            'order_id' => $this->order->id,
            'message' => "Your order #{$this->order->id} has been placed successfully.",
        ];
    }
}
