@extends('dashboard')

@section('content')
<main class="login-form">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">Danh sách sản phẩm</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        
                                        <th>Ảnh</th>
                                        <th>Mã Sản Phẩm</th>
                                        <th>Tên</th>
                                        <th>Thể Loại</th>
                                        <th>Xuất bản</th>
                                        <th>Tác Giả</th>
                                        <th>Mô Tả</th>
                                        <th>Giá</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $products)
                                    <tr>
                                       
                                        <td>
                                            @if($products->image)
                                            <img src="{{ asset('images/' . $products->image) }}" alt="{{ $products->product_name }}" class="img-thumbnail" style="width: 70px; height: 70px;">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>{{ $products->product_id }}</td>
                                        <td>{{ $products->product_name }}</td>
                                        <td>{{ $products->category }}</td>
                                        <td>{{ $products->publish }}</td>
                                        <td>{{ $products->author }}</td>
                                        <td>{{ $products->description }}</td>
                                        <td>{{ $products->price }}</td>
                                        <td>
                                            <a href="{{ route('product.edit', ['id' => $products->product_id]) }}" class="btn btn-sm btn-warning">Sửa</a>
                                            <a href="{{ route('product.deleteProduct', ['id' => $products->product_id]) }}" class="btn btn-sm btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
