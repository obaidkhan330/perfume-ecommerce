<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusChangedNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $oldStatus;
    protected $newStatus;

    public function __construct($order, $oldStatus, $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'order_status_changed',
            'order_id' => $this->order->id,
            // message me old/new dono sahi variable use ho rahe hain
            'message' => "Order #{$this->order->id} status changed from {$this->oldStatus} to {$this->newStatus}",
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            // optional: order url so user can click from notification
            'order_url' => url("/orders/{$this->order->id}")
        ];
    }

    public function toArray($notifiable)
    {
        return $this->toDatabase($notifiable);
    }
}
