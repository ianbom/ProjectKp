<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'password' => Hash::make('admin123'),
          'roles' => 'ADMIN'
        ]);

        DB::table('users')->insert([
            'name' => 'Ian',
            'email' => 'ianbom@gmail.com',
            'password' => Hash::make('ianbom123'),
            'roles' => 'ADMIN'
          ]);

          DB::table('users')->insert([
            'name' => 'Ale',
            'email' => 'alebom@gmail.com',
            'password' => Hash::make('alebom123'),
            'roles' => 'ADMIN'
          ]);

          DB::table('clients')->insert([
            'name' => 'client1',
            'slug' => 'client1',
            'password' => 'client123',
            'photo' => 'photo.jpg'
          ]);

          DB::table('clients')->insert([
            'name' => 'client2',
            'slug' => 'client2',
            'password' =>'client123',
            'photo' => 'photo.jpg'
          ]);
    }
}
