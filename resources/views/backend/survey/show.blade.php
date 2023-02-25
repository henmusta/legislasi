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
                        {{ \Carbon\Carbon::parse($data['survey']['created_at'])->isoFormat('dddd, D MMMM Y')}}
                        {{-- {{ $data['legislasi']['created_at'] ?? '' }} --}}
                    </div>
                </div>





                <div class="py-2">
                    <h5 class="font-size-15">Agenda</h5>

                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr class="">
                                    <th class="text-left">Judul</th>
                                    <th class="text-left">Kategori</th>
                                    <th class="text-left">Deskripsi</th>
                                    <th class="text-left">Jumlah Pertanyaan</th>
                                    <th class="text-left">Jumlah Partisipan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$data['survey']['name']}}</td>
                                    <td>{{$data['survey']['kategorisurvey']['name']}}</td>
                                    <td>{{$data['survey']['deskripsi']}}</td>
                                    <td class="text-center">{{$data['survey']['question_count'] ?? '0'}}</td>
                                    <td class="text-center">{{$data['survey']['partisipan_count'] ?? '0'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-print-none mt-4">

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





    });
  </script>
@endsection
