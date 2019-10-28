<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Client;
use App\Submodul;
use App\Ticket;

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

        foreach (range(1,540) as $value) {
          $submodul = $faker->randomElement($submoduls);
          $images = [];
          $images_count = $faker->numberBetween(1,10);

          foreach (range(1,$images_count) as $imgKey => $img) {
            $images[] = "https://placeimg.com/420/320/tech";
          }

          $priority = ($value % 8 == 0) ? 3 : (($value % 2 == 0) ? 2 : 1);
          $status = ($value % 10 == 0) ? 3 : (($value % 3 == 0) ? 2 : 1);

          Ticket::create([
            'modul_id' => $submodul->modul_id,
            'submodul_id' => $submodul->id,
            'client_id' => $faker->numberBetween(1,20),
            'PIC' => $faker->firstName." ".$faker->lastName,
            'title' => $faker->bs,
            'message' => $faker->realText(500,5),
            'priority' => $priority,
            'img_links' => json_encode($images),
            'status' => $status,
            'created_at' => $faker->dateTimeBetween('-3 years', 'now', null),
            'updated_at' => Carbon::now(),
          ]);
        }
    }
}
