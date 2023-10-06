<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'role' => 'user',
                'name' => 'Muhammad Hasan',
                'email' => 'hasan@mail.com',
                'password' => bcrypt('secret'),
                'created_at' => Carbon::now('Asia/Jakarta'),
                'updated_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                'role' => 'admin',
                'name' => 'Maulana Ibrahim',
                'email' => 'admin.maul@mail.com',
                'password' => bcrypt('secret'),
                'created_at' => Carbon::now('Asia/Jakarta'),
                'updated_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                'role' => 'admin',
                'name' => 'Ammar Malik',
                'email' => 'admin.malik@mail.com',
                'password' => bcrypt('secret'),
                'created_at' => Carbon::now('Asia/Jakarta'),
                'updated_at' => Carbon::now('Asia/Jakarta'),
            ],
        ]);
    }
}
