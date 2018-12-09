<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'username' => 'javas',
            'password' => bcrypt('hello'),
        ]);
        
        DB::table('students')->insert([
            'first_name' => 'javas',
            'second_name' => 'favas',
            'birth_date' => '2018-12-04',
            'phone_number' => '88888888',
            'address' => 'somewhere',
            'email' => 'chain@gmail.com',
        ]);
    }
}
