<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Login Admin | SINTARA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" />

  <style>
    body {
      background: linear-gradient(135deg, #e8f1fb, #d0e2fa, #bcd4f7);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
      margin: 0;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      width: min(560px, 92vw);
      transition: all 0.4s ease;
    }

    .login-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }

    .login-header {
      background: linear-gradient(135deg, #5a8dee, #3b76d8);
      color: #fff;
      padding: 25px 30px;
      text-align: center;
    }

    .login-header h4 {
      margin-bottom: 6px;
      font-weight: 700;
      color: #fff;
      letter-spacing: 0.4px;
    }

    .login-header p {
      font-size: 14px;
      color: #e8f1fb;
      opacity: 0.95;
    }

    .logo-sintara {
      width: 100px;
      margin-bottom: 10px;
      filter: drop-shadow(0 2px 4px rgba(255, 255, 255, 0.3));
    }

    .login-body {
      padding: 35px 45px;
    }

    label {
      font-weight: 600;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px 15px;
      border: 1.5px solid #d0d7e2;
      background: #f5f7ff;
      transition: 0.3s;
    }

    .form-control:focus {
      border-color: #5a8dee;
      box-shadow: 0 0 6px rgba(90, 141, 238, 0.3);
    }

    .btn-primary {
      background-color: #5a8dee;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 700;
      transition: 0.3s;
      box-shadow: 0 6px 14px rgba(79, 124, 241, .25);
    }

    .btn-primary:hover {
      background-color: #4779d0;
      transform: scale(1.02);
    }

    .login-footer {
      text-align: center;
      margin-top: 25px;
      font-size: 14px;
      color: #555;
    }

    .login-footer a {
      color: #3b76d8;
      font-weight: 600;
      text-decoration: none;
    }

    .login-footer a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .login-body {
        padding: 30px 25px;
      }
    }
  </style>
</head>

<body>
  <div class="login-card">
    <div class="login-header">
      <img src="{{asset('assets/images/logo-sintara-white.png')}}" alt="Logo Sintara" class="logo-sintara">
      <h4>Masuk ke SINTARA</h4>
      <p>Layanan Pengaduan Masyarakat RT 12</p>
    </div>

    <div class="login-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if ($message = Session::get('error'))
        <div class="alert alert-danger">{{ $message }}</div>
      @endif

      @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
      @endif

      <form action="{{ url('admin/login') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="username"
                 placeholder="Masukkan Username" value="{{ old('username') }}" autocomplete="username" required autofocus>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <input type="password" class="form-control" name="password" id="password"
                   placeholder="Masukkan Password" autocomplete="current-password" required>
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()" aria-label="Tampilkan password">
              <i class="mdi mdi-eye-outline"></i>
            </button>
          </div>
        </div>
        <div class="mb-3 form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember"
                 {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label" for="remember">Ingat Saya</label>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
      </form>

      <div class="login-footer">
        <p>© <script>document.write(new Date().getFullYear())</script> <strong>SINTARA</strong></p>
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const password = document.getElementById("password");
      const icon = event.currentTarget.querySelector("i");
      password.type = password.type === "password" ? "text" : "password";
      icon.classList.toggle("mdi-eye-off-outline");
    }
  </script>

  <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
  <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
  <script src="{{asset('assets/js/app.js')}}"></script>
</body>
</html>
