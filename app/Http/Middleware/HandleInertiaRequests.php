<?php

namespace App\Http\Middleware;

use App\Models\Theme;
use Inertia\Middleware;
use App\Models\Category;
use App\Models\Admin\Group;
use App\Models\Wishlist;
use App\Services\CartService;
use App\Services\DatabaseService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'admin';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

   /*  public function rootView(Request $request)
    {
        if ($request->route()->getPrefix() == '/admin' || $request->route()->getPrefix() == '/auth') {
            return 'admin';
        }
        return 'client';
    } */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'appName' => config('app.name'),
            'flash' =>  [
                'message' => session('message'),
                'type' => session('type')
            ],
            'group_id' => session('group_id') !='' ? session('group_id') : 1,
            'current_profile_id' => session('current_profile_id'),
            'groupName' => $this->getCurrentGroupName(),
            'profileName' => $this->getCurrentProfileName(),
            'assignedGroups' => $this->getAssignedGroups(),
            'assignedProfiles' => $this->getAssignedProfiles(),
            'currentPermissions' => $this->getCurrentPermissions(),
            'groupApps' => $this->getGroupApps(),
            'theme' => $this->getTheme(),
            'categoriesOnNavbar' =>$this->getCategoriesOnNavbar(),
            'cartItemsCount' => CartService::getCartItemsCount(),
            'cartProducts' => CartService::getCartProducts(),
            'cartSubTotal' => CartService::getSubTotal(),
            'wishlistItemCount' => self::wishlistCount()

        ]);
    }

    protected function getAssignedGroups(){
        if(session('group_id')!=''){
            $groups = auth()->user()->groups()->whereNot('groups.id',session('group_id'))->select('groups.id','groups.name')->get()->toArray();
            return $groups;
        }
        return [];

    }

    protected function getCurrentGroupName(){
        if(session('group_id')!=''){
            $groupName = Group::find(session('group_id'))->name;
        }
        else{
            $groupName = Group::find(1)->name;
        }
        return $groupName;

    }

    protected function getCurrentProfileName(){
        if(session('current_profile_id')!=''){
            $profileName = Role::find(session('current_profile_id'))->name;
            return $profileName;
        }

    }

    protected function getAssignedProfiles(){
        if(session('current_profile_id')!=''){
            $profiles = auth()->user()->profiles()->wherePivot('role_id','!=',session('current_profile_id'))->wherePivot('group_id',session('group_id'))->select('roles.id','roles.name')->get()->toArray();
           // dd($profiles);
            return $profiles;
        }
    }

    protected function getCurrentPermissions(){
        if(session('current_profile_id')!=''){
            $profile = Role::find(session('current_profile_id'));
            $permissions = $profile->permissions->pluck('name')->toArray();
            return $permissions;
        }
    }

    protected function getGroupApps(){
        if(session('group_id')!=''){
            $group = Group::find(session('group_id'));
            $apps = $group->apps()->where('active',true)->select('group_id','app_key','app_id','title_en')->get()->toArray();
            return $apps;
        }
    }

    protected function getTheme(){
        if(auth()->check()){
            $theme = Theme::where('user_id',auth()->user()->id)->select('bg_color','text_color','menu_color','menu_active_color','menu_hover_color')->first();
            if(empty($theme)){
                return Theme::create([
                    'bg_color' => 'bg-gray-50',
                    'text_color' => 'text-gray-900',
                    'menu_color' => 'bg-gray-200',
                    'menu_active_color' => 'rgb(75 85 99)',
                    'menu_hover_color' => 'hover:bg-gray-300',
                    'user_id' =>auth()->user()->id
                ]);
            }
            return $theme;
        }

    }

    protected function getCategoriesOnNavbar(){
        $group_id = session('group_id') !='' ? session('group_id') : 1;
        $database_name = 'regcalls_g'.str_pad($group_id, 4, '0', STR_PAD_LEFT);
        DatabaseService::CreateDatabaseConnection($database_name);
        $categories = Category::whereNull('parent_id')->get();
        return $categories;
    }

    public function wishlistCount(){
        if(auth()->check()){
            $count = Wishlist::where('user_id',auth()->user()->id)->count();
            return $count;
        }

    }

}
