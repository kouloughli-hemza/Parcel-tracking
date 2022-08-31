<?php

namespace Database\Seeders;

use Dsone\Societe;
use Illuminate\Database\Seeder;

class SocieteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Societe::create([
            'name'=> 'PFE Mila',
            'address' => 'INSFP Mila',
            'phone' => '0000000000'
        ]);
    }
}
