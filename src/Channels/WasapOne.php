<?php

namespace ZarulIzham\WasapOne\Channels;

use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;
use ZarulIzham\WasapOne\Facades\WasapOne as Wasap;

class WasapOne
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);

        if (is_array($message)) {
            $message = $message['message'];
            $isGroup = $message['is_group'] ?? false;
        } else {
            $isGroup = false;
        }

        if ($notifiable instanceof AnonymousNotifiable) {
            $whatsappNumber = $notifiable->routes['WhatsApp'];
        } else {
            $whatsappNumber = $notifiable->routeNotificationForWhatsApp();
        }

        Wasap::sendMessage($message, $whatsappNumber, $isGroup);
    }
}
