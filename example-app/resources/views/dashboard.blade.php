<!DOCTYPE html>
<html>

<head>
    <title>Laravel 10.48.0 - CRUD User Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
    <style>
        .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
#navbarNavs{
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-item{
    border: 1px solid rgba(0, 0, 0, 0);
    
}

    </style>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg " style="background-color: #0274c6;">
        <div class="container" style="padding-left: 40%">
            <a class="navbar-brand mr-auto" href="{{ route('listHome') }}" style="color: white">BOOK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.createUser') }}">Create user</a>
                        </li>
                    @else
                        <li class="nav-item" >
                            <a class="nav-link" href="{{ route('signout') }} " style="color: white">Logout</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNavs">
                <ul class="navbar-nav">
                    @guest 
                    @else
                        <li class="nav-item" >
                            <a class="nav-link" href="{{ route('user.list') }}" style="color: black">User list</a>
                        </li>
                        <div class="dropdown">
                            <li class="nav-item" >
                                <a class="nav-link" href="{{ route('product.list') }}" style="color: black">Products</a>
                            </li>
                            <div class="dropdown-content">
                                <a href="{{ route('product.add') }}">Thêm</a>
                            </div>
                        </div>
                    
                        <li class="nav-item" >
                            <a class="nav-link" href="" style="color: black">Thể loại</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</body>

</html>
