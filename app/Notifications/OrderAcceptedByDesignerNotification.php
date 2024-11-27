<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderAcceptedByDesignerNotification extends Notification
{
    use Queueable;

    public $order;
    public $designer;

    /**
     * Create a new notification instance.
     *
     * @param $order
     * @param $designer
     */
    public function __construct($order, $designer)
    {
        $this->order = $order;
        $this->designer = $designer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; // تخزين الإشعار في قاعدة البيانات
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->order->user_id,
            'order_id' => $this->order->id,
            'designer_name' => $this->designer->user->name,
            'message' => "المصمم {$this->designer->user->name} وافق على هذا الطلب {$this->order->id}.",
        ];
    }
}
