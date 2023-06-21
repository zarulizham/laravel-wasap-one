<?php

namespace ZarulIzham\WasapOne\Channels;

use Illuminate\Notifications\Notification;
use ZarulIzham\WasapOne\Facades\WasapOne as Wasap;

class WasapOne
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);
        $whatsappNumber = $notifiable->routeNotificationForWhatsApp();
        Wasap::sendMessage($message, $whatsappNumber);
    }
}