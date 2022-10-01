<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        $user = User::create([
            'name' => 'WJTI Admin',
            'email' => 'wjtiadmin@regcalls.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'remember_token' => Str::random(10),
       ]);

       $user = User::create([
            'name' => 'Anushka Deshan',
            'email' => 'anushkadeshan@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('appachchi123'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
