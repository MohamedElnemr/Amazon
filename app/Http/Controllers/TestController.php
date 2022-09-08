<?php

namespace App\Http\Controllers;



use App\Events\ProductOrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Modules\Vendor\Entities\Product;

use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    //

    public function test_Event_Listener()
    {

        $product = Product::find(1);

        event(new ProductOrderEvent($product));


        echo 'done';
    }



    public function test_Pusher_with_event()
    {

        $product = Product::find(1);
        $qty = 4;



                                        // pusher by php
        // $options = array(
        //     'cluster' => 'mt1',
        //     'useTLS' => true
        //   );

        // $string = 'An item has been removed from the QTY';

        // $pusher = new \Pusher\Pusher(
        //     '2e359f192f8193b528d3',
        //     'ff87a90be6f197d801f7',
        //     '1337644',
        //     $options
        //   );

        //   $pusher->trigger('driver-4', 'my-event', ['message' => $string]);

        event(new ProductOrderEvent($product));


        echo 'done';
    }

    public function add_cart(Request $request)
    {
        if (Redis::get('cart') == null) {
            Redis::set('cart', json_encode([
                ["product_id" => $request->product_id, "qty" => $request->qty],
            ]));
        } else {
            $carts = json_decode(Redis::get('cart'));
            // return $carts;
            $newcart = [];
            $found = false;
            foreach ($carts as $cart) {
                if ($request->product_id == $cart->product_id) {
                    $cart->qty += $request->qty;
                    $found = true;
                }
                $newcart[] = $cart;
            }
            if (!$found) {
                $newcart[] =["product_id" => $request->product_id, "qty" => $request->qty];
            }
            Redis::set('cart', json_encode($newcart));
        }
        return json_decode(Redis::get('cart'));
    }
}
