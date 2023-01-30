@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row row-sm">
            <div class="col-12">
                <form id="formStore" action="{{ route('backend.question.store') }}">
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
                                    <input type="hidden" name="cek" value="{{ $data['survey']['id'] ?? ''}}">
                                    <input type="hidden" id="kategori_id" value="{{ $data['kategori']['id'] ?? ''}}">
                                    <input type="hidden" id="kategori_name" value="{{ $data['kategori']['name'] ?? ''}}">
                                    <input type="hidden" id="survey_id" value="{{ $data['survey']['id'] ?? ''}}">
                                    <input type="hidden" id="survey_name" value="{{ $data['survey']['name'] ?? ''}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="select2kategorisurvey">Kategori Survey<span class="text-danger">*</span></label>
                                    <select id="select2kategorisurvey" style="width: 100% !important;" name="kategorisurvey_id">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="select2survey">Survey<span class="text-danger">*</span></label>
                                    <select id="select2survey" style="width: 100% !important;" name="survey_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Pertanyaan<span class="text-danger">*</span></label>
                                    <textarea name="question" class="my-editor form-control" id="question" cols="30" rows="10"></textarea>
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
                                                <th>A</th>
                                                <th><input type="text" id="a" name="a"  class="form-control" placeholder="Masukan Jawaban Opsi A"/></th>
                                              </tr>
                                              <tr>
                                                <th>B</th>
                                                <th><input type="text" id="b" name="b"  class="form-control" placeholder="Masukan Jawaban Opsi B"/></th>
                                              </tr>
                                              <tr>
                                                <th>C</th>
                                                <th><input type="text" id="c" name="c"  class="form-control" placeholder="Masukan Jawaban Opsi C"/></th>
                                              </tr>
                                              <tr>
                                                <th>D</th>
                                                <th><input type="text" id="d" name="d"  class="form-control" placeholder="Masukan Jawaban Opsi D"/></th>
                                              </tr>
                                              <tr>
                                                <th>E</th>
                                                <th><input type="text" id="e" name="e"  class="form-control" placeholder="Masukan Jawaban Opsi E"/></th>
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

    var kategori_id = $('#kategori_id').val();
    var kategori_name = $('#kategori_name').val();
    var survey_id = $('#survey_id').val();
    var survey_name = $('#survey_name').val();

    if(kategori_id != '' || survey_id != ''){
        select2kategorisurvey.select2({
            dropdownParent: select2kategorisurvey.parent(),
            searchInputPlaceholder: 'Cari Kategori Survey',
            width: '100%',
            placeholder: 'select Kategori Survey',
        });
        select2survey.select2({
            dropdownParent: select2survey.parent(),
            searchInputPlaceholder: 'Cari Survey',
            width: '100%',
            placeholder: 'select  Survey',
        });
        let optionListKategori = new Option(kategori_name, kategori_id, false, false);
        select2kategorisurvey.append(optionListKategori).trigger('change');
        let optionListSurvey = new Option(survey_name, survey_id, false, false);
        select2survey.append(optionListSurvey).trigger('change');
    }else{

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
            console.log(data.id);
      });


    //   select2Ranperda.select2({
    //     dropdownParent: select2Ranperda.parent(),
    //     searchInputPlaceholder: 'Cari Ranperda',
    //     allowClear: true,
    //     width: '100%',
    //     placeholder: 'select legislasi',
    //     ajax: {
    //       url: "{{ route('backend.legislasi.select2') }}",
    //       dataType: "json",
    //       cache: true,
    //       data: function (e) {
    //         return {
    //           q: e.term || '',
    //           page: e.page || 1
    //         }
    //       },
    //     },
    //   }).on('select2:select', function (e) {
    //         let data = e.params.data;
    //         console.log(data.id);
    //         let optionListTahapan = new Option( data.name, data.tahapan_id, false, false);
    //         select2Tahapan.append(optionListTahapan).trigger('change');
    //   });
    }






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
