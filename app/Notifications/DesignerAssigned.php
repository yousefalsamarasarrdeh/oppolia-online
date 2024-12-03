<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DesignerAssigned extends Notification
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
        // إذا كان الكائن من نوع App\Models\User، نستخدم user_id بدلاً من designer_id
        if ($notifiable instanceof \App\Models\User) {
            return [
                'order_id' => $this->order->id,
                'user_id' => $this->designer->id, // استخدام user_id في حال كان notifiable هو User
                'message' => 'الإدارة قامت بتعيينك كمصمم مسؤول عن هذا الطلب.',
            ];
        }

        // إذا كان الكائن ليس من نوع User (أي أنه مصمم)، نستخدم designer_id
        return [
            'order_id' => $this->order->id,
            'designer_id' => $this->designer->id, // استخدام designer_id في حال كان notifiable ليس User
            'message' => 'الإدارة قامت بتعيينك كمصمم مسؤول عن هذا الطلب.',
        ];
    }
}
