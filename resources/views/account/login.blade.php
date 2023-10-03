<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <title>Document</title>
</head>

<body class="">
    <div class="container-fluid bg-logo d-flex justify-content-between">
        <a href="/"><img
                src="https://nhadep.com.vn/Uploads/images/banner/thuong-hieu-thuoc-TCTGROUP/noi-that-nha-dep.png"
                alt=""></a>
        <div class="">
            <h1 class="pt-2 me-5 text-white">abc</h1>
        </div>
    </div>
    <div class="mt-4 ms-4 ">
        <a href="/" class="text-decoration-none"><< Trang chủ</a>
    </div>
    <div class="content ">
        <div class="w-50 mt-5 mx-auto text-center">
            <h1>LOGIN</h1>
            <form action="/login/auth" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="email">
                    <label for="floatingInput">Tài khoản</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="password">
                    <label for="floatingPassword">Mật khẩu</label>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <input class="btn btn-primary mt-5" type="submit" value="Đăng nhập">
                <p class="mt-3">bạn chưa có tài khoản? đăng ký</p>
                <a class="btn btn-success" href="/register">Đăng ký</a>
            </form>
        </div>
    </div>

</body>

</html>
