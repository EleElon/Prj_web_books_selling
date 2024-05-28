@extends('navs.nav')

@section('content')

<head>
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
</head>
<main>

    <body>
        <div class="container">
            <h2>Đơn hàng gần nhất của bạn:</h2>
            <!-- <form action="{{ route('checkout.pay') }}" id="checkoutForm" method="POST"> -->
            @csrf
            <table>
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Phương Thức Thanh Toán</th>
                        <th>Địa Chỉ Giao Hàng</th>
                        <th>Tình Trạng Đặt Hàng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="cartBody">
                    @if (isset($latestPayment))
                        @foreach ($latestPayment->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $latestPayment->payment_method }}</td>
                                <td>{{ $latestPayment->address }}</td>
                                <td>Đang giao hàng</td>
                                <td>
                                    <!-- Đây có thể là nút xóa sản phẩm nếu bạn muốn -->
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">Không có đơn hàng nào để hiển thị.</td>
                        </tr>
                    @endif
                </tbody>
        </div>
    </body>
</main>
@endsection