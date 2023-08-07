<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class DevDemo extends Seeder
{
    // prepare the demo database for development and demosite

    public function run()
    {

        Cache::flush();
        Schema::disableForeignKeyConstraints();

        // truncate database tables
        DB::table('users')->truncate();

        // seed data
        $this->call([
            DemoUserSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
