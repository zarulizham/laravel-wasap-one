<?php

namespace ZarulIzham\WasapOne\Traits;

trait HasWhatsAppNotifiable
{
    public function routeNotificationForWhatsApp()
    {
        return $this->mobile_number;
    }
}