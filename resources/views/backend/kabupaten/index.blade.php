@extends('backend.layouts.master')


@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header mb-3">
            <h5 class="card-title mb-3">Table {{ $config['page_title'] }}</h5>
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    {{-- <h5 class="card-title mb-3">Transaction</h5> --}}
                </div>
                <div class="flex-shrink-0">
                    <button class="btn btn-primary hstack gap-2 align-self-center" data-bs-toggle="modal"
                    data-bs-target="#modalCreate">
                        Tambah
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="Datatable" style="width:100%">
              <thead>
              <tr>
                <th>Provinsi</th>
                <th>Nama Kabupaten</th>
                <th>Aksi</th>
              </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{--Modal--}}
  <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalResetLabel">Tambah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formStore" method="POST" action="{{ route('backend.kabupaten.store') }}">
          @csrf
          <div class="modal-body">
            <div id="errorCreate" class="mb-3" style="display:none;">
              <div class="alert alert-danger" role="alert">
                <div class="alert-text">
                </div>
              </div>
            </div>
            <div class="mb-3">
                <label for="select2Provinsi">Pilih Provinsi <span class="text-danger">*</span></label>
                <select id="select2Provinsi" style="width: 100% !important;" name="provinsi_id">
                </select>
              </div>
            <div class="mb-3">
              <label>Nama Kabupaten <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" placeholder="Masukan nama Kabupaten"/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalmodalEdit" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit {{ $config['page_title'] }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formUpdate" action="#">
          @method('PUT')
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <div class="modal-body">
            <div id="errorEdit" class="mb-3" style="display:none;">
              <div class="alert alert-danger" role="alert">
                <div class="alert-text">
                </div>
              </div>
            </div>
            <div class="mb-3">
                <label for="select2Provinsi">Jenis <span class="text-danger">*</span></label>
                <select id="select2ProvinsiEdit" style="width: 100% !important;" name="provinsi_id">
                </select>
              </div>
            <div class="mb-3">
              <label>Nama Kabupaten <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" placeholder="Masukan nama role"/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDeleteLabel">Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @method('DELETE')
        <div class="modal-body">
          <a href="" class="urlDelete" type="hidden"></a>
          Apa anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button id="formDelete" type="button" class="btn btn-primary">Submit</button>
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


      let select2Provinsi = $('#select2Provinsi');
      let select2ProvinsiEdit = $('#select2ProvinsiEdit');

      let modalCreate = document.getElementById('modalCreate');
      const bsCreate = new bootstrap.Modal(modalCreate);
      let modalEdit = document.getElementById('modalEdit');
      const bsEdit = new bootstrap.Modal(modalEdit);
      let modalDelete = document.getElementById('modalDelete');
      const bsDelete = new bootstrap.Modal(modalDelete);
      let dataTable = $('#Datatable').DataTable({
        responsive: true,
        scrollX: false,
        processing: true,
        serverSide: true,
        order: [[1, 'asc']],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pageLength: 10,
        ajax: "{{ route('backend.kabupaten.index') }}",
        columns: [
          {data: 'provinsi.name', name: 'provinsi.name'},
          {data: 'name', name: 'name'},
          {data: 'action', class:'text-center', name: 'action', orderable: false, searchable: false},
        ],
      });
      select2Provinsi.select2({
        dropdownParent: select2Provinsi.parent(),
        searchInputPlaceholder: 'Cari Provinsi',
        allowClear: true,
        width: '100%',
        placeholder: 'select Provinsi',
        ajax: {
          url: "{{ route('backend.provinsi.select2') }}",
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


      select2ProvinsiEdit.select2({
        dropdownParent: select2ProvinsiEdit.parent(),
        searchInputPlaceholder: 'Cari Provinsi',
        allowClear: true,
        width: '100%',
        placeholder: 'select Provinsi',
        ajax: {
          url: "{{ route('backend.provinsi.select2') }}",
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

//   function dropmenuPostion() {
//     // hold onto the drop down menu
//     var dropdownMenu;

//     // and when you show it, move it to the body
//     $(window).on('show.bs.dropdown', function(e) {

//       // grab the menu
//       dropdownMenu = $(e.target).find('.dropdown-menu');

//       // detach it and append it to the body
//       $('body').append(dropdownMenu.detach());

//       // grab the new offset position
//       var eOffset = $(e.target).offset();

//       // make sure to place it where it would normally go (this could be improved)
//       dropdownMenu.css({
//         'display': 'block',
//         'top': eOffset.top + $(e.target).outerHeight(),
//         'left': eOffset.left - 50
//       });
//     });

//     // and when you hide it, reattach the drop down, and hide it normally
//     $(window).on('hide.bs.dropdown', function(e) {
//       $(e.target).append(dropdownMenu.detach());
//       dropdownMenu.hide();
//     });
//   }
      modalCreate.addEventListener('show.bs.modal', function (event) {
      });
      modalCreate.addEventListener('hidden.bs.modal', function (event) {
        this.querySelector('input[name=name]').value = '';
      });
      modalEdit.addEventListener('show.bs.modal', function (event) {
        let name = event.relatedTarget.getAttribute('data-bs-name');
        let list_provinsi_id = event.relatedTarget.getAttribute('data-bs-provinsi_id');
        let list_provinsi_name = event.relatedTarget.getAttribute('data-bs-provinsi_name');
        let optionListProvinsi = new Option( list_provinsi_name, list_provinsi_id, false, false);
        $(this).find('#select2ProvinsiEdit').append(optionListProvinsi).trigger('change');
        this.querySelector('input[name=name]').value = name;
        this.querySelector('#formUpdate').setAttribute('action', '{{ route("backend.kabupaten.index") }}/' + event.relatedTarget.getAttribute('data-bs-id'));
      });
      modalEdit.addEventListener('hidden.bs.modal', function (event) {
        $(this).find('#select2ProvinsiEdit').empty().trigger('change');
        this.querySelector('input[name=name]').value = '';
        this.querySelector('#formUpdate').setAttribute('href', '');
      });
      modalDelete.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        this.querySelector('.urlDelete').setAttribute('href', '{{ route("backend.kabupaten.index") }}/' + id);
      });
      modalDelete.addEventListener('hidden.bs.modal', function (event) {
        this.querySelector('.urlDelete').setAttribute('href', '');
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
              dataTable.draw();
              bsCreate.hide();
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
              dataTable.draw();
              bsEdit.hide();
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
      $("#formDelete").click(function (e) {
        e.preventDefault();
        let form = $(this);
        let url = modalDelete.querySelector('.urlDelete').getAttribute('href');
        let btnHtml = form.html();
        let spinner = $("<span aria-hidden='true' class='spinner-border spinner-border-sm' role='status'></span>");
        $.ajax({
          beforeSend: function () {
            form.text(' Loading. . .').prepend(spinner).prop("disabled", "disabled");
          },
          type: 'DELETE',
          url: url,
          dataType: 'json',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function (response) {
            toastr.success(response.message, 'Success !');
            form.text('Submit').html(btnHtml).removeAttr('disabled');
            dataTable.draw();
            bsDelete.hide();
          },
          error: function (response) {
            toastr.error(response.responseJSON.message, 'Failed !');
            form.text('Submit').html(btnHtml).removeAttr('disabled');
            bsDelete.hide();
          }
        });
      });

    });
  </script>
@endsection