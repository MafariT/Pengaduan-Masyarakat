@extends('admin.layouts.main')
@section('title','Laporan Harian')

@section('content')
<div class="page-content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Laporan Harian</h4>
        </div>
      </div>
    </div>

    {{-- Form filter tanggal --}}
    <form action="{{ route('report.day.search') }}" method="GET" class="mb-3" id="filterForm">
      <div class="card">
        <div class="card-body">
          <div class="mb-3 row">
            <label class="col-md-2 col-form-label">Dari Tanggal</label>
            <div class="col-md-10">
              <input type="date" class="form-control" id="date1" name="date1" value="{{ $date1 ?? '' }}">
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-md-2 col-form-label">Sampai Tanggal</label>
            <div class="col-md-10">
              <input type="date" class="form-control" id="date2" name="date2" value="{{ $date2 ?? '' }}">
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-md-2 col-form-label"></label>
            <div class="col-md-10 d-flex gap-2">
              <button class="btn btn-success" type="submit">Cari</button>

              {{-- Export PDF: buka tab baru dengan membawa tanggal --}}
              <button type="button" class="btn btn-warning" id="btnExportPdf">
                Export PDF
              </button>
            </div>
          </div>

        </div>
      </div>
    </form>

    {{-- Tabel hasil --}}
    <div class="card">
      <div class="card-body">
        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
          <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Pengaduan</th>
              <th>Tanggal</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse($data as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->contents_of_the_report }}</td>
                <td>{{ $item->date_complaint }}</td>
                <td>
                  @switch($item->status)
                    @case('0')         <span class="badge rounded-pill bg-danger">Belum Diproses</span> @break
                    @case('kelurahan') <span class="badge rounded-pill bg-info">Dilanjutkan ke Kelurahan</span> @break
                    @case('perbaikan') <span class="badge rounded-pill bg-warning text-dark">Dalam Perbaikan</span> @break
                    @case('rejected')  <span class="badge rounded-pill bg-secondary">Ditolak</span> @break
                    @case('finished')  <span class="badge rounded-pill bg-success">Selesai</span> @break
                    @default           <span class="badge rounded-pill bg-light text-dark">-</span>
                  @endswitch
                </td>
              </tr>
            @empty
              
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<script>
  document.getElementById('btnExportPdf')?.addEventListener('click', function () {
    const d1 = document.getElementById('date1')?.value || '';
    const d2 = document.getElementById('date2')?.value || '';
    const base = @json(route('report.day.pdf'));
    const url  = `${base}?date1=${encodeURIComponent(d1)}&date2=${encodeURIComponent(d2)}`;

    window.open(url, '_blank');
  });
</script>
@endsection
