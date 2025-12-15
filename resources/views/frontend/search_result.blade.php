<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Hasil Pencarian - SINTARA</title>
  <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
  <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">

  <style>
    body{background:#f8f9fa;}
    #hero h1{color:#3382f1ff;font-size:48px;font-weight:700;line-height:56px;}
    .complaint-card{transition:.3s}
    .complaint-card:hover{transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,.1)}
    .user-info{display:flex;align-items:center;margin-bottom:15px}
    .user-avatar{width:40px;height:40px;border-radius:50%;margin-right:10px;object-fit:cover}
    .user-details{flex:1}
    .user-name{font-weight:700;margin-bottom:2px}
    .user-nik{font-size:12px;color:#6c757d}

    /* Warna badge sesuai admin */
    .status-badge{padding:5px 12px;border-radius:8px;font-size:12px;font-weight:600;color:#fff;}
    .bg-danger{background:#dc3545;}
    .bg-info{background:#0dcaf0;}
    .bg-warning{background:#ffc107;color:#000;}
    .bg-primary{background:#0d6efd;}
    .bg-secondary{background:#6c757d;}
    .bg-success{background:#198754;}
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
    <div class="container mt-5 pt-5">
      <h1>Hasil Pencarian Pengaduan</h1>
      <h2>Status pengaduan untuk NIK: {{ $search_nik }}</h2>
    </div>
  </section>

  <section id="results" class="py-5">
    <div class="container">
      <div class="card shadow">
        <div class="card-body p-5">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Daftar Pengaduan</h3>
            <a href="{{url('track-complaint')}}" class="btn btn-outline-primary">
              <i class="icofont-refresh"></i> Cari Lagi
            </a>
          </div>

          @if(count($complaints) > 0)
            <div class="alert alert-success">Ditemukan {{ count($complaints) }} pengaduan untuk NIK ini.</div>

            @foreach($complaints as $complaint)
              @php
                switch ($complaint->status) {
                  case '0':         $badge='bg-danger';   $label='Belum Diproses'; break;
                  case 'kelurahan': $badge='bg-info';     $label='Dilanjutkan ke Kelurahan'; break;
                  case 'perbaikan': $badge='bg-warning';  $label='Dalam Perbaikan'; break;
                  case 'process':   $badge='bg-primary';  $label='Proses'; break;
                  case 'rejected':  $badge='bg-secondary';$label='Ditolak'; break;
                  case 'finished':  $badge='bg-success';  $label='Selesai'; break;
                  default:          $badge='bg-light';    $label='-'; break;
                }
              @endphp

              <div class="card complaint-card mb-4">
                <div class="card-body">
                  <div class="user-info">
                    @if($complaint->society && $complaint->society->photo)
                      <img src="{{ asset('storage/avatar_society/' . $complaint->society->photo) }}" class="user-avatar" alt="Foto Profil">
                    @else
                      <div class="user-avatar bg-secondary text-white d-flex align-items-center justify-content-center">
                        <i class="icofont-user"></i>
                      </div>
                    @endif
                    <div class="user-details">
                      <div class="user-name">{{ $complaint->society->name ?? 'Pengadu' }}</div>
                      <div class="user-nik">NIK: {{ $complaint->nik }}</div>
                    </div>
                    <span class="status-badge {{ $badge }}">{{ $label }}</span>
                  </div>

                  <div class="row mt-3">
                    <div class="col-md-3">
                      <img src="{{ asset('storage/avatar_complaint/' . $complaint->photo) }}" class="img-fluid rounded" alt="Bukti Pengaduan">
                    </div>
                    <div class="col-md-9">
                      <p class="text-muted"><i class="icofont-calendar"></i>
                        Diajukan pada: {{ \Carbon\Carbon::parse($complaint->created_at)->translatedFormat('d F Y') }}
                      </p>
                      <p><strong>Isi Pengaduan:</strong> {{ $complaint->contents_of_the_report }}</p>

                      <div class="mt-3">
                        <strong>Tanggapan:</strong>
                        <p class="mt-1 alert {{ ($complaint->response && $complaint->response->response) ? 'alert-info' : 'alert-warning' }}">
                          @if($complaint->response && $complaint->response->response)
                            {{ $complaint->response->response }} <br>
                            <small class="text-muted">
                              Ditanggapi pada: {{ \Carbon\Carbon::parse($complaint->response->updated_at)->translatedFormat('d F Y H:i') }}
                            </small>
                          @else
                            <span class="text-muted">Belum ada tanggapan</span>
                          @endif
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="alert alert-warning text-center">
              <i class="icofont-info-circle" style="font-size:48px;"></i>
              <h4 class="mt-3">Tidak Ditemukan Pengaduan</h4>
              <p>Tidak ada pengaduan yang ditemukan untuk NIK: <strong>{{ $search_nik }}</strong></p>
              <a href="{{url('track-complaint')}}" class="btn btn-primary mt-2">Coba Lagi</a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <footer id="footer" style="background-color:#002d6f;color:#fff;">
    <div class="container py-4 text-center">
      <p style="margin:0;font-size:15px;">© <strong>Sintara 2025</strong> - Semua hak cipta dilindungi.</p>
    </div>
  </footer>

  <script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
