<?php

namespace App\Models;

use App\Models\Admin\Group;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    public $guard_name = 'sanctum';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' =>'date:Y-m-d'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function attachRoleAndGroup($role='User', $group_id=1){
        if(is_string($role)){
            $role_id = Role::where('name',$role)->first()->id;
        }
        else{
            $role_id = $role;
        }
        $row = DB::table('model_has_roles')
                ->where('model_id',$this->id)
                ->where('role_id',$role_id)
                ->where('group_id',$group_id)
                ->exists();
        if($row){
            return false;
        }
        DB::table('model_has_roles')->insert([
            'model_type' => 'App\User',
            'model_id' => $this->id,
            'role_id' => $role_id,
            'group_id' => $group_id
        ]);

        return true;
    }

    public function detachRoleAndGroup($role='User', $group_id=1){
        if(is_string($role)){
            $role_id = Role::where('name',$role)->first()->id;
        }
        else{
            $role_id = $role;
        }
        DB::table('model_has_roles')->where([
            'model_id' => $this->id,
            'role_id' => $role_id,
            'group_id' => $group_id
        ])->delete();

        return true;
    }

    public function getCurrentRoleName(){

        $role = DB::table('model_has_roles')->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('model_id',$this->id)
        ->where('model_has_roles.group_id',(int)session('group_id'))
        ->where('role_id',(int)session('current_profile_id'))
        ->first();
        return $role->name;
    }


    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id');
    }

    public function profiles()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')->withPivot('group_id');
    }
}
