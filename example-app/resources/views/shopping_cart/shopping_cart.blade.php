@extends('navs.nav')

@section('content')

<head>
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
</head>
<main>

    <body>
        <div class="container">
            <h1>Giỏ hàng</h1>
            <form action="{{ route('checkout.pay') }}" id="checkoutForm" method="POST">
                @csrf
                <table>
                    <thead>
                        <tr>
                            
                        <th><input type="checkbox" id="selectAllCheckbox"> Chọn tất cả</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Số tiền</th>
                            <th>Hình ảnh</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cartBody">
                        @if (isset($cart) && count($cart) > 0)
                            @foreach ($cart as $productId => $item)
                                            <tr>
                                                <td><input type="checkbox" name="selectedProducts[{{ $item['product_id'] }}]" value="1"></td>
                                                <td>
                                                    {{ $item['product_name'] }}
                                                    <input type="hidden" name="products[{{ $item['product_id'] }}][product_name]" value="{{ $item['product_name'] }}">
                                                </td>
                                                <td>
                                                    {{ $item['price'] }}
                                                    <input type="hidden" name="products[{{ $item['product_id'] }}][price]" value="{{ $item['price'] }}">
                                                </td>
                                                <td>
                                                    {{ $item['quantity'] }}
                                                    <input type="hidden" name="products[{{ $item['product_id'] }}][quantity]" value="{{ $item['quantity'] }}">
                                                </td>
                                                <td>{{ $item['price'] * $item['quantity'] }}</td>
                                                <td>
                                                    <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['image'] }}" style="width: 150px; height: 150px; margin-right: 20px;">
                                                    <input type="hidden" name="products[{{ $item['product_id'] }}][image]" value="{{ $item['image'] }}">
                                                </td>
                                                <td>
                                                    <a onclick="confirmDelete()" href="{{ route('deleteCart', ['id' => $item['product_id']]) }}" class="btn btn-sm btn-danger" method="GET">Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                        @else
                            <tr>
                                <td colspan="6">Giỏ hàng trống</td>
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
                            <td colspan="5">Tổng thanh toán ({{ count($cart) }} sản phẩm):</td>
                            <td>${{ $totalPayment }}</td>
                        </tr>
                    </tfoot>
                </table>
                <button class="btn-mua" type="button" onclick="confirmCheckout()">Mua hàng</button>
            </form>
        </div>
    </body>
</main>
<script>
    function confirmDelete() {
        if (confirm("Bạn có muốn xóa sản phẩm không?")) {
            document.getElementById("deleteForm").submit();
        }
    }

    function confirmCheckout() {
        var selectedProducts = document.querySelectorAll('input[name^="selectedProducts"]:checked');
        if (selectedProducts.length > 0) {
            document.getElementById("checkoutForm").submit();
        } else {
            alert("Vui lòng chọn ít nhất một sản phẩm để thanh toán.");
        }
    }
    document.getElementById('selectAllCheckbox').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[name^="selectedProducts"]');
        
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('selectAllCheckbox').checked;
        });
    });
</script>
@endsection