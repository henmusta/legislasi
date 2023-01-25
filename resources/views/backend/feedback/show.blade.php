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
                        {{ \Carbon\Carbon::parse($data['comment']['created_at'])->isoFormat('dddd, D MMMM Y')}}
                        {{-- {{ $data['legislasi']['created_at'] ?? '' }} --}}
                    </div>
                </div>



                <div class="row" style="padding-top:10px;">
                    <div class="col-md-3">
                        <address class="mb-6">
                            <h5 class="mb-2">Nama</h5>
                           <p>  {{ $data['comment']['name'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-3">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">Nik</h5>
                           <p>  {{ $data['comment']['nik'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-3">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">Telp</h5>
                           <p>  {{ $data['comment']['telp'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-3">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">Email</h5>
                           <p>  {{ $data['comment']['email'] ?? '' }}</p>
                        </address>
                    </div>

                </div>
                <!-- end row -->

                <div class="py-2">
                 {{-- //   <h5 class="font-size-15">Lampiran</h5> --}}
                    <div class="table-responsive mt-4">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr class="">
                                    <th class="text-left">Ranperda</th>
                                    <th class="text-left">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                  <td>{{ $data['comment']['legislasi']['judul'] ?? '' }}</td>
                                  <td>{{$data['comment']['comment'] ?? '-'}}</td>
                                </tr>


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
