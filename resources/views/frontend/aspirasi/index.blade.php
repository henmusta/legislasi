@extends('frontend.layouts.master')

@section('content')
        <!-- PAGE TITLE
        ================================================== -->
        <section class="page-title-section2 bg-img cover-background top-position1" data-overlay-dark="4" data-background="assets/frontend/img/bg/bg9.jpg">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
<<<<<<< HEAD
                        <h1>E-legislasi</h1>
=======
                        <h1>E-Aspirasi</h1>
>>>>>>> 520f12f (a)
                    </div>
                    <div class="col-md-12">
                        <ul class="ps-0">
                            <li><a href="home-default.html">Home</a></li>
<<<<<<< HEAD
                            <li><a href="#!">E-legislasi</a></li>
=======
                            <li><a href="#!">E-Aspirasi</a></li>
>>>>>>> 520f12f (a)
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        <!-- TABLE
        ================================================== -->
        <section  class="bg-img" data-overlay-dark="0" data-background="{{ asset('assets/frontend/img/bg/bg6.jpg')}}" style="background-image: url({{ asset('assets/frontend/img/bg/bg6.jpg')}});">
            <div class="container">
<<<<<<< HEAD
              <div class="section-heading">
                    <h2>Form Aspirasi</h2>
              </div>
              <form id="formStore" action="{{ route('e-aspirasi.store') }}">
                    @csrf          
                <div class="horizontaltab">
                    <ul class="resp-tabs-list hor_1">
                        <li><i class="fas fa-medkit"></i>Data Diri</li>
                        <li><i class="fas fa-cog"></i>Lokasi</li>
                        <li><i class="fas fa-flask"></i>Usulan</li>
                        <li><i class="fas fa-user"></i>Diusulkan Kepada</li>
                    </ul>
                        <div class="resp-tabs-container hor_1">
                        <div>
                            <div class="contact-form-box">
                                <div class="quform-elements">
                                        <div class="row">
                                            <!-- Begin Captcha element -->
                     
                                            @if($data['form'][0]['status'] == '1')
                                            <div class="col-md-12">
                                                <div class="quform-element">
                                                    <div class="form-group">
                                                        <div class="quform-input">
                                                            <input class="form-control" id="nik" type="text" name="nik" placeholder="Masukan NIK" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if($data['form'][1]['status'] == '1')
                                            <div class="col-md-12">
                                                <div class="quform-element">
                                                    <div class="form-group">
                                                        <div class="quform-input">
                                                            <input class="form-control" id="name" type="text" name="name" placeholder="Masukan Name" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if($data['form'][2]['status'] == '1')
                                            <div class="col-md-12">
                                                <div class="quform-element">
                                                    <div class="form-group">
                                                        <div class="quform-input">
                                                            <input class="form-control" id="telp" type="text" name="telp" placeholder="Masukan Telp" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <!-- End Captcha element -->


                                        </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="contact-form-box">
                            
                                <div class="quform-elements">
                                    <div class="row">
                                        <!-- Begin Captcha element -->
                                        @if($data['form'][3]['status'] == '1')
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                            <select id="select2Kabupaten" style="width: 100% !important;" name="kabupaten_id">
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($data['form'][4]['status'] == '1')
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                            <select id="select2Kecamatan" style="width: 100% !important;" name="kecamatan_id">
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($data['form'][5]['status'] == '1')
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                        <textarea class="form-control h-100" id="alamat" name="alamat" rows="3" placeholder="masukan alamat"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <!-- End Captcha element -->


                                    </div>
                                </div>

                            </div>
                        </div>
                        <div>
                            <div class="contact-form-box">
                            
                                <div class="quform-elements">
                                    <div class="row">
                                        <!-- Begin Captcha element -->
                                        @if($data['form'][6]['status'] == '1')
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                    <input class="form-control" id="aspirasi" type="text" name="aspirasi" placeholder="Masukan Aspirasi" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($data['form'][7]['status'] == '1')
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                        <input class="form-control" id="komisi" type="text" name="komisi" placeholder="Masukan Komisi" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($data['form'][8]['status'] == '1')
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                    <input class="form-control" id="isu" type="text" name="isu" placeholder="Masukan Isu Strategis" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($data['form'][9]['status'] == '1')
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                    <input class="form-control" id="urusan" type="text" name="urusan" placeholder="Masukan Urusan" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($data['form'][10]['status'] == '1')
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                            <select id="select2Skpd" style="width: 100% !important;" name="skpd_id">
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($data['form'][11]['status'] == '1')
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                    <input class="form-control" id="anggaran" type="text" name="anggaran" placeholder="Masukan Anggaran" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($data['form'][12]['status'] == '1')
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                    <input class="form-control" id="sasaran" type="text" name="sasaran" placeholder="Masukan Sasaran" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                    <input class="form-control" id="lampiran" type="file" name="lampiran" placeholder="Masukan Sasaran" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Captcha element -->


                                    </div>
                                </div>

                            </div>
                        </div>
                        <div>
                            <div class="contact-form-box">
                            
                                <div class="quform-elements">
                                    <div class="row">
                               

                                        <div class="col-md-12">
                                            <div class="quform-element">
                                                <div class="form-group">
                                                    <div class="quform-input">
                                                            <select id="select2Dewan" style="width: 100% !important;" name="dewan_id">
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                 
                                        <!-- End Captcha element -->

                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary me-2" onclick="window.history.back();">
                                                Kembali
                                            </button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                         </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> 
              </form>  
                        
               
                                
=======
                <div class="contact-form-box">
                    <form class="contact quform" action="quform/contact.php" method="post" enctype="multipart/form-data" onclick="">
                        <div class="quform-elements">
                            <div class="row">

                                <!-- Begin Captcha element -->
                                <div class="col-md-12">
                                    <div class="quform-element">
                                        <div class="form-group">
                                            <div class="quform-input">
                                                <input class="form-control" id="type_the_word" type="text" name="type_the_word" placeholder="Type the below word" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Captcha element -->

                                <!-- Begin Submit button -->
                                <div class="col-md-12">
                                    <div class="quform-submit-inner">
                                        <button class="butn" type="submit"><span>Sumbit comment</span></button>
                                    </div>
                                    <div class="quform-loading-wrap text-start"><span class="quform-loading"></span></div>
                                </div>
                                <!-- End Submit button -->

                            </div>
                        </div>
                    </form>
                </div>

>>>>>>> 520f12f (a)
           </div>
        </section>




@endsection

@section('css')

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>
$(document).ready(function () {
<<<<<<< HEAD
    let select2Kabupaten = $('#select2Kabupaten');
    let select2Kecamatan = $('#select2Kecamatan');
    let select2Skpd = $('#select2Skpd');
    let select2Dewan = $('#select2Dewan');
      select2Kabupaten.select2({
        dropdownParent: select2Kabupaten.parent(),
        searchInputPlaceholder: 'Cari Kabupaten',
        allowClear: true,
        width: '100%',
        placeholder: 'Pilih Kabupaten',
        ajax: {
          url: "{{ route('backend.kabupaten.select2') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
      });


      select2Kecamatan.select2({
        dropdownParent: select2Kecamatan.parent(),
        searchInputPlaceholder: 'Cari Kecamatan',
        allowClear: true,
        width: '100%',
        placeholder: 'Pilih Kecamatan',
        ajax: {
          url: "{{ route('backend.kecamatan.select2') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
      });

      select2Skpd.select2({
        dropdownParent: select2Skpd.parent(),
        searchInputPlaceholder: 'Cari Skpd',
        allowClear: true,
        width: '100%',
        placeholder: 'Pilih Skpd',
        ajax: {
          url: "{{ route('backend.skpd.select2') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
      });

      select2Dewan.select2({
        dropdownParent: select2Dewan.parent(),
        searchInputPlaceholder: 'Cari Dewan',
        allowClear: true,
        width: '100%',
        placeholder: 'Pilih Dewan',
        ajax: {
          url: "{{ route('backend.dewan.select2') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
      });

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
=======
>>>>>>> 520f12f (a)


});
</script>
@endsection
