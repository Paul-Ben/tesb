<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'sadmin@admin.com',
                'password' => bcrypt('123456'),
                'role_id' => 4,

            ],
            [
                'name' => 'John Doe',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),
                'role_id' => 3,

            ],
            [
                'name' => 'John Doe',
                'email' => 'user1@user.com',
                'password' => bcrypt('123456'),
                'role_id' => 2,
            ],
            [
                'name' => 'John Doe',
                'email' => 'user2@user.com',
                'password' => bcrypt('123456'),
                'role_id' => 1,

            ],
        ]);

        DB::table('teachers')->insert([
            [
                'user_id' => 1,
            ],
        ]);

        DB::table('guardians')->insert([
            [
                'user_id' => 4,
            ],
        ]);
    }
}
