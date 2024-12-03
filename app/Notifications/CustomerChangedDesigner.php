<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\User;  // استبدال Designer بـ User
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerChangedDesigner extends Notification
{
    use Queueable;

    protected $order;
    protected $user;  // استبدال designer بـ user

    public function __construct(Order $order, User $user)
    {
        $this->order = $order;
        $this->user = $user;  // تعيين المستخدم بدلاً من المصمم
    }

    public function via($notifiable)
    {
        return ['database']; // استخدام قاعدة البيانات كقناة للإشعارات
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'user_id' => $this->user->id,  // استبدال designer_id بـ user_id
            'message' => 'العميل طلب تغيير المصمم ', // الرسالة المعدلة
        ];
    }
}
