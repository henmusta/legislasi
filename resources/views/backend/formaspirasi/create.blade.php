@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row row-sm">
            <div class="col-12">
                <form id="formStore" action="{{ route('backend.formaspirasi.store') }}">
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
                             <div class="col-md-6">
                                  <div class="mb-3">
                                    <div class="mb-3">
                                        <label>Id Form<span class="text-danger">*</span></label>
                                        <input type="text" id="id_form" name="id_form"  class="form-control" placeholder="Masukan id form"/>
                                      </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label>Name Form<span class="text-danger">*</span></label>
                                        <input type="text" id="name_form" name="name_form"  class="form-control" placeholder="Masukan Name Form"/>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-md-6">
                                  <div class="mb-3">
                                    <div class="mb-3">
                                        <label>Placeholder Form<span class="text-danger">*</span></label>
                                        <input type="text" id="placeholder_form" name="placeholder_form"  class="form-control" placeholder="Masukan placeholder form"/>
                                      </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                  <div class="mb-3">
                                    <div class="mb-3">
                                        <label>Urutan<span class="text-danger">*</span></label>
                                        <input type="number" id="sort" name="sort"  class="form-control" placeholder="Masukan urutan form"/>
                                      </div>
                                </div>
                            </div>
                         
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="select2Html">Html Form<span class="text-danger">*</span></label>
                                    <select id="select2Html" style="width: 100% !important;" name="html_form">
                                        <option value="input">Input</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="select">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="select2Type">Type Form<span class="text-danger">*</span></label>
                                    <select id="select2Type" style="width: 100% !important;" name="type_form">
                                        <option value="text">Text</option>
                                        <option value="file">File</option>
                                        <option value="number">Number</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="select2Status">Status<span class="text-danger">*</span></label>
                                    <select id="select2Status" style="width: 100% !important;" name="status">
                                      <option value="1">Active</option>
                                      <option value="0">Inactive</option>
                                    </select>
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

<script>
$(document).ready(function () {
    let select2Html = $('#select2Html');
    let select2Type = $('#select2Type');
    let select2Status = $('#select2Status');
       select2Html.select2({
        dropdownParent: select2Html.parent(),
        searchInputPlaceholder: 'Cari Html',
        width: '100%',
        placeholder: 'select Html'
      });

      select2Type.select2({
        dropdownParent: select2Type.parent(),
        searchInputPlaceholder: 'Cari type',
        width: '100%',
        placeholder: 'select Html'
      });


      select2Status.select2({
        dropdownParent: select2Status.parent(),
        searchInputPlaceholder: 'Cari type',
        width: '100%',
        placeholder: 'select Html'
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
                window.history.back();
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
