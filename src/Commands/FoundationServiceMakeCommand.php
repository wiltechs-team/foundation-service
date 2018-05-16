<?php

namespace wiltechsteam\FoundationService\Commands;

use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Console\Command;

class FoundationServiceMakeCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foundation:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Foundation Make';

    protected $loggerHandler;

    /**
     * FoundationServiceCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handle
     *
     */
    public function handle()
    {
        $this->createDirectories();
        if(!file_exists(base_path('config/foundation.php')))
        {
            copy(
                __DIR__.'/stubs/config/foundation.stub',
                base_path('config/foundation.php')
            );
        }

        copy(
            __DIR__.'/stubs/migrations/2018_05_15_095650_create_staffs_cn_table.stub',
            database_path('migrations/2018_05_15_095650_create_staffs_cn_table.php')
        );

        copy(
            __DIR__.'/stubs/migrations/2018_05_15_100005_create_positions_cn_table.stub',
            database_path('migrations/2018_05_15_100005_create_positions_cn_table.php')
        );

        copy(
            __DIR__.'/stubs/migrations/2018_05_15_100033_create_units_cn_table.stub',
            database_path('migrations/2018_05_15_100033_create_units_cn_table.php')
        );

        copy(
            __DIR__.'/stubs/migrations/2018_05_15_100059_create_staffs_us_table.stub',
            database_path('migrations/2018_05_15_100059_create_staffs_us_table.php')
        );

        copy(
            __DIR__.'/stubs/migrations/2018_05_15_100127_create_positions_us_table.stub',
            database_path('migrations/2018_05_15_100127_create_positions_us_table.php')
        );

        copy(
            __DIR__.'/stubs/migrations/2018_05_15_100150_create_units_us_table.stub',
            database_path('migrations/2018_05_15_100150_create_units_us_table.php')
        );

        file_put_contents(
            base_path(config('foundation.models_namespace').'/StaffsCN.php'),
            $this->compileStaffCNModelStub()
        );

        file_put_contents(
            base_path(config('foundation.models_namespace').'/PositionsCN.php'),
            $this->compilePositionCNModelStub()
        );

        file_put_contents(
            base_path(config('foundation.models_namespace').'/UnitsCN.php'),
            $this->compileUnitCNModelStub()
        );

        file_put_contents(
            base_path(config('foundation.models_namespace').'/StaffsUS.php'),
            $this->compileStaffUSModelStub()
        );

        file_put_contents(
            base_path(config('foundation.models_namespace').'/PositionsUS.php'),
            $this->compilePositionUSModelStub()
        );

        file_put_contents(
            base_path(config('foundation.models_namespace').'/UnitsUS.php'),
            $this->compileUnitUSModelStub()
        );

        $this->info('successfully.');
    }

    /**
     * 创建目录
     */
    protected function createDirectories()
    {
        if (! is_dir($directory = base_path(config('foundation.models_namespace')))) {
            mkdir($directory, 0755, true);
        }

        if (! is_dir($directory = 'database\migrations')) {
            mkdir($directory, 0755, true);
        }
    }

    protected function compileStaffCNModelStub()
    {
        return str_replace(
            '{{namespace}}',
            config('foundation.models_namespace'),
            file_get_contents(__DIR__.'/stubs/models/StaffsCN.stub')
        );
    }


    protected function compilePositionCNModelStub()
    {
        return str_replace(
            '{{namespace}}',
            config('foundation.models_namespace'),
            file_get_contents(__DIR__.'/stubs/models/PositionsCN.stub')
        );
    }

    protected function compileUnitCNModelStub()
    {
        return str_replace(
            '{{namespace}}',
            config('foundation.models_namespace'),
            file_get_contents(__DIR__.'/stubs/models/UnitsCN.stub')
        );
    }

    protected function compileStaffUSModelStub()
    {
        return str_replace(
            '{{namespace}}',
            config('foundation.models_namespace'),
            file_get_contents(__DIR__.'/stubs/models/StaffsUS.stub')
        );
    }


    protected function compilePositionUSModelStub()
    {
        return str_replace(
            '{{namespace}}',
            config('foundation.models_namespace'),
            file_get_contents(__DIR__.'/stubs/models/PositionsUS.stub')
        );
    }

    protected function compileUnitUSModelStub()
    {
        return str_replace(
            '{{namespace}}',
            config('foundation.models_namespace'),
            file_get_contents(__DIR__.'/stubs/models/UnitsUS.stub')
        );
    }




}