<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Services\CartService;
use App\Services\DatabaseService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogAuthenticated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->moveCartToDb($event->user);
    }

    protected function moveCartToDb($user){
        $group_id = session('group_id') !='' ? session('group_id') : 1;
        $database_name = 'regcalls_g'.str_pad($group_id, 4, '0', STR_PAD_LEFT);
        DatabaseService::CreateDatabaseConnection($database_name);
        $cartItems = CartService::getCookieCartItems();
        if($cartItems){
            $dbCartItems = Cart::where('user_id',$user->id)->get()->keyBy('product_id');

            $newCartItems = [];

            foreach($cartItems as $cartItem){
                if(isset($dbCartItems[$cartItem['product_id']])){
                    continue;
                }
                $newCartItems[] = [
                    'user_id' => $user->id,
                    'product_id' => $cartItem['product_id'],
                    'quantity' => $cartItem['quantity']
                ];
            }
            if(!empty($newCartItems)){
                foreach($newCartItems as $key => $item){
                    Cart::create($item);
                }
            }
        }
    }
}
