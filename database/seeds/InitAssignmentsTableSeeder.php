<?php

use Illuminate\Database\Seeder;
use App\Assignment;
use App\Submodul;
use App\User;
use Carbon\Carbon;

class InitAssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('assignments')->delete();
        $submoduls = Submodul::all();
        $users = User::where('role_id',2)->get();

        foreach ($users->chunk(4) as $chunkKey => $userChunk) {
          foreach ($userChunk as $user) {
            Assignment::create([
              'eid' => $user->eid,
              'modul_id' => $submoduls[$chunkKey]->modul_id,
              'submodul_id' => $submoduls[$chunkKey]->id,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }
        }
    }
}
