<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Client;
use Carbon\Carbon;

class InitClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('clients')->truncate();

        $faker = Faker::create('Client');

        foreach (range(1,20) as $key => $value) {
          Client::create([
            'name' => $faker->company,
            'client_token' => Str::random(40), 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);
        }
    }
}
