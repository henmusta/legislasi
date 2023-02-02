@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row row-sm">
            <div class="col-12">
                <form id="formUpdate" action="{{ route('backend.page.update', Request::segment(3)) }}">
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input type="text" value="{{$data['page']['name']}}" id="name" name="name"  class="form-control" placeholder="Masukan Name"/>
                                  </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Judul<span class="text-danger">*</span></label>
                                    <input type="text"  value="{{$data['page']['judul']}}"  id="judul" name="judul"  class="form-control" placeholder="Masukan Judul"/>
                                  </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Deskripsi<span class="text-danger">*</span></label>
                                    <textarea name="deskripsi" class="my-editor form-control" id="deskripsi" cols="30" rows="10">
                                        {{$data['page']['deskripsi']}}
                                    </textarea>
                                  </div>
                            </div>
                        </div>
                        {{-- <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Judul Legislasi<span class="text-danger">*</span></label>
                                    <input type="text" id="judul" name="judul"  class="form-control" placeholder="Masukan Judul Legislasi"/>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                  <div class="mb-3">
                                    <label for="desc" class="form-label">Desc</label>
                                    <textarea name="deskripsi" class="my-editor form-control" id="my-editor" cols="30" rows="10"></textarea>
                                  </div>
                            </div>
                        </div> --}}
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
    </div>
  </div>
@endsection

@section('css')
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
$(document).ready(function () {
    let select2kategorisurvey = $('#select2kategorisurvey');
    // let select2Pengusul = $('#select2Pengusul');
    CKEDITOR.replace('deskripsi');
       select2kategorisurvey.select2({
        dropdownParent: select2kategorisurvey.parent(),
        searchInputPlaceholder: 'Cari Kategori Survey',
        allowClear: true,
        width: '100%',
        placeholder: 'select Kategori Survey',
        ajax: {
          url: "{{ route('backend.kategorisurvey.select2') }}",
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
            console.log(data.id);
      });
      $("#formUpdate").submit(function (e) {
        e.preventDefault();
        for (instance in CKEDITOR.instances) {CKEDITOR.instances[instance].updateElement()}
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
