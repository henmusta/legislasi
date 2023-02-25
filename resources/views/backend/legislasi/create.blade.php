@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row row-sm">
            <div class="col-12">
                <form id="formStore" action="{{ route('backend.legislasi.store') }}">
                    @csrf
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

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="select2Kategoriranperda">Kategori Ranperda<span class="text-danger">*</span></label>
                                    <select id="select2Kategoriranperda" style="width: 100% !important;" name="kategoriranperda_id">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="select2Tahapan">Tahapan<span class="text-danger">*</span></label>
                                    <select id="select2Tahapan" style="width: 100% !important;" name="tahapan_id">
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Keterangan Tahapan<span class="text-danger">*</span></label>
                                    <textarea rows="5" id="keterangan" autocomplete="off" class="form-control" name="keterangan"></textarea>
                                  </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="select2Pengusul">Pengusul<span class="text-danger">*</span></label>
                                    <select id="select2Pengusul" style="width: 100% !important;" name="pengusul_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
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
                        </div>
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
    let select2Tahapan = $('#select2Tahapan');
    let select2Pengusul = $('#select2Pengusul');
    let select2KategoriRanperda = $('#select2Kategoriranperda');
    CKEDITOR.replace('my-editor');

    select2KategoriRanperda.select2({
        dropdownParent: select2KategoriRanperda.parent(),
        searchInputPlaceholder: 'Cari Kategori Ranpperda',
        allowClear: true,
        width: '100%',
        placeholder: 'select Kategori Ranperda',
        ajax: {
          url: "{{ route('backend.kategoriranperda.select2') }}",
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



    select2Tahapan.select2({
        dropdownParent: select2Tahapan.parent(),
        searchInputPlaceholder: 'Cari Tahapan',
        allowClear: true,
        width: '100%',
        placeholder: 'select tahapan',
        ajax: {
          url: "{{ route('backend.tahapanlegislasi.select2') }}",
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

      select2Pengusul.select2({
        dropdownParent: select2Pengusul.parent(),
        searchInputPlaceholder: 'Cari Pengusul',
        allowClear: true,
        width: '100%',
        placeholder: 'select Pengusul',
        ajax: {
          url: "{{ route('backend.pengusul.select2') }}",
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

      $("#formStore").submit(function (e) {
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
