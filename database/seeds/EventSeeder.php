<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // DB::table('events')->truncate();

        DB::table('events')->insert([
            'name' => 'Krepšinis',
            //'start_date' => now(),
            //'end_date' => now()->addDays(10),
            //'user_id' => 0,
            'active' => 1
        ]);

        DB::table('events')->insert([
            'name' => 'Futbolas',
            //'start_date' => now(),
            //'end_date' => now()->addDays(15),
            //'user_id' => 0,
            'active' => 0
        ]);
    }
}
