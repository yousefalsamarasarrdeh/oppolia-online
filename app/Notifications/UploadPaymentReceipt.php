<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class UploadPaymentReceipt extends Notification
{
    use Queueable;

    protected $installment;
    protected $order;
    protected $customMessage;

    /**
     * إنشاء إشعار جديد مع رسالة مخصصة.
     *
     * @param mixed $installment دفعة المستخدم
     * @param mixed $order طلب المستخدم
     * @param string|null $customMessage رسالة مخصصة اختيارية
     */
    public function __construct($installment, $order, $customMessage = null)
    {
        $this->installment = $installment;
        $this->order = $order;
        $this->customMessage = $customMessage ?? '  يرجى رفع إيصال الدفع للدفعة رقم  ' . $this->installment->installment_number . ' الخاصة بالطلب رقم ' . $this->order->id;
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
            'installment_id' => $this->installment->id,
            'order_id' => $this->order->id,
            'message' => $this->customMessage,
        ];
    }
}
