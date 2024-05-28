@extends('dashboard')

@section('content')
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center" style="padding-bottom: 50px">
                <div class="col-md-8">
                    <div class="card">
                        <h3 class="card-header text-center">Thêm sản phẩm</h3>
                        <div class="card-body">

                            <form action="{{ route('user.postProduct') }}" method="POST" enctype="multipart/form-data"
                                class="row">
                                <div class="col-md-7">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="masach">mã sách</label><br><br>
                                        <input type="text" placeholder="mã sách" id="masach" class="form-control"
                                            name="masach" required autofocus>

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Tên Sách</label><br><br>
                                        <input type="text" placeholder="Tên Sách" id="name" class="form-control"
                                            name="name" required autofocus>

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="idLoai">Thể loại</label><br><br>
                                        <select type="text" placeholder="Thể loại" id="idLoai" class="form-control"
                                            name="idLoai" required autofocus>
                                            <?php $loaisp = \App\Models\theLoai::all(); ?>
                                            <option></option>
                                            @foreach ($loaisp as $loai)
                                           
                                                <option value="{{ $loai->name }}"> {{ $loai->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="author">Tác giả</label><br><br>
                                        <input type="text" placeholder="Tác Giả" id="author" class="form-control"
                                            name="author" required autofocus>

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="publish">Xuất bản</label><br><br>
                                        <input type="text" placeholder="Xuất bản" id="publish" class="form-control"
                                            name="publish" required autofocus>

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="Gia">Giá</label><br><br>
                                        <input type="text" placeholder="Giá" id="Gia" class="form-control"
                                            name="Gia" required>

                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label for="mota">Mô tả</label><br><br>
                                        {{-- <input rows="5" type="text" placeholder="Mô tả" id="mô tả"
                                            class="form-control" name="mô tả" required> --}}
                                        <textarea name="mota" rows="5" class="form-control"></textarea>

                                    </div>
                                    <div class="form-group mb-3" style="padding-left: 20px">
                                        <label for="image">Chọn ảnh</label><br><br>
                                        <input type="file" id="image" class="form-control" name="image">

                                    </div>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Thêm</button>
                                </div>
                            </form>
                            

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
