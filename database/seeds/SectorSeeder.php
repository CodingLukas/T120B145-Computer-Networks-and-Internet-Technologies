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
        DB::table('sectors')->truncate();

        DB::table('sectors')->insert([
            'size' => 20,
        ]);
        DB::table('sectors')->insert([
            'size' => 30,
        ]);
        DB::table('sectors')->insert([
            'size' => 60,
        ]);
        DB::table('sectors')->insert([
            'size' => 100,
        ]);
    }
}
