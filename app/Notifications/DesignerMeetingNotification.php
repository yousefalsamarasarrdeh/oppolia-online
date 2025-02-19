<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DesignerMeetingNotification extends Notification
{
    use Queueable;

    public $order;
    public $designer;
    public $meetingTime;
    public $message; // إضافة متغير لتخزين الرسالة

    /**
     * Create a new notification instance.
     *
     * @param $order
     * @param $designer
     * @param $meetingTime
     * @param string|null $message (اختياري)
     */
    public function __construct($order, $designer, $meetingTime, $message = null)
    {
        $this->order = $order;
        $this->designer = $designer;
        $this->meetingTime = $meetingTime;

        // تحديد الرسالة الافتراضية إذا لم يتم تمرير رسالة مخصصة
        $this->message = $message ?? "المصمم {$this->designer->user->name} قام بزيارة العميل للطلب رقم {$this->order->id} بتاريخ {$this->meetingTime}.";
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
            'order_id' => $this->order->id,
            'designer_name' => $this->designer->user->name,
            'meeting_time' => $this->meetingTime,
            'message' => $this->message, // استخدام الرسالة المخصصة أو الافتراضية
        ];
    }
}
