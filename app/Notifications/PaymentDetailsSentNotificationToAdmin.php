<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentDetailsSentNotificationToAdmin extends Notification
{
    use Queueable;

    public $order;
    public $designer;
    public $installment;

    /**
     * Create a new notification instance.
     *
     * @param $order
     * @param $designer
     * @param $installment
     */
    public function __construct($order, $designer, $installment)
    {
        $this->order = $order;
        $this->designer = $designer;
        $this->installment = $installment;
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
            'installment_amount' => $this->installment->installment_amount,
            'installment_number' => $this->installment->installment_number, // إضافة رقم الدفعة
            'message' => "المصمم {$this->designer->user->name} أرسل تفاصيل الدفعة رقم ({$this->installment->installment_number}) بمبلغ ({$this->installment->installment_amount} ريال) للطلب {$this->order->id}.",
        ];
    }
}
