<?php

namespace Chrisdicarlo\SimpleJetstreamMultitenancy\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'sjm:install';

    public $description = 'Install simple-jetstream-multitenancy';

    public function handle()
    {
        
        $this->comment('All done');
    }
}
