<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('sectors')->truncate();

        DB::table('sectors')->insert([
            'size' => 20,
            'price_per_seat' => 100,
        ]);

        DB::table('sectors')->insert([
            'size' => 30,
            'price_per_seat' => 20,
        ]);

        DB::table('sectors')->insert([
            'size' => 60,
            'price_per_seat' => 10,
        ]);

        DB::table('sectors')->insert([
            'size' => 100,
            'price_per_seat' => 5.5,
        ]);
    }
}
