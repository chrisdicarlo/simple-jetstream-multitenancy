<?php

namespace Chrisdicarlo\SimpleJetstreamMultitenancy\Commands;

use Illuminate\Console\Command;

class AddTenantIdColumnMigrationCommand extends Command
{
    public $signature = 'sjm:migration {model: Add the tenant_id column to the model table}';

    public $description = 'Create a migration to add the tenant_id column to the specified model table';

    public function handle()
    {
        $tenantModel = config('simple-jetstream-multitenancy.tenant_model');
        $tenanTable = with(new $tenantModel)->getTable();
        $modelTable = with(new $this->argument('model'))->getTable();
        
        $fullPath = $this->createBaseMigration($modelTable);
        $this->files->put($fullPath, $this->files->get(__DIR__.'/../../../stubs/database/migrations/add_tenant_id_column_to.stub'));

        $this->replaceInFile('TENANT_TABLE', $tenanTable, $fullPath);
        $this->replaceInFile('MODEL_TABLE', $modelTable, $fullPath);

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

    /**
     * Create a base migration file for the session.
     *
     * @return string
     */
    protected function createBaseMigration($modelTable)
    {
        $name = 'add_tenant_id_to_'.$modelTable.'_table';

        $path = $this->laravel->databasePath().'/migrations';

        return $this->laravel['migration.creator']->create($name, $path);
    }
}
