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
                        {{ \Carbon\Carbon::parse($data['partisipan']['tgl_buat'])->isoFormat('dddd, D MMMM Y')}}
                        {{-- {{ $data['legislasi']['created_at'] ?? '' }} --}}
                    </div>
                </div>



                <div class="row" style="padding-top:10px;">
                    <div class="col-md-3">
                        <address class="mb-6">
                            <h5 class="mb-2">NIK</h5>
                            <p>  {{ $data['partisipan']['nik'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-3">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">NAMA</h5>
                            <p>  {{ $data['partisipan']['name'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-3">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">TELEPON</h5>
                            <p>  {{ $data['partisipan']['telp'] ?? '' }}</p>
                        </address>
                    </div>
                    <div class="col-md-3">
                        <address class="mb-6 mb-0">
                            <h5 class="mb-2">EMAIL</h5>
                            <p>  {{ $data['partisipan']['email'] ?? '' }}</p>
                        </address>
                    </div>

                </div>
                {{-- {{dd($data['partisipandetail'][''])}} --}}

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pertanyaan Dan Jawaban</h4>
                    </div>
                    <div class="card-body">
                        <div class="my-2">
                            <ul class="verti-timeline list-unstyled">
                                @foreach ($data['partisipandetail'] as $key => $val)
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="bx bx-right-arrow-circle"></i>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="bx bx-copy-alt h4 text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5>{!! $val['question']['question'] !!}</h5>
                                                {{-- {{dd($val)}} --}}
                                                <ul class="ps-0">

                                                    @foreach ($val['question']['questiondetail'] as $i)
                                                    <li class="active step_{{$i['id']}} rounded-pill bg-white animate__animated animate__fadeInRight animate_50ms">
                                                        <input type="radio" id="opt_1{{$i['id']}}"   value="b" {{ $val['answer'] == $i['answer'] ? 'checked' : 'disabled' }}>
                                                        <label for="opt_1">{{$i['deskripsi']}}</label>
                                                    </li>

                                                    @endforeach


                                                    {{-- <li class="active step_{{$val['id']}} rounded-pill bg-white animate__animated animate__fadeInRight animate_50ms">
                                                        <input type="radio" id="opt_1{{$val['id']}}"   value="b" {{ $val['answer'] == 'b' ? 'checked' : 'disabled' }}>
                                                        <label for="opt_1">{{$val['deskripsi']}}</label>
                                                    </li>
                                                    <li class="active step_{{$val['id']}} rounded-pill bg-white animate__animated animate__fadeInRight animate_50ms">
                                                        <input type="radio" id="opt_1{{$val['id']}}"   value="c" {{ $val['answer'] == 'c' ? 'checked' : 'disabled' }}>
                                                        <label for="opt_1">{{$val['deskripsi']}}</label>
                                                    </li>
                                                    <li class="active step_{{$val['id']}} rounded-pill bg-white animate__animated animate__fadeInRight animate_50ms">
                                                        <input type="radio" id="opt_1{{$val['id']}}"   value="d" {{ $val['answer'] == 'd' ? 'checked' : 'disabled' }}>
                                                        <label for="opt_1">{{$val['deskripsi']}}</label>
                                                    </li> --}}

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
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
