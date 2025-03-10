<?php

namespace App\Notifications;

use App\Models\Designer;
use App\Models\Installment;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentReceiptUploaded extends Notification
{
    use Queueable;
    protected $order;
    protected $installment;
    protected $designer;


    public function __construct(Order $order ,Installment $installment, Designer $designer)
    {
        $this->installment = $installment;
        $this->designer = $designer;
        $this->order=$order;
    }

    public function via($notifiable)
    {
        return ['database']; // استخدام قاعدة البيانات كقناة للإشعارات
    }

    public function toDatabase($notifiable)
    {
        return [
            'installment_id' => $this->installment->id,
            'designer_id' => $this->designer->id,
            'order_id' => $this->order->id,
            'message' => 'العميل رفع إشعار دفع للدفعة رقم ' . $this->installment->installment_number,
        ];
    }
}
