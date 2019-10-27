<?php

use Illuminate\Database\Seeder;

class InitModulsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('moduls')->delete();
        
        \DB::table('moduls')->insert(array (
            0 => 
            array (
                'id' => 'LO',
                'name' => 'Logistic',
                'created_at' => '2019-10-22 03:43:31',
                'updated_at' => '2019-10-23 08:53:16',
            ),
            1 => 
            array (
                'id' => 'FI',
                'name' => 'Financial Accounting',
                'created_at' => '2019-10-23 08:55:14',
                'updated_at' => '2019-10-23 08:55:14',
            ),
            2 => 
            array (
                'id' => 'CO',
                'name' => 'Controlling',
                'created_at' => '2019-10-26 14:53:20',
                'updated_at' => '2019-10-26 14:53:20',
            ),
        ));
        
        
    }
}