<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\LeadPerson\Database\Seeders\DatabaseSeeder as LeadPersonDatabaseSeeder;
use Webkul\Driver\Database\Seeders\DatabaseSeeder as DriverDatabaseSeeder;
use Webkul\Core\Database\Seeders\DatabaseSeeder as CoreDatabaseSeeder;
use Webkul\User\Database\Seeders\DatabaseSeeder as UserDatabaseSeeder;
use Webkul\Admin\Database\Seeders\DatabaseSeeder as AdminDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminDatabaseSeeder::class);
        $this->call(CoreDatabaseSeeder::class);
        $this->call(UserDatabaseSeeder::class);
        $this->call(LeadPersonDatabaseSeeder::class);
        $this->call(DriverDatabaseSeeder::class);
    }
}
