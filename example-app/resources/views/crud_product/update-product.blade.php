@extends('dashboard')

@section('content')
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center" style="padding-bottom: 50px">
                <div class="col-md-8">
                    <div class="card">
                        <h3 class="card-header text-center">cập nhập</h3>
                        <div class="card-body">

                            <form action="{{ route('product.update', $product->product_id) }}" method="POST"
                                enctype="multipart/form-data" class="row">
                                <div class="col-md-7">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="masach">mã sách</label><br><br>
                                        {{-- <input disabled style="" value="{{ $product->product_id }}" type="text" placeholder="mã sách"
                                            id="masach" class="form-control" name="masach" required autofocus> --}}
                                        <input  value="{{ $product->product_id }}" type="text" placeholder="mã sách"
                                            id="masach" class="form-control" name="masach" required autofocus>

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Tên Sách</label><br><br>
                                        {{-- <input value="{{ $product->product_name }}" type="text" placeholder="Tên Sách"
                                            id="name" class="form-control" name="name" required autofocus> --}}
                                        <input value="{{ $product->product_name }}" type="text" placeholder="Tên Sách"
                                            id="name" class="form-control" name="name" required autofocus>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="idLoai">Thể loại</label><br><br>
                                        {{-- <select value="{{ $product->category }}" type="text" placeholder="Thể loại" --}}
                                        <select type="text" placeholder="Thể loại" id="idLoai" class="form-control"
                                            name="idLoai" required autofocus>
                                            id="idLoai" class="form-control" name="idLoai" required autofocus>
                                            <?php $loaisp = \App\Models\theLoai::all(); ?>
                                            <option>{{ $product->category }}</option>
                                            @foreach ($loaisp as $loai)
                                                <option value="{{ $loai->name }}"> {{ $loai->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="author">Tác giả</label><br><br>
                                        <input value="{{ $product->author }}" type="text" placeholder="Tên Sách"
                                            id="author" class="form-control" name="author" required autofocus>

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="publish">Xuất bản</label><br><br>
                                        <input value="{{ $product->publish }}" type="text" placeholder="Tên Sách"
                                            id="publish" class="form-control" name="publish" required autofocus>

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="Gia">Giá</label><br><br>
                                        <input value="{{ $product->price }}" type="text" placeholder="Giá" id="Gia"
                                            class="form-control" name="Gia" required>

                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label for="mota">Mô tả</label><br><br>
                                        {{-- <input rows="5" type="text" placeholder="Mô tả" id="mô tả"
                                            class="form-control" name="mô tả" required> --}}
                                        <textarea name="mota" rows="5" class="form-control">{{ $product->description }}</textarea>

                                    </div>
                                    <div class="form-group mb-3" style="padding-left: 20px">
                                        <label for="image">Chọn ảnh</label><br><br>
                                        <input value="{{ $product->image }}" type="file" id="image"
                                            class="form-control" name="image">

                                    </div>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">cập nhập</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
