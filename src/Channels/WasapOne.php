<?php

namespace ZarulIzham\WasapOne\Channels;

use Illuminate\Notifications\Notification;
use ZarulIzham\WasapOne\Data\Message;
use ZarulIzham\WasapOne\Enums\AttachmentType;
use ZarulIzham\WasapOne\Facades\WasapOne as Wasap;

class WasapOne
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);

        if (get_class($message) != Message::class) {
            throw new \Exception("return type must be ZarulIzham\WasapOne\Data\Message class");
        }

        $whatsappNumber = $notifiable->routeNotificationForWhatsApp();

        if ($message->attachment_type == AttachmentType::TEXT) {
            Wasap::sendMessage($message->text, $whatsappNumber);
        } else {
            Wasap::sendMedia($message->attachment_url, $message->text, $whatsappNumber);
        }
    }
}
