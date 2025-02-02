<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class ThirdPaymentToCustomer extends Notification
{
    use Queueable;

    protected $order;

    /**
     * إنشاء إشعار جديد.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * تحديد قنوات الإشعار.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * البيانات المخزنة في قاعدة البيانات للإشعار.
     */
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'تم تسجيل الدفعة الثالثة لطلبك رقم ' . $this->order->id . '، يمكنك مراجعة تفاصيل الدفعات من حسابك.',
        ];
    }
}
