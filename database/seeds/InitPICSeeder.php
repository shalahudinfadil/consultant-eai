<?php

use Illuminate\Database\Seeder;
use App\Client;
use App\Pic;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InitPICSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pics')->delete();

        $faker = Faker::create();
        $clients = Client::all()->pluck('id')->toArray();

        foreach (range(1,45) as $counter) {
          $fname = $faker->firstName;
          $lname = $faker->lastName;
          Pic::create([
            'name' => $fname." ".$lname,
            'email' => $fname.$lname."@".$faker->freeEmailDomain,
            'password' => bcrypt($fname),
            'client_id' => $faker->randomElement($clients),
            'token' => Str::random(40),
            'verified' => ($counter % 3 == 0) ? 1 : 0,
            'approved_at' => ($counter % 6 == 0) ? Carbon::now()->toDateTimeString() : null,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
          ]);
        }
    }
}
