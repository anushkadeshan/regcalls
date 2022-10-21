<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Admin\Group;
use App\Services\DatabaseService;

class GroupObserver
{
    /**
     * Handle the Group "created" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function created(Group $group)
    {
        //create new database for new group
        $database_name = DatabaseService::CreateNewDatabase($group);

        //copy all the tables of template database to new database
        DatabaseService::CopyTablesFromTemplateDatabase($database_name);

        $users = User::whereHas('profiles' , function($q) {
            $q->where('model_id',1);
        })->get();

        foreach($users as $user){
            //assing groups
            $user->groups()->syncWithoutDetaching($group->id);
            //assign user role to group
            $user->attachRoleAndGroup('Super Admin',$group->id);
        }
    }

    /**
     * Handle the Group "updated" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function updated(Group $group)
    {
        $users = User::whereHas('profiles' , function($q) {
            $q->where('model_id',1);
        })->get();
    }

    /**
     * Handle the Group "deleted" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function deleted(Group $group)
    {
        //
    }

    /**
     * Handle the Group "restored" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function restored(Group $group)
    {
        //
    }

    /**
     * Handle the Group "force deleted" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function forceDeleted(Group $group)
    {
        //
    }
}
