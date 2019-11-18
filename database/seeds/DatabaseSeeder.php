<?php

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
        $this->call(InitRolesTableSeeder::class);
        $this->call(InitModulsTableSeeder::class);
        $this->call(InitSubmodulsTableSeeder::class);
        $this->call(InitUsersTableSeeder::class);
        $this->call(InitAssignmentsTableSeeder::class);
        $this->call(InitClientsTableSeeder::class);
        $this->call(InitPICSeeder::class);
        $this->call(InitTicketTableSeeder::class);
    }
}
