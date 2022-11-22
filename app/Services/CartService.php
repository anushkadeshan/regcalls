<?php

namespace App\Services;

use App\Models\Apps\Ecommerce\Product;
use App\Models\Cart;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CartService {
    public static function getCartItemsCount() {
        $request = \request();
        $user = $request->user();

        if($user){
            return Cart::where('user_id',$user->id)->sum('quantity');
        }
        else{
            $cartItems = self::getCookieCartItems();
            return array_reduce(
                $cartItems,
                fn($carry, $item) => $carry + $item['quantity'],
                0
            );
        }
    }

    public static function getCartItems(){
        $request = \request();
        $user = $request->user();

        if($user){
            return Cart::where('user_id',$user->id)->get()->map(
                fn($item) => ['product_id' => $item->product_id,'quantity'=>$item->quantity]
            );
        }
        else{
            return self::getCookieCartItems();
        }
    }

    public static function getCookieCartItems(){
        $request = \request();
        return json_decode($request->cookie('cart_items','[]'),true);
    }

    public static function getCountFromItems($cartItems){
        return array_reduce(
            $cartItems,
            fn($carry, $item) => $carry + $item['quantity'],
            0
        );
    }

    public static function getCartProducts(){
        $cartItems = self::getCartItems();
        $cartProducts = [];
        foreach($cartItems as $key => $item){
            $product = Product::find($item['product_id']);
            $cartProducts[] = [
                'title' => $product->short_title,
                'price' => $product->price,
                'main_image' => $product->main_image,
                'max_quantity' => $product->quantity,
                'quantity' => $item['quantity'],
                'product_id' => $item['product_id'],
            ];

        }
        return $cartProducts;
    }

    public static function getSubTotal(){
        $cartItems = self::getCartItems();
        $ids = Arr::pluck($cartItems,'product_id');
        $products = Product::query()->whereIn('id',$ids)->get();
        $cartItems = Arr::keyBy($cartItems,'product_id');
        $total = 0;
        foreach($products as $product){
            $total += $product->price * $cartItems[$product->id]['quantity'];
        }
        return $total;
    }

    public static function moveCartItemsInToDb() {
        $request = \request();
        $cartItems = self::getCookieCartItems();
        if($cartItems){
            $dbCartItems = Cart::where('user_id',$request->user()->id)->get()->keyBy('product_id');
            $newCartItems = [];

            foreach($cartItems as $cartItem){
                if(isset($dbCartItems[$cartItem['product_id']])){
                    continue;
                }
                $newCartItems[] = [
                    'user_id' => $request->user()->id,
                    'product_id' => $cartItem['product_id'],
                    'quantity' => $cartItem['quantity']
                ];
            }

            if(!empty($newCartItems)){
                Cart::create($newCartItems);
            }
        }
    }


}
