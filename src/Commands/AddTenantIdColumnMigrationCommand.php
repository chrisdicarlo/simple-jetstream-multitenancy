<?php

namespace Chrisdicarlo\SimpleJetstreamMultitenancy\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;

class AddTenantIdColumnMigrationCommand extends Command
{
    public $signature = 'sjm:migration {model : Add the tenant_id column to the model table}';

    public $description = 'Create a migration to add the tenant_id column to the specified model table';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {
        $tenantModel = config('simple-jetstream-multitenancy.tenant_model');
        $tenanTable = with(new $tenantModel)->getTable();

        $model = $this->argument('model');
        $modelTable = with(new $model)->getTable();
        
        $fullPath = $this->createBaseMigration($modelTable);
        $this->files->put($fullPath, $this->files->get(__DIR__.'/../../stubs/database/migrations/add_tenant_id_column_to.stub'));

        $tenantColumnType = DB::getSchemaBuilder()
            ->getColumnType($tenanTable, 'id') === 'bigint' ? 'unsignedBigInteger' : 'unsignedInteger';

        $this->replaceInFile('TENANT_TABLE', $tenanTable, $fullPath);
        $this->replaceInFile('MODEL_TABLE', $modelTable, $fullPath);
        $this->replaceInFile('TENANT_COLUMN_TYPE', $tenantColumnType, $fullPath);

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
