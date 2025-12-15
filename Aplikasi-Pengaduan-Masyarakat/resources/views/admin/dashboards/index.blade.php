@extends('admin.layouts.main')
@section('title','Dashboard | Public Complaints')
@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
        </div>
      </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="mdi mdi-check-all me-2"></i>{{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
      <div class="col-xl-4">
        <div class="card overflow-hidden">
          <div class="bg-primary bg-soft">
            <div class="row">
              <div class="col-7">
                <div class="text-primary p-3">
                  <h5 class="text-primary">Selamat Datang!</h5>
                  <p>Pelayanan Pengaduan Online</p>
                </div>
              </div>
              <div class="col-5 align-self-end">
                <img src="{{asset('assets/images/profile-img.png')}}" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-sm-4">
                <div class="avatar-md profile-user-wid mb-4">
                  <img src="{{url('avatar/'.Auth::user()->photo)}}" alt="" class="img-thumbnail rounded-circle">
                </div>
                <h5 class="font-size-15 text-truncate">{{Auth::user()->username}}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-8">
        <div class="row">
          <div class="col-md-4">
            <div class="card mini-stats-wid">
              <div class="card-body">
                <div class="media">
                  <div class="media-body">
                    <p class="text-muted fw-medium">Total Pengaduan</p>
                    <h4 class="mb-0">{{ $complaints }}</h4>
                  </div>
                  <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-primary">
                      <i class="bx bx-copy-alt font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mini-stats-wid">
              <div class="card-body">
                <div class="media">
                  <div class="media-body">
                    <p class="text-muted fw-medium">Belum Diproses</p>
                    <h4 class="mb-0">{{ $unprocessed }}</h4>
                  </div>
                  <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-primary">
                      <i class="bx bx-time-five font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mini-stats-wid">
              <div class="card-body">
                <div class="media">
                  <div class="media-body">
                    <p class="text-muted fw-medium">Dilanjutkan ke Kelurahan</p>
                    <h4 class="mb-0">{{ $forwarded }}</h4>
                  </div>
                  <div class="avatar-sm rounded-circle bg-info align-self-center mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-info">
                      <i class="bx bx-share-alt font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mini-stats-wid">
              <div class="card-body">
                <div class="media">
                  <div class="media-body">
                    <p class="text-muted fw-medium">Dalam Perbaikan</p>
                    <h4 class="mb-0">{{ $repair }}</h4>
                  </div>
                  <div class="avatar-sm rounded-circle bg-warning align-self-center mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-warning">
                      <i class="bx bx-wrench font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mini-stats-wid">
              <div class="card-body">
                <div class="media">
                  <div class="media-body">
                    <p class="text-muted fw-medium">Selesai</p>
                    <h4 class="mb-0">{{ $finished }}</h4>
                  </div>
                  <div class="avatar-sm rounded-circle bg-success align-self-center mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-success">
                      <i class="bx bx-check-circle font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mini-stats-wid">
              <div class="card-body">
                <div class="media">
                  <div class="media-body">
                    <p class="text-muted fw-medium">Ditolak</p>
                    <h4 class="mb-0">{{ $rejected }}</h4>
                  </div>
                  <div class="avatar-sm rounded-circle bg-danger align-self-center mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-danger">
                      <i class="bx bx-x-circle font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mini-stats-wid">
              <div class="card-body">
                <div class="media">
                  <div class="media-body">
                    <p class="text-muted fw-medium">User</p>
                    <h4 class="mb-0">{{ $users }}</h4>
                  </div>
                  <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-primary">
                      <i class="bx bx-user font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mini-stats-wid">
              <div class="card-body">
                <div class="media">
                  <div class="media-body">
                    <p class="text-muted fw-medium">Masyarakat</p>
                    <h4 class="mb-0">{{ $society }}</h4>
                  </div>
                  <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-primary">
                      <i class="bx bx-group font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Grafik Pengaduan</h4>
            <canvas id="myChartt"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
foreach ($tahun as $row) {
  $th[] = $row->Tahun;
  $complaint1[] = $row->pay_total;
}
?>

@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<script>
  var ctx = document.getElementById('myChartt').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: <?php echo json_encode($th) ?>,
          datasets: [{
              label: 'Total Pengaduan',
              data: <?php echo json_encode($complaint1) ?>,
              backgroundColor: [
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(255, 99, 132, 0.2)'
              ],
              borderColor: [
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(255, 99, 132, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
</script>
@endpush
