<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping-cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- header -->
    <header>
        <div class="nav-top flex-container-header">
            <div class="img-nav">
                <img class="icon-img" src="{{ asset('icon/clipart2204641.png') }}" alt="#" />
            </div>
            <div class="content-navs">
                <form action="#">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." />
                    <button class="btn-search" type="submit"><i class="fa fa-search" aria-hidden="true"
                            style="color: white"> Tìm kiếm</i></button>
                </form>
            </div>
            <!-- <a id="carts" href="{{ route('order.status') }}">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                Tình Trạng Đặt Hàng
            </a> -->
            <div class="btn-go">

                <a id="carts" href="{{ route('cart') }}">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    Giỏ Hàng
                </a>
                <a id="carts" href="{{ route('cartfovorite') }}">
                    <i class="fa fa fa-heart" aria-hidden="true"></i>
                    Yêu thích
                </a>

                <a id="carts" href="#">

                    @guest
                        <i class="fa fa-user" aria-hidden="true"></i>
                        tài khoản
                    @else
                        <i class="fa fa-user" aria-hidden="true"></i>
                        tài khoản

                    @endguest
                </a>

                {{-- <a id="carts" href="{{ route('user.list') }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    tài khoản

                    </> --}}


                </a>

            </div>





        </div>

        {{-- <div class="img-nav">
            <img class="icon-img" src="{{ asset('icon/clipart2204641.png') }}" alt="#" />
        </div> --}}
        <div class="content-nav">

            <ul>
                <li><a href="{{ route('listHome') }}">Trang Chủ</a></li><s></s>
                <div class="dropdown">
                    <li><a href="#">thể loại</a></li>
                    <div class="dropdown-content">
                        <?php $loaisp = \App\Models\theLoai::all(); ?>
                        @foreach ($loaisp as $loai)
                            <a value="{{ $loai->name }}" href="#"> {{ $loai->name }}</a>
                            {{-- <option value="{{ $loai->name }}"> {{ $loai->name }}</option> --}}
                        @endforeach
                    </div>
                </div>
                <li><a href="#">Liên Hệ</a></li>
                <li><a href="#">Giới thiệu</a></li>


            </ul>
            {{-- <form>
                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." />
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form> --}}


            <!-- The Modal -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('signout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                </li>
            @endguest




        </div>

    </header>

    @yield('content')

</body>
<footer>
    <p>Copyright © Books World</p>
</footer>

</html>