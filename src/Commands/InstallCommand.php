<?php

namespace Chrisdicarlo\SimpleJetstreamMultitenancy\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'sjm:install';

    public $description = 'Install simple-jetstream-multitenancy';

    public function handle()
    {
        if (! file_exists(config_path('simple-jetstream-multitenancy.php'))) {
            $this->callSilent('vendor:publish', ['--tag' => 'simple-jetstream-multitenancy-config', '--force' => true]);
        }

        $tenantModel = $this->choice(
            'Which model will be your tenant?',
            ['App\Models\Team', 'App\Models\User'],
            0,
            $maxAttempts = null,
            $allowMultipleSelections = false
        );

        $this->replaceInFile("'tenant_model' => null", "'tenant_model' => '{$tenantModel}'", config_path('simple-jetstream-multitenancy.php'));

        $this->comment('All done');
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
