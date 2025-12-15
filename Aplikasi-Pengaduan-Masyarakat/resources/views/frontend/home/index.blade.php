<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Layanan Pengaduan Online</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

  <link href="{{asset('frontend/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">

  <style>
    .search-section {
      padding: 60px 0;
      background: #f8f9fa;
    }

    .status-badge {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: bold;
    }

    .status-unprocess {
      background-color: #ffc107;
      color: #000;
    }

    .status-process {
      background-color: #17a2b8;
      color: #fff;
    }

    .status-finished {
      background-color: #28a745;
      color: #fff;
    }

    .complaint-card {
      transition: transform 0.3s;
    }

    .complaint-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .user-info {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
      object-fit: cover;
    }

    .user-details {
      flex: 1;
    }

    .user-name {
      font-weight: bold;
      margin-bottom: 2px;
    }

    .user-nik {
      font-size: 12px;
      color: #6c757d;
    }
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


  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <a href="{{ url('/') }}" class="logo mr-auto">
        <img src="{{ asset('assets/images/logo-sintara-light.png') }}" alt="Logo Sintara" style="max-height:68px; width:auto;">
      </a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{url('/')}}">Beranda</a></li>
          <li><a href="#procedures">Prosedur</a></li>
          <li><a href="#layanan">Layanan</a></li>
          <li><a href="{{url('track-complaint')}}">Lacak Pengaduan</a></li>
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
      <h1><span>Layanan Pengaduan Infrastruktur RT Online</span></h1>
      <h2>Laporkan masalah Anda di sini, kami akan memprosesnya dengan cepat.</h2>
      @if(Session::get('nik') != NULL)
      <div class="d-flex">
        <a href="{{url('user/complaint/add')}}" class="btn-get-started scrollto">Lapor</a>
      </div>
      @endif
    </div>
  </section>

  <main id="main">
    <section id="procedures" class="featured-services">
      <div class="container" data-aos="fade-up">
        <div class="section-title text-center mb-4">
          <h2>Prosedur Pengaduan</h2>
          <p style="font-size: 14px; color: #555;">(Ikuti langkah berikut untuk melapor)</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">1. Tulis Laporan</a></h4>
              <p class="description">Tulis laporan pengaduan Anda dengan jelas.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">2. Proses Verifikasi</a></h4>
              <p class="description">Tunggu hingga laporan Anda diverifikasi oleh petugas terkait.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">3. Tindak Lanjut</a></h4>
              <p class="description">Laporan Anda sedang diproses dan ditindaklanjuti.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">4. Selesai</a></h4>
              <p class="description">Laporan pengaduan telah diselesaikan.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="layanan" class="about section-bg py-5" style="background:#f6f9ff;">
      <div class="container" data-aos="fade-up">
        <div class="row gy-4 align-items-center">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="{{ asset('assets/images/verification-img.png') }}" class="img-fluid rounded-4 shadow-lg" alt="Layanan Sintara" style="max-width:80%; border:3px solid #d8e7ff;">
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
            <h3 class="fw-bold" style="color:#004aad;">Tentang Layanan SINTARA</h3>
            <p style="text-align:justify;">
              Sintara merupakan sistem informasi pengaduan infrastruktur yang dirancang khusus untuk warga tingkat RT. 
              Melalui platform ini, warga dapat dengan mudah melaporkan berbagai permasalahan lingkungan seperti jalan rusak, 
              lampu penerangan padam, saluran air tersumbat, dan keluhan infrastruktur lainnya secara digital.
            </p>
            <p style="text-align:justify;">
              Laporan yang masuk akan diverifikasi oleh pengurus RT agar segera ditindaklanjuti. 
              Warga dapat memantau perkembangan laporan secara <em>real-time</em> melalui fitur “Lacak Pengaduan” tanpa login, 
              atau melalui menu “Status Pengaduan” jika sudah memiliki akun.
            </p>
            <ul style="list-style:none; padding-left:0;">
              <li><i class="bx bx-check-double" style="color:#004aad;"></i> Pengaduan langsung ditangani oleh pengurus RT</li>
              <li><i class="bx bx-check-double" style="color:#004aad;"></i> Cek status laporan kapan saja, dengan atau tanpa login</li>
              <li><i class="bx bx-check-double" style="color:#004aad;"></i> Meningratkan transparansi dan efisiensi penanganan masalah</li>
              <li><i class="bx bx-check-double" style="color:#004aad;"></i> Desain sederhana dan ramah pengguna</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER BARU SESUAI PERMINTAAN REN -->
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
</body>
</html>