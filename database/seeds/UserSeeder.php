<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'name' => 'Testas',
            'email' => 'test@bilietas.lt',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Adminas',
            'email' => 'admin@bilietas.lt',
            'password' => bcrypt('password'),
            'user_level' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Redaktorius',
            'email' => 'redaktorius@bilietas.lt',
            'password' => bcrypt('password'),
            'user_level' => 2,
        ]);

    }
}
