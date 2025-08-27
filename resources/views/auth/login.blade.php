<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>CBT Universitas Sriwijaya - Sign in </title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-unsri.png') }}">

  <!-- Vendors Style-->
  <link rel="stylesheet" href="{{ asset('template/css/vendors_css.css') }}">
    
  <!-- Custom Style -->  
  <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
</head>
  
<body class="login-page">
  
  <div class="login-wrapper">

      <!-- 🔹 FORM LOGIN -->
      
      <!-- 🔹 PANEL KIRI -->
      <div class="login-left">
          <h1>WELCOME !</h1>
          <h3>CBT Universitas Sriwijaya</h3>
          <p>Sign in to continue</p>
      </div>

      <div class="login-right">
        <div class="login-logo mb-30">
            <img src="{{ asset('images/logo/logo-unsri.png') }}" alt="Logo CBT Universitas Sriwijaya">
        </div>
        <h2>Sign in</h2>

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <!-- Email -->
          <div class="input-group">
              <span class="input-group-text">
                  <i data-feather="mail"></i>
              </span>
              <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
          </div>
          @error('email')
              <span class="text-danger">{{ $message }}</span>
          @enderror

          <!-- Password -->
          <div class="input-group">
              <span class="input-group-text">
                  <i data-feather="lock"></i>
              </span>
              <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>
          @error('password')
              <span class="text-danger">{{ $message }}</span>
          @enderror

          {{-- <div class="form-group mb-3 text-end">
              <a href="#" class="text-muted">Forgot your password?</a>
          </div> --}}

          <button type="submit" class="btn btn-custom">Sign In</button>

          {{-- <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p> --}}
        </form>
      </div>

  </div>

</body>
</html>
<script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
<script>
  feather.replace()
</script>