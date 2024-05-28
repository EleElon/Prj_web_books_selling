<?php

// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $selectedProducts = $request->input('selectedProducts', []);
        $cart = [];

        foreach ($selectedProducts as $productId => $selected) {
            // Nếu sản phẩm được chọn, thêm vào giỏ hàng
            if ($selected) {
                $productData = $request->input('products.' . $productId);
                $cart[$productId] = $productData;
            }
        }

        return view('checkout.pay', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $userId = Auth::id();

        // Lấy thông tin sản phẩm từ request
        $selectedProducts = $request->input('selectedProducts', []);
        $products = [];

        foreach ($selectedProducts as $productId => $selected) {
            // Nếu sản phẩm được chọn, thêm vào mảng $products
            if ($selected) {
                $productData = $request->input('products.' . $productId);
                $products[] = $productData;
            }
        }

        // Chuyển mảng $products thành chuỗi JSON
        $productsJson = json_encode($products);

        // Lấy thông tin địa chỉ và phương thức thanh toán từ request
        $address = $request->input('address');
        $paymentMethod = $request->input('payment_method');

        // Tạo một bản ghi mới trong bảng payments
        $payment = new Payment();
        $payment->user_id = $userId;
        $payment->products = $productsJson; // Lưu thông tin sản phẩm dưới dạng chuỗi JSON
        $payment->address = $address;
        $payment->payment_method = $paymentMethod;
        $payment->save();

        foreach ($selectedProducts as $productId => $selected) {
            if ($selected) {
                // Xóa sản phẩm được chọn khỏi giỏ hàng
                Cart::where('product_id', $productId)->delete();
            }
        }

        // session()->forget('cart');

        return redirect()->route('checkout.success');
    }



    public function orderStatus()
    {
        // Lấy thông tin về đơn hàng gần nhất của người dùng
        $latestPayment = Payment::where('user_id', auth()->id())->latest()->first();

        // Trả về view với thông tin đơn hàng
        return view('order.status', compact('latestPayment'));
    }

    public function success()
    {
        return view('checkout.success');
    }
}
