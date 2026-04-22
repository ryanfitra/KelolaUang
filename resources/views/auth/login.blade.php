<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Aplikasi Keuangan - Sign in</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('template/css/vendors_css.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">

  <!-- ICON -->
  <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>

  <style>
    body.login-page {
        background: url("{{ asset('images/auth-bg/bg-10.jpg') }}") no-repeat center;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-wrapper {
        display: flex;
        width: 900px;
        max-width: 100%;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .login-left {
        flex: 1;
        background: linear-gradient(135deg, #001d4a, #2069b1);
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px;
    }

    .login-left h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .login-right {
        flex: 1;
        padding: 40px;
        position: relative;
    }

    .login-logo {
        position: absolute;
        top: 15px;
        right: 20px;
    }

    .login-logo img {
        width: 60px;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .form-control {
        border-radius: 8px;
    }

    .btn-info {
        width: 100%;
        border-radius: 8px;
        font-weight: 600;
    }

    /* MOBILE */
    @media (max-width: 768px) {
        .login-wrapper {
            flex-direction: column;
            border-radius: 12px;
        }

        .login-left {
            display: none;
        }

        .login-right {
            padding: 25px;
        }
    }
  </style>
</head>

<body class="login-page">

<div class="login-wrapper">

    {{-- LEFT --}}
    <div class="login-left">
        <h1>WELCOME 👋</h1>
        <h3>Aplikasi Keuangan</h3>
        <p>Kelola keuangan Anda dengan mudah</p>
    </div>

    {{-- RIGHT --}}
    <div class="login-right">

        <div class="login-logo">
            <img src="{{ asset('images/logo/logo-diary-design.png') }}">
        </div>

        <h3 class="mb-4">Sign In</h3>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- EMAIL --}}
            <div class="input-group">
                <span class="input-group-text"><i data-feather="mail"></i></span>
                <input type="email" name="email" class="form-control"
                       placeholder="Email"
                       value="{{ old('email') }}" required autofocus>
            </div>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            {{-- PASSWORD --}}
            <div class="input-group">
                <span class="input-group-text"><i data-feather="lock"></i></span>
                <input type="password" name="password" class="form-control"
                       placeholder="Password" required>
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <button type="submit" class="btn btn-info mt-3">
                SIGN IN
            </button>

        </form>
    </div>

</div>

<script>
    feather.replace();
</script>

</body>
</html>