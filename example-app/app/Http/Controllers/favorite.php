<?php

namespace App\Http\Controllers;

use App\Models\Favorities;
use App\Models\product;
use App\Models\shoppingcart;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class favorite extends Controller
{
    public function addfavorite($id)
    {
        $products = Product::find($id);
        if (Cookie::get('cart')) {
            $cart = json_decode(Cookie::get('cart'), true);
        } else {
            $cart = [];
        }

        if (Auth::check()) {
            // Người dùng đã đăng nhập, thêm sản phẩm vào cơ sở dữ liệu
            $user = Auth::user();
            $cartItem = Favorities::where('user_id', $user->id)->where('product_id', $id)->first();

            if ($cartItem) {
                return redirect()->back();
            } else {
            // Sản phẩm chưa tồn tại trong giỏ hàng, tạo mới
            $cartItem = new Favorities();
            $cartItem->user_id = $user->id;
            $cartItem->product_id = $id;
            $cartItem->product_name = $products->product_name;
            $cartItem->price = $products->price;
            $cartItem->image = $products->image;

            }

            $cartItem->save();
        } else {
            // Thêm sản phẩm vào giỏ hàng
            // sử dụng cookie
            // if (isset($cart[$id])) {
            //     $cart[$id]['quantity'] += 1;
            // } else {
            //     $cart[$id] = [
            //         'product_id' => $products->id, // Thêm ID sản phẩm vào mảng
            //         'product_name' => $products->product_name,
            //         'price' => $products->price,
            //         'quantity' => 1,
            //         'image' => $products->image,
            //     ];
            // }

            return view('crud_user.login');
        }

        // Lưu giỏ hàng vào cookie
        $cookie = Cookie::make('cart', json_encode($cart), 60);

        // Trả về phản hồi thành công với cookie
        //return response(dd($cookie))->withCookie($cookie);

        return redirect()->back()->withCookie($cookie);
    }

    public function showFavorites(Request $request)
    {
        $cart = [];

        if (Auth::check()) {
            $cart = Favorities::where('user_id', $request->user()->id)->get()->toArray();

            // Chuyển đổi dữ liệu từ cơ sở dữ liệu để phù hợp với định dạng giống như cookie
            $cart = array_map(function ($item) {
                return [
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'image' => $item['image'],
                    'price' => $item['price'],
                ];
            }, $cart);
        } else {
            // Nếu người dùng chưa đăng nhập, lấy dữ liệu từ cookie
            if (Cookie::get('cart')) {
                //sử dụng cookie
                //$cart = json_decode(Cookie::get('cart'), true);
                return view('crud_user.login');
            }
        }

        // Hiển thị trang giỏ hàng với dữ liệu từ cookie hoặc cơ sở dữ liệu
        return view('product-favourite.productFavourite', ['cart' => $cart]);
    }


    public function deleteFavorite(Request $request, $id) {
        if (Auth::check()) {
            // Người dùng đã đăng nhập, xóa sản phẩm khỏi cơ sở dữ liệu
            $user = Auth::user();
            $cartItem = Favorities::where('user_id', $user->id)->where('product_id', $id)->first();

            

            if ($cartItem) {
                $cartItem->delete();
                return redirect()->back()->withSuccess('Bạn đã bỏ thích sản phẩm');
            } else {
                return redirect()->back()->with('error', 'Product not found in cart.');
            }
         } 
    }
}
