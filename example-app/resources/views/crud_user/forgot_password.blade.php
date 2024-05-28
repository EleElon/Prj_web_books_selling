@extends('dashboard')

@section('content')
    <main class="forgot_password-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Quên mật khẩu</h3>
                        <div class="card-body">
                            <form method="POST" action="{{ route('forgot.password') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="email" placeholder="Nhập email của bạn" id="email" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Gửi yêu cầu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
