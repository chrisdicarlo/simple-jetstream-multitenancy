<?php

namespace Chrisdicarlo\SimpleJetstreamMultitenancy\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'sjm:install';

    public $description = 'Install simple-jetstream-multitenancy';

    public function handle()
    {
        if(! file_exists(config_path('simple-jetstream-multitenancy.php'))) {
            $this->call('vendor:publish --tag=simple-jetstream-multitenancy-config');

        $this->comment('All done');
    }
}
