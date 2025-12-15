<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Lacak Pengaduan - SINTARA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

  <link href="{{asset('frontend/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Roboto:300,400,500,700|Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">

  <style>
    .search-section {
      padding: 80px 0;
      background: linear-gradient(135deg, rgba(240, 248, 255, 0.8), rgba(255, 255, 255, 0.8)),
                  url("{{ asset('assets/images/hero-bg.jpg') }}") center/cover no-repeat;
      backdrop-filter: blur(4px);
    }
    .card-frosted { background: rgba(255,255,255,0.65); backdrop-filter: blur(8px); border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,.08); transition: .3s }
    .card-frosted:hover { transform: translateY(-6px); box-shadow: 0 15px 35px rgba(0,0,0,.12) }
    .search-section h3 { font-weight: 700; letter-spacing: .5px }
    .form-control { border-radius: 5px; padding: 12px 16px; border: 1.5px solid #cfd8dc; transition: .3s }
    .form-control:focus { border-color: #004aad; box-shadow: 0 0 5px rgba(0,74,173,.4) }
    .btn-primary { background-color: #3382f1ff; border: none; border-radius: 10px; padding: 12px 25px; font-weight: 600; transition: .3s }
    .btn-primary:hover { background-color: #003580; transform: scale(1.05) }
    [data-aos] { transition: all .8s ease-in-out!important }
    .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold }
    .status-unprocess { background-color: #ffc107; color: #000 }
    .status-process { background-color: #17a2b8; color: #fff }
    .status-finished { background-color: #28a745; color: #fff }
    footer { background-color: #002d6f; color: #fff; padding: 20px 0; text-align: center }
  </style>
</head>

<body>
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
      </div>
      <div class="social-links">
      </div>
    </div>
  </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></a>
      </div>
    </div>
  </div>

  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <a href="{{ url('/') }}" class="logo mr-auto">
        <img src="{{ asset('assets/images/logo-sintara-light.png') }}" alt="Logo Sintara" style="max-height:68px; width:auto;">
      </a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="{{url('/')}}">Beranda</a></li>
          <li><a href="{{url('/')}}#procedures">Prosedur</a></li>
          <li><a href="{{url('/')}}#layanan">Layanan</a></li>
          <li class="active"><a href="{{url('track-complaint')}}">Lacak Pengaduan</a></li>
          @if(Session::get('nik') == NULL)
          <li><a href="{{url('user/login')}}">Masuk</a></li>
          <li><a href="{{url('user/register')}}">Daftar</a></li>
          @endif
        </ul>
      </nav>
    </div>
  </header>

  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1><span>Lacak Status Pengaduan Anda</span></h1>
      <h2>Masukkan NIK Anda untuk memantau proses penanganan laporan.</h2>
    </div>
  </section>

  <section id="search" class="search-section">
    <div class="container" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card card-frosted border-0">
            <div class="card-body p-5">
              <h3 class="text-center mb-4 fw-bold">Cari Pengaduan</h3>

              {{-- form cari pengaduan --}}
              <form action="{{ route('search_complaint') }}" method="POST" id="trackForm" novalidate>
                @csrf
                <div class="form-group mb-4">
                  <label for="nik" class="fw-semibold">Nomor Induk Kependudukan (NIK)</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nik"
                    name="nik"
                    placeholder="Masukkan NIK Anda"
                    inputmode="numeric"
                    pattern="\d{16}"
                    maxlength="16"
                    autocomplete="off"
                    autocapitalize="off"
                    required
                  >
                  @if($errors->has('nik'))
                    <small class="text-danger">{{ $errors->first('nik') }}</small>
                  @else
                    <small class="text-muted">NIK harus tepat 16 digit angka.</small>
                  @endif
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-lg">Cari Pengaduan</button>
                </div>
              </form>

              <div class="mt-4">
                <div class="alert alert-info shadow-sm">
                  <i class="icofont-info-circle"></i>
                  <strong>Informasi:</strong> Masukkan NIK yang Anda gunakan saat membuat pengaduan untuk melihat statusnya.
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer id="footer" style="background-color:#002d6f; color:#fff;">
    <div class="container py-4 text-center">

      <div class="mb-2" style="font-size:16px;">
        <i class="icofont-envelope"></i> franians73@gmail.com &nbsp;&nbsp;
        <i class="icofont-phone"></i> +62 877-4658-4604
      </div>

      <div class="social-links mt-2" style="font-size:22px;">
        <a href="#" class="mx-2"><i class="icofont-twitter"></i></a>
        <a href="#" class="mx-2"><i class="icofont-facebook"></i></a>
        <a href="#" class="mx-2"><i class="icofont-instagram"></i></a>
        <a href="#" class="mx-2"><i class="icofont-skype"></i></a>
        <a href="#" class="mx-2"><i class="icofont-linkedin"></i></a>
      </div>

    </div>
  </footer>

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <script src="{{asset('frontend/assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('frontend/assets/js/main.js')}}"></script>

  <script>
    const nikInput = document.getElementById('nik');
    nikInput.addEventListener('input', () => {
      nikInput.value = nikInput.value.replace(/\D/g, '').slice(0, 16);
    });

    document.getElementById('trackForm').addEventListener('submit', function (e) {
      nikInput.value = (nikInput.value || '').trim();
      if (!/^\d{16}$/.test(nikInput.value)) {
        e.preventDefault();
        nikInput.focus();
        alert('NIK harus 16 digit angka.');
      }
    });
  </script>
</body>
</html>
