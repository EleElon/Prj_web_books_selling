@extends('navs.nav')

@section('content')

    <head>
        <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
        <style>

        </style>
    </head>

    <main>

        <body>
            <div class="container">
                <h1>Yêu thích</h1>

                <table>

                    <tbody id="cartBody">
                        @if (isset($cart) && count($cart) > 0)
                            @foreach ($cart as $item)
                                <tr>
                                    <td><img src="{{ asset('images/' . $item['image']) }}" alt="" style="width:50px ;">
                                    </td>
                                    <td>
                                        <a href="{{ route('Detail', ['id' => $item['product_id']]) }}">
                                            {{ $item['product_name'] }}
                                        </a>
                                    </td>
                                    <td>{{ $item['price'] }}</td>
                                    <td><a href="">Chat</a></td>
                                    <td id="deleteForm">
                                        <a onclick="confirmDelete()"
                                            href="{{ route('deleteFavorite', ['id' => $item['product_id']]) }}">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>không có sách thích</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </body>
    </main>
    <script>
        function confirmDelete() {
            if (confirm("bạn có muốn bỏ thích sản phẩm không?")) {
                // Nếu người dùng chấp nhận xóa, gửi yêu cầu xóa sản phẩm
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
@endsection
