<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        return inertia('Settings/Index');
    }

    public function changeTheme(Request $request){
        try{
            Theme::updateOrCreate(['user_id'=>auth()->user()->id],[
                'bg_color' => $request->theme['bg'],
                'text_color' => $request->theme['text'],
                'menu_color' => $request->theme['menu'],
                'menu_active_color' => $request->theme['menu_active'],
                'menu_hover_color' => $request->theme['menu_hover'],
                'user_id' =>auth()->user()->id
            ]);

            return redirect()->back()->with([
                'message' => 'Theme Changed Successfully',
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
}
