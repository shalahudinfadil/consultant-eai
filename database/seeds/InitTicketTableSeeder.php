<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Client;
use App\Submodul;
use App\Ticket;
use App\Pic;

class InitTicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tickets')->truncate();

        $faker = Faker::create('Ticket');

        $submoduls = Submodul::all();
        $pics = Pic::all()->pluck('id')->toArray();

        foreach (range(1,540) as $value) {
          $submodul = $faker->randomElement($submoduls);
          $images = [];
          $images_count = $faker->numberBetween(1,10);

          foreach (range(1,$images_count) as $imgKey => $img) {
            $images[] = $faker->randomElement([
              "https://placeimg.com/800/600/tech",
              "https://placeimg.com/800/600/animals",
              "https://placeimg.com/800/600/arch",
              "https://placeimg.com/800/600/nature",
              "https://placeimg.com/800/600/people"
            ]);
          }

          $priority = ($value % 8 == 0) ? 3 : (($value % 2 == 0) ? 2 : 1);
          $status = ($value % 10 == 0) ? 3 : (($value % 3 == 0) ? 2 : 1);

          $dates = [];
          for ($date = Carbon::now()->startOfWeek(); $date->lt(Carbon::now()); $date->addDays()) {
            $dates[] = Carbon::create($date->toDateTimeString())->addHours(rand(1,12))->toDateTimeString();
          }

          $seed_date = $faker->randomElement($dates);

          $working_at = ($status != 1) ? Carbon::create($seed_date)->addHours(rand(1,72))->toDateTimeString() : null;
          $closing_at = ($status == 3) ? Carbon::create($working_at)->addHours(rand(1,72))->toDateTimeString() : null;

          Ticket::create([
            'modul_id' => $submodul->modul_id,
            'submodul_id' => $submodul->id,
            'client_id' => $faker->numberBetween(1,20),
            'pic_id' => $faker->randomElement($pics),
            'title' => $faker->bs,
            'message' => $faker->realText(500,5),
            'priority' => $priority,
            'img_links' => $images,
            'status' => $status,
            'created_at' => $seed_date,
            'updated_at' => $seed_date,
            'working_at' => $working_at,
            'closing_at' => $closing_at,
          ]);
        }
    }
}
