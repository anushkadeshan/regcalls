<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin\Group;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;

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

       //create Default Group
        $group = Group::create([
            'name' => 'Regcalls',
            'address' => 'Sample',
            'description' => 'Sample',
            'phone' => 'Sample',
        ]);

        //add default profile and group
        $this->addDefaultGroupAndProfile($user,$group);
        $this->createProfiles();
    }

    protected function addDefaultGroupAndProfile(User $user, Group $group){
        $user->groups()->syncWithoutDetaching($group->id);
        $user->attachRoleAndGroup('Super Admin',$group->id);
    }

    protected function createProfiles(){
        $profiles = ['Super Admin','Local Admin','Module Admin','User'];
        foreach($profiles as $key => $profile){
            Role::create([
                'name' => $profile,
                'guard' => 'sanctum'
            ]);
        }
    }
}
