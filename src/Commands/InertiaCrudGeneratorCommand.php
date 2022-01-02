<?php

namespace Saidjon\InertiaCrudGenerator\Commands;

use Illuminate\Console\Command;

class InertiaCrudGeneratorCommand extends Command
{
    public $signature = 'inertia-crud-generator';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
