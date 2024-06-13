<?php

namespace Webkul\LeadPerson\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LeadPersonAttributeSeeder::class);

        $this->call(RemoveAttributeSeeder::class);
    }
}