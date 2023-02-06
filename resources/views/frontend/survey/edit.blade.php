@extends('frontend.layouts.master')

@section('content')
        <!-- PAGE TITLE
        ================================================== -->
        <section class="page-title-section2 bg-img  top-position1" data-overlay-dark="4" data-overlay-dark="0" data-background="{{ asset('assets/frontend/img/bg/bg4.jpg')}}">
            <div class="container">
                <div class="wrapper pt-5">
                    <div class="container-fluid">
                       <div class="row text-center">
                          <!-- Circles which indicates the steps of the form: -->
                          <div class="col step_progress d-flex d-none d-sm-block">

                            @for ($i = -1; $i < count($data['question']); $i++)
                                @if ([$i] == 0)
                                <span class="step bg-white rounded-pill active"></span>
                                @else
                                <span class="step bg-white rounded-pill"></span>
                                @endif
                             @endfor
                          </div>
                       </div>
                    </div>
                    <form id="formStore" id="formStore" action="{{ route('e-survey.store') }}">
                        @csrf
                    <div class="container">

                          <div class="multisteps_form_panel">
                             <!-- Form-content -->

                             <div class="posts">
                                <div class="post">
                                    <div class="content">
                                        <div class="post-meta">
                                            <div class="post-title">
                                                <h2> Survey {{$data['survey']['name']}}</h2>
                                            </div>
                                            <ul class="meta ps-0">

                                            </ul>
                                        </div>
                                        <div class="post-cont" style="color: black">
                                            {!!$data['survey']['deskripsi']!!}
                                        </div>

                                    </div>
                                </div>

                                <span class="question_number text-uppercase d-flex justify-content-center align-items-center">Masukan Data Diri</span>
                            </div><hr>
                             {{-- <h1 class="question_title text-center" >Survey {{$data['survey']['name']}}</h1> --}}
                             <!-- Form-items -->
                             <div class="form_items d-flex justify-content-center">
                                <div class="contact-form-box">
                                    <div class="quform-elements">
                                            <div class="row">
                                                <!-- Begin Captcha element -->
                                                <input type="hidden" name="kategorisurvey_id" value="{{$data['kategori']['id']}}"/>
                                                <input type="hidden" name="survey_id" value="{{$data['survey']['id']}}"/>

                                                <div class="col-md-12">
                                                    <div class="quform-element">
                                                        <div class="form-group">
                                                            <div class="quform-input">
                                                                <input class="form-control" id="nik" type="text" name="nik" placeholder="Masukan NIK" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="quform-element">
                                                        <div class="form-group">
                                                            <div class="quform-input">
                                                                <input class="form-control" id="name" type="text" name="name" placeholder="Masukan Nama" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="quform-element">
                                                        <div class="form-group">
                                                            <div class="quform-input">
                                                                <input class="form-control" id="email" type="text" name="email" placeholder="Masukan Email" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="quform-element">
                                                        <div class="form-group">
                                                            <div class="quform-input">
                                                                <input class="form-control" id="telp" type="text" name="telp" placeholder="Masukan Telp" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                             </div>
                          </div>
                          <!------------------------- Step-2 ----------------------------->
                          @foreach ($data['question'] as $key => $val)
                          <div class="multisteps_form_panel">
                            <!-- Form-content -->
                            @php($no = $key +1)
                            <span class="question_number text-uppercase d-flex justify-content-center align-items-center">Question {{$no}}/{{count($data['question'])}}</span>
                            <h1 class="question_title text-center">{!! $val['question'] !!}</h1>
                            <!-- Form-items -->
                            <div class="form_items d-flex justify-content-center">
                                <input type="hidden" name="params[{{$key}}][question_id]" value="{{$val['id']}}"/>
                                <ul class="ps-0" style="text-align: left !important">
                                @foreach ($val['questiondetail'] as $i => $item)
                                    <li class="rounded-pill bg-white animate__animated animate__fadeInRight animate_50ms">
                                        <input type="radio" id="opt_1{{$item['id']}}" name="params[{{$key}}][answer_{{$val['id']}}]" value="{{$item['answer']}}" {{$i == 0 ? 'checked' : ''}}>
                                        <label for="opt_1">{{$item['deskripsi']}}</label>
                                    </li>
                                @endforeach

                                  {{-- <li class=" rounded-pill bg-white animate__animated animate__fadeInRight animate_100ms">
                                     <input type="radio" id="opt_2{{$val['id']}}" name="params[{{$key}}][answer_{{$val['id']}}]" value="b">
                                     <label for="opt_2">{{$val['b']}}</label>
                                  </li>
                                  <li class=" rounded-pill bg-white animate__animated animate__fadeInRight animate_100ms">
                                    <input type="radio" id="opt_3{{$val['id']}}" name="params[{{$key}}][answer_{{$val['id']}}]" value="c">
                                    <label for="opt_3">{{$val['c']}}</label>
                                  </li>
                                   <li class=" rounded-pill bg-white animate__animated animate__fadeInRight animate_100ms">
                                    <input type="radio" id="opt_4{{$val['id']}}" name="params[{{$key}}][answer_{{$val['id']}}]" value="d">
                                    <label for="opt_4">{{$val['d']}}</label>
                                   </li>
                                    <li class=" rounded-pill bg-white animate__animated animate__fadeInRight animate_100ms">
                                        <input type="radio" id="opt_5{{$val['id']}}" name="params[{{$key}}][answer_{{$val['id']}}]" value="e">
                                        <label for="opt_5">{{$val['e']}}</label>
                                    </li> --}}
                               </ul>
                            </div>
                          </div>
                          @endforeach


                          <!---------- Form Button ---------->
                          <div class="form_btn text-center ms-5 mt-5">
                             <button type="button" class="f_btn text-uppercase rounded-pill border-0" id="prevBtn" onclick="nextPrev(-1)">Kembali</button>
                             <button type="button" class="f_btn text-uppercase rounded-pill border-0" id="nextBtn" onclick="nextPrev(1)">Lanjut</button>
                          </div>

                    </div>
                </form>
                 </div>

           </div>
        </section>

        <!-- TABLE
        ================================================== -->





@endsection

@section('css')

<link rel="stylesheet" href="{{asset('assets/frontend/wizard/css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/wizard/css/style.css')}}">
@endsection
@section('script')
<script src="{{asset('assets/frontend/wizard/js/jquery.validate.min.js')}}"></script>
<!-- Custom-js include -->
<script src="{{asset('assets/frontend/wizard/js/script.js')}}"></script>
<script>

$(document).ready(function () {

    $("#formStore").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let btnSubmit = form.find("[type='submit']");
        let btnSubmitHtml = btnSubmit.html();
        let url = form.attr("action");
        let data = new FormData(this);
        $.ajax({
          beforeSend: function () {
            btnSubmit.addClass("disabled").html("<span aria-hidden='true' class='spinner-border spinner-border-sm' role='status'></span> Loading ...").prop("disabled", "disabled");
          },
          cache: false,
          processData: false,
          contentType: false,
          type: "POST",
          url: url,
          data: data,
          success: function (response) {
            let errorCreate = $('#errorCreate');
            errorCreate.css('display', 'none');
            errorCreate.find('.alert-text').html('');
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
            if (response.status === "success") {
              toastr.success(response.message, 'Success !');
              setTimeout(function () {
                if (response.redirect === "" || response.redirect === "reload") {
                  location.reload();
                } else {
                  location.href = response.redirect;
                }
              }, 1000);
            } else {
              toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
              if (response.error !== undefined) {
                errorCreate.removeAttr('style');
                $.each(response.error, function (key, value) {
                  errorCreate.find('.alert-text').append('<span style="display: block">' + value + '</span>');
                });
              }
            }
          },
          error: function (response) {
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
            toastr.error(response.responseJSON.message, 'Failed !');
          }
        });
      });
});


</script>
@endsection
