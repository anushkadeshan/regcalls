<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\DatabaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CustomLoginRequest;
use App\Http\Requests\CustomRegisterRequest;

class CustomAuthController extends Controller
{
    //

    public function login(CustomLoginRequest $request){
        try{
            $user = User::where('email', $request->email)->where('isActive',true)->first();
            if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                $request->session()->put('group_id', 1);
                $current_database = 'regcalls_g'.str_pad(session('group_id'), 4, '0', STR_PAD_LEFT);
                $request->session()->put('database', $current_database);
                $role = DB::table('model_has_roles')
                    ->where('model_id',$user->id)
                    ->where('group_id',1)
                    ->first();
                Auth::login($user);
                //move cart items to db if available
                //$this->moveCartToDb();
                session(['current_profile_id' => $role->role_id]);

                return Redirect::route('home.index')->with([
                    'message' => 'You have Successfully Logged in',
                    'type' => 'success'
                ]);

            }
            else{
                abort(403,"Your account has been deactivated by Admin");
            }

            return Redirect::route('custom.post.login')->with([
                'message' => 'Login details are not valid',
                'type' => 'error'
            ]);
        }
        catch(\Exception $exception){
            $errorInfo = $exception->getMessage();
            return redirect()->back()->with([
                'message' => $errorInfo,
                'type' => 'error'
            ]);
        }
    }


    public function register(CustomRegisterRequest $request){

        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            $user->groups()->syncWithoutDetaching(1);
            $user->attachRoleAndGroup();

            return Redirect::route('custom.post.login')->with([
                'message' => 'You have Successfully Registered. Please login in to continue',
                'type' => 'success'
            ]);
        }
        catch(\Exception $exception){
            $errorInfo = $exception->getMessage();
            return redirect()->back()->with([
                'message' => $errorInfo,
                'type' => 'error'
            ]);
        }
    }

    protected function moveCartToDb(){

        $group_id = session('group_id') !='' ? session('group_id') : 1;
        $database_name = 'regcalls_g'.str_pad($group_id, 4, '0', STR_PAD_LEFT);
        DatabaseService::CreateDatabaseConnection($database_name);
        CartService::moveCartItemsInToDb();

        return Redirect::route('home.index')->with([
            'message' => 'You have Successfully Logged in',
            'type' => 'success'
        ]);
    }
}
