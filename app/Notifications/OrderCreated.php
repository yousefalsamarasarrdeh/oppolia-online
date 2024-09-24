<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreated extends Notification
{
    use Queueable;

    public $order;
    public $designer;

    /**
     * Create a new notification instance.
     */
    public function __construct($order , $designer)
    {
        $this->order = $order;
        $this->designer = $designer;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database']; // نستخدم قناة الـ database
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'designer_id' => $this->designer->id, // حفظ المصمم
            'message' => 'طلب جديد بحاجة لمصمم!',
        ];
    }
}
