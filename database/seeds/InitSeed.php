<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InitSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
          'name' => 'Admin',
          'created_at' => Carbon::now()->toDateTimeString(),
          'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('roles')->insert([
          'name' => 'Consultant',
          'created_at' => Carbon::now()->toDateTimeString(),
          'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('users')->insert([
          'eid' => '1',
          'name' => 'admin',
          'password' => bcrypt('admin12345'),
          'role_id' => 1,
          'created_at' => Carbon::now()->toDateTimeString(),
          'updated_at' => Carbon::now()->toDateTimeString(),
          'last_login' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
