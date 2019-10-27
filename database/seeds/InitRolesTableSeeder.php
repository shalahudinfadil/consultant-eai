<?php

use Illuminate\Database\Seeder;

class InitRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'created_at' => '2019-10-21 17:47:00',
                'updated_at' => '2019-10-21 17:47:00',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Consultant',
                'created_at' => '2019-10-21 17:47:00',
                'updated_at' => '2019-10-21 17:47:00',
            ),
        ));
        
        
    }
}