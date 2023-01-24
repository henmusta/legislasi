@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="invoice-title">
                    {{-- <h4 class="float-end font-size-15">Invoice #DS0204 <span class="badge bg-success font-size-12 ms-2">Paid</span></h4> --}}
                    <div class="mb-4">
                           <img  src="{{URL::to('storage/images/logo/'.Setting::get_setting()->icon)}}" alt="logo" height="50">
                    </div>
                    <div class="text-muted">
                        {{ \Carbon\Carbon::parse($data['aspirasi']['tgl_buat'])->isoFormat('dddd, D MMMM Y')}}
                        {{-- {{ $data['legislasi']['created_at'] ?? '' }} --}}
                    </div>
                </div>



                <div class="row" style="padding-top:10px;">
                    <div class="col-md-4">
                        <address class="mb-6">
                            <h5 class="mb-2">NIK</h5>
                            <p>  {{ $data['aspirasi']['nik'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">NAMA</h5>
                            <p>  {{ $data['aspirasi']['name'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">TELEPON</h5>
                            <p>  {{ $data['aspirasi']['telp'] ?? '' }}</p>
                        </address>
                    </div>

                </div>

                <div class="row" style="padding-top:10px;">
                    <div class="col-md-4">
                        <address class="mb-6">
                            <h5 class="mb-2">Kabupaten</h5>
                            <p>  {{ $data['aspirasi']['get_kabupaten']['name'] ?? ''}}</p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">kecamatan</h5>
                            <p>  {{ $data['aspirasi']['get_kecamatan']['name'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">Alamat</h5>
                            <p>  {{ $data['aspirasi']['alamat'] ?? '' }}</p>
                        </address>
                    </div>

                </div>
                <div class="py-2">
                    {{-- <h5 class="font-size-15">Lampiran</h5> --}}
                    <div class="table-responsive mt-4">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr class="">
                                    <th class="text-left">Aspirasi</th>
                                    <th class="text-left">Komisi</th>
                                    <th class="text-left">Isu</th>
                                    <th class="text-left">Urusan</th>
                                    <th class="text-left">Skpd</th>
                                    <th class="text-left">Anggaran</th>
                                    <th class="text-left">Sasaran</th>
                                    {{-- <th class="text-center">Keterangan</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$data['aspirasi']['aspirasi']}}</td>
                                    <td>{{$data['aspirasi']['komisi']}}</td>
                                    <td>{{$data['aspirasi']['isu']}}</td>
                                    <td>{{$data['aspirasi']['urusan']}}</td>
                                    <td>{{$data['aspirasi']['get_skpd']['name']}}</td>
                                    <td>{{$data['aspirasi']['anggaran']}}</td>
                                    <td>{{$data['aspirasi']['sasaran']}}</td>
                                    {{-- <td>{{$val->keterangan ?? '-'}}</td> --}}
                                  </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <div class="row" style="padding-top:10px;">
                    <div class="col-md-4">
                        <address class="mb-6">
                            <h5 class="mb-2">Aspirasi</h5>
                            <p>  {{ $data['aspirasi']['get_kabupaten']['name'] ?? ''}}</p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">Komisi</h5>
                            <p>  {{ $data['aspirasi']['get_kecamatan']['name'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">Isu</h5>
                            <p>  {{ $data['aspirasi']['alamat'] ?? '' }}</p>
                        </address>
                    </div>

                </div> --}}
                <!-- end row -->

                <div class="py-2">
                    {{-- <h5 class="font-size-15">Lampiran</h5> --}}
                    <div class="table-responsive mt-4">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr class="">
                                    <th>Dewan</th>
                                    <th class="text-left">Lampiran</th>
                                    {{-- <th class="text-center">Keterangan</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach($data['file'] as $val) --}}
                                <tr>
                                  <td>{{$data['aspirasi']['get_dewan']['name']}}</td>
                                  <td><a href="{{ $data['aspirasi']['lampiran'] != NULL ? asset("/storage/lampiran/".$data['aspirasi']['lampiran']) : '' }}" download >{{$data['aspirasi']['lampiran'] ?? ''}}</a></td>
                                  {{-- <td>{{$val->keterangan ?? '-'}}</td> --}}
                                </tr>
                                {{-- @endforeach --}}

                            </tbody>
                        </table>
                    </div>

                    <div class="d-print-none mt-4">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                            <a onclick="window.history.back();" class="btn btn-primary w-md">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

@section('css')
@endsection
@section('script')
  <script>
    $(document).ready(function () {
        // $('#tanggal_lahir').datepicker({ dateFormat: "yy-mm-dd" });
        $('#tanggal_lahir').flatpickr({
           dateFormat: "Y-m-d",
         });







    });
  </script>
@endsection
