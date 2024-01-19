<?php

namespace ZarulIzham\WasapOne\Enums;

enum AttachmentType: int
{
    case TEXT = 1;
    case IMAGE = 2;
    case VIDEO = 3;
    case AUDIO = 4;
    case DOCUMENT = 5;
}
