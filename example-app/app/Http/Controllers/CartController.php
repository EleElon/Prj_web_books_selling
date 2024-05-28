<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart()
    {
        // Lấy thông tin giỏ hàng và hiển thị trang giỏ hàng
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function checkout()
    {
        // Lấy thông tin giỏ hàng và chuyển hướng đến trang thanh toán
        $cart = session()->get('cart', []);
        return view('checkout.pay', compact('cart'));
    }

    // Các phương thức khác trong CartController
}

