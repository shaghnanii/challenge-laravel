<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RequestSeeder::class,
            ConnectionSeeder::class,
        ]);
//        when migrating with fresh it will automatically install the passport
        Artisan::call("passport:install");
    }
}
