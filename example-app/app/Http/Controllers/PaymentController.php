<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        // Xử lý thanh toán ở đây, ví dụ lưu vào cơ sở dữ liệu hoặc kết nối với cổng thanh toán bên thứ ba
        
        // Sau khi xử lý, bạn có thể chuyển hướng người dùng đến trang thành công hoặc trang thất bại
        return redirect()->route('payment.success')->with('success_message', 'Payment successful!');
    }

    public function paymentSuccess()
    {
        return view('payment_success');
    }
}
