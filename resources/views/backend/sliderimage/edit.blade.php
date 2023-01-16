@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <form id="formUpdate" action="{{ route('backend.imageslider.update', Request::segment(3)) }}">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @method('PUT')
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-1">{{ $config['page_title'] ?? '' }}</h6>
                          </div><br>
                      <div id="errorCreate" class="mb-3" style="display:none;">
                        <div class="alert alert-danger" role="alert">
                          <div class="alert-text">
                          </div>
                        </div>
                      </div>
                      <div class="d-flex flex-column">
                        <div class="row">
                            <div class="col-sm-12" >
                                <div class="mb-3" style="text-align: center">
                                    <label class="mx-0 text-bold d-block">Photo</label>
                                    <img id="avatar"   src="{{ $data['sliderimage']['image'] != NULL ? asset("/storage/images/slider/".$data['sliderimage']['image']) : asset('assets/backend/images/noimg.png') }}"
                                         style="object-fit: cover; border: 1px solid #d9d9d9" class="mb-2 border-2 mx-auto"
                                         height="250px"
                                         width="950px" alt="">
                                    <input type="file" class="image d-block" name="image" accept=".jpg, .jpeg, .png" style="text-align:center; margin: 0 auto !important;">
                                    <p class="text-muted ms-75 mt-50"><small>Allowed JPG, JPEG or PNG. Max
                                        size of
                                        2000kB</small></p>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" >
                                <div class="mb-3">
                                    <label>Judul<span class="text-danger">*</span></label>
                                    <input type="text" name="judul" class="form-control" placeholder="Enter Judul" value="{{ $data['sliderimage']['judul'] ?? '' }}"/>
                                  </div>
                            </div>
                            <div class="col-sm-6" >
                                <div class="mb-3">
                                    <label>Deskripsi<span class="text-danger">*</span></label>
                                    <textarea type="text" name="deskripsi" class="form-control" placeholder="Enter Deskripsi"> {{ $data['sliderimage']['deskripsi'] ?? '' }}</textarea>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" >
                                <div class="mb-3">
                                    <label for="select2Menu">Menu<span class="text-danger">*</span></label>
                                    <select id="select2Menu" style="width: 100% !important;" name="menu_permission_id">
                                        <option value="{{ $data['menu']['id'] }}">{{ $data['menu']['title'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6" >
                                <div class="mb-3">
                                    <label>Urut<span class="text-danger">*</span></label>
                                    <input type="number" name="urut" class="form-control" placeholder="Enter Urutan" value="{{ $data['sliderimage']['urut'] ?? '' }}"/>
                                </div>
                            </div>
                        </div>




                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" onclick="window.history.back();">
                          Cancel
                        </button>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </form>
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

      $(".image").change(function () {
        let thumb = $(this).parent().find('img');
        if (this.files && this.files[0]) {
          let reader = new FileReader();
          reader.onload = function (e) {
            thumb.attr('src', e.target.result);
          }
          reader.readAsDataURL(this.files[0]);
        }
      });
    let select2MenuPermission = $('#select2Menu');
    select2MenuPermission.select2({
        placeholder: "Cari Menu Halaman",
        allowClear: true,
        ajax: {
          url: "{{ route('backend.menupermissions.select2') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              type: 'frontend' ?? '',
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      });
      $("#formUpdate").submit(function (e) {
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
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          cache: false,
          processData: false,
          contentType: false,
          type: "POST",
          url: url,
          data: data,
          success: function (response) {
            let errorEdit = $('#errorEdit');
            errorEdit.css('display', 'none');
            errorEdit.find('.alert-text').html('');
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
            if (response.status === "success") {
              toastr.success(response.message, 'Success !');
              setTimeout(function () {
                if (!response.redirect || response.redirect === "reload") {
                  location.reload();
                } else {
                  location.href = response.redirect;
                }
              }, 1000);
            } else {
              toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
              if (response.error !== undefined) {
                errorEdit.removeAttr('style');
                $.each(response.error, function (key, value) {
                  errorEdit.find('.alert-text').append('<span style="display: block">' + value + '</span>');
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
