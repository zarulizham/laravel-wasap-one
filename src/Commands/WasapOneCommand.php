<?php

namespace ZarulIzham\WasapOne\Commands;

use Illuminate\Console\Command;

class WasapOneCommand extends Command
{
    public $signature = 'laravel-wasap-one';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
