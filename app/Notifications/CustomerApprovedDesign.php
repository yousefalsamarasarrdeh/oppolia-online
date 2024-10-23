<?php

namespace App\Notifications;

use App\Models\Designer;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerApprovedDesign extends Notification
{
    use Queueable;
    protected $order;
    protected $designer;

    public function __construct(Order $order, Designer $designer)
    {
        $this->order = $order;
        $this->designer = $designer;
    }

    public function via($notifiable)
    {
        return ['database']; // استخدام قاعدة البيانات كقناة للإشعارات
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'designer_id' => $this->designer->id,
            'message' => 'العميل وافق على هذه التصميم',
        ];
    }


}
