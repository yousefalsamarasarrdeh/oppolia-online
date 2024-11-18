<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\JoinAsADesigner;

class DesignerJoined extends Notification
{
    use Queueable;

    protected $JoinAsADesigner;
    public function __construct( $JoinAsADesigner)
    {
        $this->JoinAsADesigner = $JoinAsADesigner;
    }


    public function via($notifiable)
    {
        return ['database']; // نستخدم قناة الـ database
    }

    public function toDatabase($notifiable)
    {
        return [
            'join_as_designer_id' => $this->JoinAsADesigner->id, // إرجاع معرف المصمم
            'message' => 'مصمم جديد يريد الانظمام إلى النظام.', // الرسالة
        ];
    }



}
