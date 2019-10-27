<?php

use Illuminate\Database\Seeder;

class InitSubmodulsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('submoduls')->delete();
        
        \DB::table('submoduls')->insert(array (
            0 => 
            array (
                'id' => 'MM',
                'modul_id' => 'LO',
                'name' => 'Material Management',
                'created_at' => '2019-10-22 03:43:31',
                'updated_at' => '2019-10-23 08:27:01',
            ),
            1 => 
            array (
                'id' => 'PP',
                'modul_id' => 'LO',
                'name' => 'Production, Planning & Control',
                'created_at' => '2019-10-22 03:43:31',
                'updated_at' => '2019-10-23 08:27:01',
            ),
            2 => 
            array (
                'id' => 'PM',
                'modul_id' => 'LO',
                'name' => 'Plant Maintenance',
                'created_at' => '2019-10-22 03:43:31',
                'updated_at' => '2019-10-23 08:27:01',
            ),
            3 => 
            array (
                'id' => 'PS',
                'modul_id' => 'LO',
                'name' => 'Project Systems',
                'created_at' => '2019-10-22 03:43:31',
                'updated_at' => '2019-10-23 08:31:28',
            ),
            4 => 
            array (
                'id' => 'SD',
                'modul_id' => 'LO',
                'name' => 'Sales & Distribution',
                'created_at' => '2019-10-23 08:53:34',
                'updated_at' => '2019-10-23 08:53:40',
            ),
            5 => 
            array (
                'id' => 'QM',
                'modul_id' => 'LO',
                'name' => 'Quality Management',
                'created_at' => '2019-10-23 08:53:49',
                'updated_at' => '2019-10-23 08:53:49',
            ),
            6 => 
            array (
                'id' => 'GL',
                'modul_id' => 'FI',
                'name' => 'General Ledger',
                'created_at' => '2019-10-23 08:55:14',
                'updated_at' => '2019-10-23 08:55:14',
            ),
            7 => 
            array (
                'id' => 'AP',
                'modul_id' => 'FI',
                'name' => 'Account Payable',
                'created_at' => '2019-10-23 08:55:14',
                'updated_at' => '2019-10-23 08:55:14',
            ),
            8 => 
            array (
                'id' => 'AR',
                'modul_id' => 'FI',
                'name' => 'Account Receivable',
                'created_at' => '2019-10-23 08:55:14',
                'updated_at' => '2019-10-23 08:55:14',
            ),
            9 => 
            array (
                'id' => 'SL',
                'modul_id' => 'FI',
                'name' => 'Special Purpose Ledger',
                'created_at' => '2019-10-23 08:55:14',
                'updated_at' => '2019-10-23 08:55:14',
            ),
            10 => 
            array (
                'id' => 'BL',
                'modul_id' => 'FI',
                'name' => 'Banking & Loans',
                'created_at' => '2019-10-23 08:55:14',
                'updated_at' => '2019-10-26 14:51:18',
            ),
            11 => 
            array (
                'id' => 'AA',
                'modul_id' => 'FI',
                'name' => 'Asset Accounting',
                'created_at' => '2019-10-26 14:51:18',
                'updated_at' => '2019-10-26 14:51:18',
            ),
            12 => 
            array (
                'id' => 'FM',
                'modul_id' => 'FI',
                'name' => 'Funds Management',
                'created_at' => '2019-10-26 14:51:18',
                'updated_at' => '2019-10-26 14:51:18',
            ),
            13 => 
            array (
                'id' => 'LC',
                'modul_id' => 'FI',
                'name' => 'Legal Consolidations',
                'created_at' => '2019-10-26 14:51:18',
                'updated_at' => '2019-10-26 14:51:18',
            ),
            14 => 
            array (
                'id' => 'TM',
                'modul_id' => 'FI',
                'name' => 'Travel Management',
                'created_at' => '2019-10-26 14:51:18',
                'updated_at' => '2019-10-26 14:51:18',
            ),
            15 => 
            array (
                'id' => 'CEA',
                'modul_id' => 'CO',
                'name' => 'Cost Element Accounting',
                'created_at' => '2019-10-26 14:53:20',
                'updated_at' => '2019-10-26 14:53:20',
            ),
            16 => 
            array (
                'id' => 'CCA',
                'modul_id' => 'CO',
                'name' => 'Cost Center Accounting',
                'created_at' => '2019-10-26 14:53:20',
                'updated_at' => '2019-10-26 14:53:20',
            ),
            17 => 
            array (
                'id' => 'IA',
                'modul_id' => 'CO',
                'name' => 'Internal Orders',
                'created_at' => '2019-10-26 14:53:20',
                'updated_at' => '2019-10-26 14:53:20',
            ),
            18 => 
            array (
                'id' => 'ABC',
                'modul_id' => 'CO',
                'name' => 'Activity-Based Costing',
                'created_at' => '2019-10-26 14:53:20',
                'updated_at' => '2019-10-26 14:53:20',
            ),
            19 => 
            array (
                'id' => 'PC',
                'modul_id' => 'CO',
                'name' => 'Product Cost Controlling',
                'created_at' => '2019-10-26 14:53:20',
                'updated_at' => '2019-10-26 14:53:20',
            ),
            20 => 
            array (
                'id' => 'PA',
                'modul_id' => 'CO',
                'name' => 'Profitability Analysis',
                'created_at' => '2019-10-26 14:53:20',
                'updated_at' => '2019-10-26 14:53:20',
            ),
            21 => 
            array (
                'id' => 'PCA',
                'modul_id' => 'CO',
                'name' => 'Profit Center Accounting',
                'created_at' => '2019-10-26 14:53:20',
                'updated_at' => '2019-10-26 14:53:20',
            ),
            22 => 
            array (
                'id' => 'OM',
                'modul_id' => 'CO',
                'name' => 'Overhead Cost Controlling',
                'created_at' => '2019-10-26 14:53:20',
                'updated_at' => '2019-10-26 14:53:20',
            ),
            23 => 
            array (
                'id' => 'ML',
                'modul_id' => 'CO',
                'name' => 'Material Ledger',
                'created_at' => '2019-10-26 14:53:20',
                'updated_at' => '2019-10-26 14:53:20',
            ),
            24 => 
            array (
                'id' => 'SM',
                'modul_id' => 'LO',
                'name' => 'Service management',
                'created_at' => '2019-10-26 14:54:35',
                'updated_at' => '2019-10-26 14:54:35',
            ),
            25 => 
            array (
                'id' => 'PDM',
                'modul_id' => 'LO',
                'name' => 'Product data Management',
                'created_at' => '2019-10-26 14:54:35',
                'updated_at' => '2019-10-26 14:54:35',
            ),
        ));
        
        
    }
}