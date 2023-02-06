@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row row-sm">
            <div class="col-12">
                <form id="formUpdate" action="{{ route('backend.question.update', Request::segment(3)) }}">
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
                                    {{-- <input type="hidden" name="cek" value="{{ $data['survey']['id'] ?? ''}}">
                                    <input type="hidden" id="kategori_id" value="{{ $data['kategori']['id'] ?? ''}}">
                                    <input type="hidden" id="kategori_name" value="{{ $data['kategori']['name'] ?? ''}}">
                                    <input type="hidden" id="survey_id" value="{{ $data['survey']['id'] ?? ''}}">
                                    <input type="hidden" id="survey_name" value="{{ $data['survey']['name'] ?? ''}}"> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="select2survey">Survey<span class="text-danger">*</span></label>
                                    <select id="select2survey" style="width: 100% !important;" name="survey_id">
                                        <option value="{{ $data['question']['survey']['id'] }}">{{ $data['question']['survey']['name'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="select2kategorisurvey">Kategori Survey<span class="text-danger">*</span></label>
                                    <select id="select2kategorisurvey" style="width: 100% !important;" name="kategorisurvey_id">
                                        <option value="{{ $data['question']['kategorisurvey']['id'] }}">{{ $data['question']['kategorisurvey']['name'] }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Pertanyaan<span class="text-danger">*</span></label>
                                    <textarea name="question" class="my-editor form-control" id="question" cols="30" rows="10">{{ $data['question']['question'] }}</textarea>
                                  </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsove">
                                    <label for="desc" class="form-label">Pilihan Jawaban</label>
                                      <table id="Datatable" class="table table-bordered border-bottom w-100" style="width:100%">
                                        <thead>
                                              <tr>
                                                <th width="5%">Opsi</th>
                                                <th>Jawaban</th>
                                              </tr>
                                        </thead>
                                        <tbody>
                                              <tr>
                                                <th width="2%"><input type="text" id="a" name="params[0][answer]"  class="form-control" value="a"/><input type="text" name="params[0][id]" hidden value="{{ $data['questiondetail']['a']['id'] ?? '' }}"/></th>
                                                <th><input type="text" id="a" name="params[0][deskripsi]"  class="form-control" value="{{ $data['questiondetail']['a']['deskripsi'] ?? '' }}" placeholder="Masukan Jawaban Opsi A"/></th>
                                              </tr>
                                              <tr>
                                                <th width="2%"><input type="text" id="b" name="params[1][answer]"  class="form-control" value="b"/><input type="text" name="params[1][id]" hidden value="{{ $data['questiondetail']['b']['id'] ?? '' }}"/></th>
                                                <th><input type="text" id="b" name="params[1][deskripsi]"  class="form-control" value="{{ $data['questiondetail']['b']['deskripsi'] ?? '' }}" placeholder="Masukan Jawaban Opsi B"/></th>
                                              </tr>
                                              <tr>
                                                <th width="2%"><input type="text" id="c" name="params[2][answer]"  class="form-control" value="c"/><input type="text" name="params[2][id]" hidden value="{{ $data['questiondetail']['c']['id'] ?? '' }}"/></th>
                                                <th><input type="text" id="c" name="params[2][deskripsi]"  class="form-control" value="{{ $data['questiondetail']['c']['deskripsi'] ?? '' }}" placeholder="Masukan Jawaban Opsi C"/></th>
                                              </tr>
                                              <tr>
                                                <th width="2%"><input type="text" id="d" name="params[3][answer]"  class="form-control" value="d"/><input type="text" name="params[3][id]" hidden value="{{ $data['questiondetail']['d']['id'] ?? '' }}"/></th>
                                                <th><input type="text" id="d" name="params[3][deskripsi]"  class="form-control" value="{{ $data['questiondetail']['d']['deskripsi'] ?? '' }}" placeholder="Masukan Jawaban Opsi D"/></th>
                                              </tr>
                                              <tr>
                                                <th width="2%"><input type="text" id="e" name="params[4][answer]"  class="form-control" value="e"/><input type="text" name="params[4][id]" hidden value="{{ $data['questiondetail']['e']['id'] ?? '' }}"/></th>
                                                <th><input type="text" id="e" name="params[4][deskripsi]"  class="form-control" value="{{ $data['questiondetail']['e']['deskripsi'] ?? '' }}" placeholder="Masukan Jawaban Opsi E"/></th>
                                              </tr>
                                        </tbody>
                                    </table>
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
    let select2kategorisurvey = $('#select2kategorisurvey');
    let select2survey = $('#select2survey');




    CKEDITOR.replace('question');

    // var kategori_id = $('#kategori_id').val();
    // var kategori_name = $('#kategori_name').val();
    // var survey_id = $('#survey_id').val();
    // var survey_name = $('#survey_name').val();

    select2kategorisurvey.select2({
        dropdownParent: select2kategorisurvey.parent(),
        searchInputPlaceholder: 'Cari Kategori Survey',
        allowClear: true,
        width: '100%',
        placeholder: 'select Kategori Survey'
      }).on('select2:select', function (e) {
            let data = e.params.data;
            console.log(data.id);
      });

      select2survey.select2({
        dropdownParent: select2survey.parent(),
        searchInputPlaceholder: 'Cari Survey',
        allowClear: true,
        width: '100%',
        placeholder: 'select  Survey',
        ajax: {
          url: "{{ route('backend.survey.select2') }}",
          dataType: "json",
          cache: true,
          data: function (e) {
            return {
              kategorisurvey_id: $('#select2kategorisurvey').find(':selected').val() || '',
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;
            let optionListKategori = new Option(data.name_kategori, data.id_kategori, false, false);
            select2kategorisurvey.append(optionListKategori).trigger('change');
      });

    // if(kategori_id != '' || survey_id != ''){
    //     select2kategorisurvey.select2({
    //         dropdownParent: select2kategorisurvey.parent(),
    //         searchInputPlaceholder: 'Cari Kategori Survey',
    //         width: '100%',
    //         placeholder: 'select Kategori Survey',
    //     });
    //     select2survey.select2({
    //         dropdownParent: select2survey.parent(),
    //         searchInputPlaceholder: 'Cari Survey',
    //         width: '100%',
    //         placeholder: 'select  Survey',
    //     });
    //     let optionListKategori = new Option(kategori_name, kategori_id, false, false);
    //     select2kategorisurvey.append(optionListKategori).trigger('change');
    //     let optionListSurvey = new Option(survey_name, survey_id, false, false);
    //     select2survey.append(optionListSurvey).trigger('change');
    // }else{
    // }






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
