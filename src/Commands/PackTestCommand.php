<?php

namespace JoseVasquezRamos\PackTest\Commands;

use Illuminate\Console\Command;

class PackTestCommand extends Command
{
    public $signature = 'pack-test';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
