<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class ManufactureAndInstallationNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $customMessage;

    /**
     * إنشاء إشعار جديد مع رسالة مخصصة.
     */
    public function __construct($order, $customMessage = null)
    {
        $this->order = $order;
        $this->customMessage = $customMessage ?? 'تم تحديث حالة التصنيع والتركيب لطلبك رقم ' . $this->order->id;
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
            'message' => $this->customMessage,
        ];
    }
}
