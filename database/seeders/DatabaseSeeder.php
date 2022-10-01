<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
                'name' => 'WJTI Admin',
                'email' => 'wjtiadmin@regcalls.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234'), // password
                'remember_token' => Str::random(10),
         ]);

         \App\Models\User::factory()->create([
            'name' => 'Anushka Deshan',
            'email' => 'anushkadeshan@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('appachchi123'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
