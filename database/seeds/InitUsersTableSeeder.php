<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class InitUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        $faker = Faker::Create('User');

        foreach (range(1,105) as $key => $value) {
          User::create([
            'eid' => ($value < 10) ? '1202100'.$value : (($value < 100) ? '120210'.$value : '12021'.$value),
            'name' => ($value == 1) ? 'Administrator' : $faker->firstName.' '.$faker->lastName,
            'password' => Hash::make(($value < 10) ? '1202100'.$value : (($value < 100) ? '120210'.$value : '12021'.$value)),
            'role_id' => ($value == 1) ? 1 : 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);
        }
    }
}
