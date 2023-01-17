<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use PDO;
use App\Models\User;
use App\Models\Admin\Group;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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

        //create profiles
        $this->createProfiles();

        //add default profile and group
        $this->addDefaultGroupAndProfile($user,$group);

        $this->createPermissions();

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
                'guard_name' => 'sanctum'
            ]);
        }
    }

    protected function createPermissions(){
        $permissions = [
            'Create Role',
            'Create Permission',
            'Create Translation',
            'Edit Translation',
            'Delete Translation',
            'Create User',
            'Edit User',
            'View User',
            'Delete User',
            'Create Group',
            'Edit Group',
            'View Group',
            'View Permissions',
            'Edit Permission',
            'Create Apps',
            'View Apps',
            'Edit Apps',
            'View Roles',
            'Assign Groups to User',
            'Assign Profiles to User',
            'Assign Apps to Group',
            'Delete Group',
            'View Databases',
            'Edit Database',
            'Sync Tables',
            'Create Stock',
            'Edit Stock',
            'View Stock',
            'Delete Stock',
            'Create Product',
            'View Product',
            'Edit Product',
            'Delete Product',
            'View Category',
            'Edit Category',
            'Create Category',
            'Delete Category',
            'View Attribute',
            'Edit Attribute',
            'Create Attribute',
            'Delete Attribute',
            'View Orders'


        ];

        $role = Role::find(1);
        foreach($permissions as $key => $permission){
            Permission::create([
                'name' => $permission,
                'guard_name' => 'sanctum'
            ]);

            //give permission to super admin
            $role->givePermissionTo($permission);
        }
    }

}
