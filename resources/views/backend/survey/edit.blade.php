@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row row-sm">
            <div class="col-12">
                    <div class="card-body">
                      <div>
                        <h6 class="main-content-label mb-1">{{ $config['page_title'] ?? '' }}</h6>
                      </div><br>
                      <div id="errorEdit" class="mb-3" style="display:none;">
                        <div class="alert alert-danger" role="alert">
                          <div class="alert-text">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                            <form id="formUpdate" action="{{ route('backend.survey.update', Request::segment(3)) }}">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                @method('PUT')
                              <div class="d-flex flex-column">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="select2kategorisurvey">Kategori Survey<span class="text-danger">*</span></label>
                                            <select id="select2kategorisurvey" style="width: 100% !important;" name="kategorisurvey_id">
                                                <option value="{{ $data['kategori']['id'] }}">{{ $data['kategori']['name'] }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Judul Survey<span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name"  class="form-control" placeholder="Masukan Judul Survey"  value="{{ $data['survey']['name'] ?? '' }}"/>
                                          </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                          <label for="desc" class="form-label">Deskripsi</label>
                                          <textarea name="deskripsi" class="my-editor form-control" id="my-editor" cols="30" rows="10">{{ $data['survey']['deskripsi'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary me-2" onclick="window.history.back();">
                                          Cancel
                                        </button>
                                        <button type="submit" class="btn ripple btn-main-primary">Submit</button>
                                    </div>
                                </form>
                                </div>
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    {{-- <h5 class="card-title mb-3">Transaction</h5> --}}
                                </div>
                                <div class="flex-shrink-0">
                                    <a class="btn btn-primary " href="{{ route('backend.question.create', ['survey_id'=> Request::segment(3), 'kategorisurvey_id' => $data['kategori']['id']]) }}">
                                        Tambah Agenda
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsove">
                                <label for="desc" class="form-label">Tabel Pertanyaan</label>
                                  <table id="Datatable" class="table table-bordered border-bottom w-100" style="width:100%">
                                    <thead>
                                          <tr>
                                            <th width="5%">No</th>
                                            <th>Pertanyaan</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                      </div>

                    </div>
                    <div class="card-footer">

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
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
$(document).ready(function () {
    let select2kategorisurvey = $('#select2kategorisurvey');
    CKEDITOR.replace('my-editor');

    let dataTable = $('#Datatable').DataTable({
        responsive: true,
        scrollX: false,
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pageLength: 10,
        ajax: {
          url: "{{ route('backend.question.index') }}",
          data: function (d) {
            d.survey_id = {{ Request::segment(3)}};
          }
        },

        columns: [
          {
                data: "id", name:'id',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
          },
          {data: 'question', name: 'question'},
        ],
        columnDefs: [
        // { visible: false, targets: groupColumn }
        ],
      });

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
