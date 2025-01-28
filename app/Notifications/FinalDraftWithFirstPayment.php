<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class FinalDraftWithFirstPayment extends Notification
{
    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'تم إرسال تصميم نهائي لطلبك رقم ' . $this->order->id . '، يرجى الاطلاع على التفاصيل فهي تحتوي على السعر بعد الخصم و مبلغ الدفعة الاولى.',
            //  'url' => route('orders.show', $this->order->id),
        ];
    }
}
