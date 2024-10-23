<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\Order;
use App\Models\Designer;

class CustomerRequestRedesign extends Notification
{
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
            'message' => 'العميل طلب إعادة التصميم لهذا الطلب!',
        ];
    }
}
