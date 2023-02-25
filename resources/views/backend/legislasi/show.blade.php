@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                    <a onclick="window.history.back();" class="btn btn-primary w-md">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="invoice-title">
                    {{-- <h4 class="float-end font-size-15">Invoice #DS0204 <span class="badge bg-success font-size-12 ms-2">Paid</span></h4> --}}
                    <div class="mb-4">
                           <img  src="{{URL::to('storage/images/logo/'.Setting::get_setting()->icon)}}" alt="logo" height="50">
                    </div>
                    <div class="text-muted">
                        {{ \Carbon\Carbon::parse($data['legislasi']['created_at'])->isoFormat('dddd, D MMMM Y')}}
                        {{-- {{ $data['legislasi']['created_at'] ?? '' }} --}}
                    </div>
                </div>



                <div class="row" style="padding-top:10px;">
                    <div class="col-3">
                        <address class="mb-6">
                            <h5 class="mb-2">Kategori Ranperda</h5>
                           <p>  {{ $data['legislasi']['kategoriranperda']['name'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-3">
                        <address class="mb-6">
                            <h5 class="mb-2">Judul</h5>
                           <p>  {{ $data['legislasi']['judul'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-3">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">Tahapan</h5>
                           <p>  {{ $data['legislasi']['tahapan']['name'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-3">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">Pengusul</h5>
                           <p>  {{ $data['legislasi']['pengusul']['name'] ?? '' }}</p>
                        </address>
                    </div>

                </div>
                <!-- end row -->

                <div class="py-2">
                    <h5 class="font-size-15">Agenda</h5>

                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr class="">
                                    <th class="text-left">Judul</th>
                                    <th class="text-left">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['agenda'] as $val)
                                <tr style="background-color:rgba(200, 198, 198, 0.645);">
                                  <td>{{$val->judul ?? '-'}}</td>
                                  <td>{{$val->deskripsi ?? '-'}}</td>
                                    @foreach ( $val->agendafile as $item)
                                        <tr >
                                            <td><a href="{{ $item->name != NULL ? asset("/storage/lampiran/".$item->name) : '' }}" download >{{$item->name ?? ''}}</a></td>
                                            <td>{{$item->keterangan ?? '-'}}</td>
                                        </tr>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-print-none mt-4">

                    </div>
                </div>

                <div class="py-2">
                         <h5 class="font-size-15">Feedback</h5>
                        <div class="table-responsive mt-4">
                            <table class="table">
                                <thead>
                                    <tr class="">
                                        <th class="text-left">Tanggal</th>
                                        <th class="text-left">Nama</th>
                                        <th class="text-left">Feedback</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['comment'] as $val)
                                    <tr>
                                        <td> {{ \Carbon\Carbon::parse($val->created_at)->isoFormat('D MMMM Y')}}</td>
                                        <td>{{$val->name ?? '-'}}</td>
                                        <td>{{$val->comment ?? '-'}}</td>
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
