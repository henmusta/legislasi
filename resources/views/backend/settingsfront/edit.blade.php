@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card custom-card">
            <form id="formUpdate" action="{{ route('backend.settingsfront.update', Request::segment(3)) }}">
              <meta name="csrf-token" content="{{ csrf_token() }}">
              @method('PUT')
                <div class="card-body">

                        <div id="errorEdit" class="mb-3" style="display:none;">
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-text">
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                            <div class="d-flex flex-column">
                            <div class="form-group">
                                <label class="mx-0 text-bold d-block">Icon</label>
                                <img id="avatar"
                                    src="{{ $data['icon'] != NULL ? asset("/storage/images/logo/".$data['icon']) : asset('assets/img/profile-photos/1.png') }}"
                                    style="object-fit: cover; border: 1px solid #d9d9d9" class="mb-2 border-2 mx-auto"
                                    height="150px"
                                    width="150px" alt="">
                                <input type="file" class="image d-block image"  name="icon" accept=".jpg, .jpeg, .png">
                                <p class="text-muted"><small>Allowed JPG, JPEG or PNG. Max
                                    size of
                                    2000kB</small></p>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex flex-column">
                            <div class="form-group">
                                <label class="mx-0 text-bold d-block">Sidebar Logo</label>
                                <img id="avatar"
                                    src="{{ $data['sidebar_logo'] != NULL ? asset("/storage/images/logo/".$data['sidebar_logo']) : asset('assets/img/profile-photos/1.png') }}"
                                    style="object-fit: cover; border: 1px solid #d9d9d9" class="mb-2 border-2 mx-auto"
                                    height="150px"
                                    width="150px" alt="">
                                <input type="file" class="favicon d-block image" name="sidebar_logo" accept=".jpg, .jpeg, .png">
                                <p class="text-muted"><small>Allowed JPG, JPEG or PNG. Max
                                    size of
                                    2000kB</small></p>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex flex-column">
                            <div class="form-group">
                                <label class="mx-0 text-bold d-block">favicon</label>
                                <img id="avatar"
                                    src="{{ $data['favicon'] != NULL ? asset("/storage/images/logo/".$data['favicon']) : asset('assets/img/profile-photos/1.png') }}"
                                    style="object-fit: cover; border: 1px solid #d9d9d9" class="mb-2 border-2 mx-auto"
                                    height="150px"
                                    width="150px" alt="">
                                <input type="file" class="favicon d-block image" name="favicon" accept=".jpg, .jpeg, .png">
                                <p class="text-muted"><small>Allowed JPG, JPEG or PNG. Max
                                    size of
                                    2000kB</small></p>
                            </div>
                            </div>
                        </div>
                </div>
                <div class="form-group">
                    <label>Nama App<span class="text-danger">*</span></label>
                    <input name="name" class="form-control " placeholder="Nama Aplikasi"
                           value="{{$data['name']}}">
                  </div>


              </div>
              <div class="card-footer">
                <div class="d-flex justify-content-end">
                  <button type="button" class="btn btn-secondary me-2" onclick="window.history.back();">
                    Cancel
                  </button>
                  <button type="submit" class="btn ripple btn-main-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
    </div>
  </div>
@endsection

@section('css')
@endsection
@section('script')
  <script>
    $(document).ready(function () {
      let select2Role = $('#select2Role');

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

      select2Role.select2({
        dropdownParent: select2Role.parent(),
        searchInputPlaceholder: 'Cari Role',
        width: '100%',
        ajax: {
          url: "{{ route('backend.roles.select2') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      });

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
    });
  </script>
@endsection
