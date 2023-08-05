<?php

namespace Maylancer\Paystack\Commands;

use Illuminate\Console\Command;

class PaystackCommand extends Command
{
    public $signature = 'paystack-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done updated');

        return self::SUCCESS;
    }
}
