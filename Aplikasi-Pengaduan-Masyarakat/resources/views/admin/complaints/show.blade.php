@extends('admin.layouts.main')
@section('title','Pengaduan | Pengaduan Masyarakat')

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
                    <h4 class="mb-sm-0 font-size-18">Detail Pengaduan</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        <br>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <br>

        <div class="row">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Detail Pengaduan</h4>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-nowrap mb-0">
                                            <br>
                                            <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td>
                                                    <a href="javascript::void(0)">{{$complaint->Society->name}}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NIK</td>
                                                <td>
                                                    <a href="javascript::void(0)">{{$complaint->nik}}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Telepon</td>
                                                <td>
                                                    <a href="javascript::void(0)">{{$complaint->Society->phone_number}}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>
                                                    <a href="javascript::void(0)">{{ date('d F Y', strtotime($complaint->created_at)) }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>
                                                    {{-- Mapping status LENGKAP --}}
                                                    @switch($complaint->status)
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
                                            </tr>
                                            <tr>
                                                <td>Foto</td>
                                                <td>
                                                    <img src="{{ url('avatar_complaint/'.$complaint->photo) }}" width="500">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Isi Pengaduan</td>
                                                <td>
                                                    <a href="javascript::void(0)">{{$complaint->contents_of_the_report}}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Respon</td>
                                                <td>
                                                    @php
                                                        // antisipasi jika $response tidak dikirim dari controller
                                                        $respText = isset($response) && !empty($response->response) ? $response->response : null;
                                                    @endphp
                                                    @if ($respText)
                                                        <a href="javascript::void(0)">{{ $respText }}</a>
                                                    @else
                                                        <a href="javascript::void(0)">Belum Ada Respon</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <a href="{{ url('admin/complaints/show', $complaint->id) }}" class="btn btn-info">Berikan Balasan</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div> {{-- col --}}
                    </div>
                </div>
            </form>
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
<script>
    $('.btn-delete').click(function(){
        var society_id = $(this).attr('society-id');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mt-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                // ganti ke route delete yang benar jika diperlukan
                window.location = "{{ url('admin/society/delete') }}/"+society_id;
            }
        });
    });
</script>
@endpush
