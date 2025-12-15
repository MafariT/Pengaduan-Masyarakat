@extends('frontend.layouts.main')
@section('title','Complaint')
@section('css')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Riwayat Pengaduan</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Tanggal Pengaduan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($complaint as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ url('avatar_complaint/', $row->photo) }}" width="120px"></td>
                                        <td>{{ date('d F Y', strtotime($row->created_at)) }}</td>
                                        <td>
                                            @switch($row->status)
                                                @case('0')
                                                    <span class="badge rounded-pill bg-danger">Belum Diproses</span>
                                                    @break

                                                @case('kelurahan')
                                                    <span class="badge rounded-pill bg-info">Dilanjutkan ke Kelurahan</span>
                                                    @break

                                                @case('perbaikan')
                                                    <span class="badge rounded-pill bg-warning text-dark">Dalam Perbaikan</span>
                                                    @break

                                                @case('rejected')
                                                    <span class="badge rounded-pill bg-secondary">Ditolak</span>
                                                    @break

                                                @case('finished')
                                                    <span class="badge rounded-pill bg-success">Selesai</span>
                                                    @break

                                                @default
                                                    <span class="badge rounded-pill bg-light text-dark">-</span>
                                            @endswitch
                                        </td>

                                        <td>
                                            <a href="{{ url('user/complaint/detail/'.$row->id) }}" class="btn btn-info">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('script')
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush
