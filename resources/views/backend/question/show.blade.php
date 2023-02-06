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
                        {{ \Carbon\Carbon::parse($data['question']['created_at'])->isoFormat('dddd, D MMMM Y')}}
                        {{-- {{ $data['legislasi']['created_at'] ?? '' }} --}}
                    </div>
                </div>



                <div class="row" style="padding-top:10px;">
                    <div class="col-md-4">
                        <address class="mb-6">
                            <h5 class="mb-2">Kategori Survey</h5>
                           <p>  {{ $data['question']['kategorisurvey']['name'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">Survey</h5>
                            <p>  {{ $data['question']['survey']['name'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">Qustion</h5>
                            <p>  {!! $data['question']['question'] ?? '' !!}</p>
                        </address>
                    </div>

                </div>
                <!-- end row -->

                <div class="py-2">
                    <h5 class="font-size-15">Lampiran</h5>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr class="">
                                    <th width="5%" class="text-left">Opsi</th>
                                    <th class="text-left">Pertanyaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['questiondetail'] as $val)
                                <tr>
                                  <td>{{$val->answer ?? '-'}}</td>
                                  <td>{{$val->deskripsi ?? '-'}}</td>
                                </tr>
                                @endforeach

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
