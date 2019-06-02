<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Test 1',
            'email' => 'admin@test.kz',
            'password' => bcrypt('123'),
            'role' => User::ADMIN
        ]);

        User::insert([
            'name' => 'Test 2',
            'email' => 'moderator@test.kz',
            'password' => bcrypt('123'),
            'role' => User::MODERATOR
        ]);

        User::insert([
            'name' => 'Test 3',
            'email' => 'guest@test.kz',
            'password' => bcrypt('123'),
            'role' => User::GUEST
        ]);
    }
}
