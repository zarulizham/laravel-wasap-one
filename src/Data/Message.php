<?php

namespace ZarulIzham\WasapOne\Data;

use Illuminate\Support\Str;
use Spatie\LaravelData\Data;
use ZarulIzham\WasapOne\Enums\AttachmentType;

class Message extends Data
{
    public function __construct(
        public ?string $text,
        public ?string $attachment_url,
        public ?string $attachment_mime_type,
        public ?AttachmentType $attachment_type = AttachmentType::TEXT,
    ) {
        if ($attachment_mime_type != '') {
            if (Str::contains('image/', $attachment_mime_type)) {
                $this->attachment_type = AttachmentType::IMAGE;
            } elseif (Str::contains('video/', $attachment_mime_type)) {
                $this->attachment_type = AttachmentType::VIDEO;
            } elseif (Str::contains('audio/', $attachment_mime_type)) {
                $this->attachment_type = AttachmentType::AUDIO;
            } else {
                $this->attachment_type = AttachmentType::DOCUMENT;
            }
        }

    }
}
