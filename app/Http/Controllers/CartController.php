<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Inertia\Inertia;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\Apps\Ecommerce\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = CartService::getCartProducts();
        $total = CartService::getSubTotal();
        return Inertia::render('Client/Cart/CartPage', [
            'products' => $products,
            'total' => $total
        ]);
    }

    public function add(Request $request){
        $product = Product::find($request->product_id);

        $quantity = $request->input('quantity',1);
        $user = $request->user();
        if($user){
            $cartItem = Cart::where('user_id',$user->id)->where('product_id',$product->id)->first();
            if($cartItem){
                $cartItem->quantity += $quantity;
                $cartItem->save();
            }
            else{
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity
                ]);
            }

            $wishlist = Wishlist::where('user_id',auth()->user()->id)->where('product_id',$request->product_id)->exists();
            if($wishlist){
                $wishlist = Wishlist::where('user_id',auth()->user()->id)->where('product_id',$request->product_id)->delete();
            }
        }
        else{
            $cartItems = json_decode($request->cookie('cart_items','[]'),true);
            $productFound = false;
            foreach($cartItems as &$item){
                if($item['product_id']===$product->id){
                    $item['quantity'] += $quantity;
                    $productFound = true;
                    break;
                }
            }
            if(!$productFound){
                $cartItems[] = [
                    'user_id' => null,
                    'product_id' => $product->id,
                    'quantity' => $quantity
                ];
            }
            Cookie::queue('cart_items', json_encode($cartItems),60*24*30);
        }
        return redirect()->back()->with([
            'message' => 'Item added to cart',
            'type' => 'success'
        ]);
    }

    public function remove(Request $request){

        $product = Product::find($request->product_id);
        $user = $request->user();
        if($user){
            $cartItem = Cart::where('user_id',$user->id)->where('product_id',$product->id)->first();
            if($cartItem){
                $cartItem->delete();
            }
        }
        else{
            $cartItems = json_decode($request->cookie('cart_items','[]'),true);
            foreach($cartItems as $i => &$item){
                if($item['product_id']===$product->id){
                    array_splice($cartItems, $i,1);
                    break;
                }
            }
            Cookie::queue('cart_items', json_encode($cartItems),60*24*30);
        }

        return redirect()->back()->with([
            'message' => 'Item Deleted from cart',
            'type' => 'success'
        ]);
    }

    public function updateQuantity(Request $request){
        $product = Product::find($request->product_id);
        $quantity = (int)$request->input('quantity');
        $user = $request->user();
        if($user){
            Cart::where('user_id',$user->id)->where('product_id',$product->id)->update(['quantity'=> $quantity]);
        }
        else{
            $cartItems = json_decode($request->cookie('cart_items','[]'),true);
            foreach($cartItems as &$item){
                if($item['product_id']===$product->id){
                    $item['quantity'] = $quantity;
                    break;
                }
            }
            Cookie::queue('cart_items', json_encode($cartItems),60*24*30);
        }

        return redirect()->back()->with([
            'message' => 'Quantity updated',
            'type' => 'success'
        ]);
    }
}
