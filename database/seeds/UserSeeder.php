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
        DB::table('users')->insert(
            [
                'uid' => '216331470',
                'email' => 'ilayalmalem@gmail.com',
                'role' => 'student',
                'school_id' => 1,
                'password' => 'Ilay9876'
            ],
            [
                'uid' => '216331471',
                'email' => 'roeybrache@gmail.com',
                'role' => 'teacher',
                'school_id' => 1,
                'password' => 'Ilay9876'
            ]
        );
    }
}
