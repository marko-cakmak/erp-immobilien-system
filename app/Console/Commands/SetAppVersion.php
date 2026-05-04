<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetAppVersion extends Command
{
    protected $signature = 'app:set-version {version}';

    protected $description = 'Set the application version in the database';

    public function handle()
    {
        $version = $this->argument('version');

        DB::table('app_config')->updateOrInsert(
            ['key' => 'app_version'],
            ['value' => $version, 'updated_at' => now()]
        );

        $this->info("App version set to: {$version}");
    }
}
