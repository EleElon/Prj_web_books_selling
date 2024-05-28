@extends('navs.nav')

@section('content')

<head>
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <style>
        .container {
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 100px;
            height: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-thanh-toan {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn-thanh-toan:hover {
            background-color: #45a049;
        }
    </style>
</head>

<main>
    <div class="container">
        <h1>Trang thanh toán</h1>
        <form action="{{ route('processCheckout') }}" method="POST">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Số tiền</th>
                        <th>Hình ảnh</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($cart) && count($cart) > 0)
                        @foreach ($cart as $item)
                            <tr>
                                <td>{{ $item['product_name'] }}</td>
                                <td>{{ $item['price'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ $item['price'] * $item['quantity'] }}</td>
                                <td>
                                    <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['image'] }}">
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">Giỏ hàng trống</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    @php
                        $totalPayment = 0;
                        foreach ($cart as $item) {
                            $totalPayment += $item['price'] * $item['quantity'];
                        }
                    @endphp
                    <tr>
                        <td colspan="4">Tổng thanh toán ({{ count($cart) }} sản phẩm):</td>
                        <td>${{ $totalPayment }}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="form-group">
                <label for="address">Địa chỉ giao hàng:</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="payment_method">Phương thức thanh toán:</label>
                <select id="payment_method" name="payment_method" class="form-control" required>
                    <option value="cod">Thanh toán khi nhận hàng</option>
                    <option value="card">Thanh toán bằng thẻ</option>
                </select>
            </div>
            <button class="btn-thanh-toan" type="submit">Thanh toán</button>
        </form>
    </div>
</main>
@endsection