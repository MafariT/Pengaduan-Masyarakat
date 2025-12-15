<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cetak-Laporan</title>
  <style>
    body { font-family: sans-serif; font-size: 12px; }
    h3 { margin: 0; text-align: center; font-size: 16px; font-weight: bold; }
    h4 { margin: 4px 0 10px; text-align: center; font-size: 16px; font-weight: bold; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #000; padding: 6px; text-align: center; }
    th { background: #f2f2f2; }
    .text-left{ text-align:left }
  </style>
</head>
<body>
  <h3>LAPORAN HARIAN</h3>
  <h4>SINTARA</h4>
  <p style="text-align:center;margin:0 0 10px;"></p>

  <table>
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
      @forelse($data as $i => $item)
        <tr>
          <td>{{ $i + 1 }}</td>
          <td>{{ $item->nik }}</td>
          <td class="text-left">{{ $item->contents_of_the_report }}</td>
          <td>{{ $item->date_complaint }}</td>
          <td>
            @switch($item->status)
              @case('0')         Belum Diproses @break
              @case('kelurahan') Dilanjutkan ke Kelurahan @break
              @case('perbaikan') Dalam Perbaikan @break
              @case('process')   Proses @break
              @case('rejected')  Ditolak @break
              @case('finished')  Selesai @break
              @default           
            @endswitch
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" style="text-align:center;">Tidak ada data</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
