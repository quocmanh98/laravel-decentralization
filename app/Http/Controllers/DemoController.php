<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DemoController extends Controller
{
    function sendmail(){
        $data = [
            'key1' => 'value1'
        ];

        Mail::to('quocmanhs1998@gmail.com')->send(new DemoMail($data));
        // Địa chỉ email của người nhận
    }

    function addPost(){
        return view('demo.post.create');
    }

    public function addCart(Request $request,$id){
        // Cart::add($id, 'Product {$id}', 1, 9.99);
        $product = Product::find($id);
        // return $product->id;
        // return $product;
        // Cart::destroy();
        Cart::add(
            [
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => 1,
            'price' => $product->product_price_old,
            'options' => ['thumbnail' => $product->product_image]
            ]
            );
        return Cart::content();
    }

    public function showCart(){
        // return Cart::content();
        return view('demo.cart.show');
    }

    public function updateCart(Request $request){
        // dd($request->all());
        $data = $request->get('qty');
        foreach($data as $k => $v){
            Cart::update($k,$v);
        }
// {{route('cart.remove',$product->rowIid)}}
        return redirect('demo/cart/show');
    }

    public function logout(Request $request ){
        $request->session()->flush();
        return redirect('/');
        }

    public function dashboard(){
            $users = Auth::user();
            return $users->role;
            // return $users;
    }
}
