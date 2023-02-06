@extends('backend.layouts.master')

@section('title') {{ $config['page_title'] }} @endsection

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
                        <a class="btn btn-primary " href="{{ route('backend.agenda.create') }}">
                            Tambah
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsove">
                    <table id="Datatable" class="table table-bordered border-bottom w-100" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th width="5%">No</th> --}}
                                <th>Ranperda</th>
                                <th>Agenda</th>
                                <th>Deskripsi</th>
                                <th>Tahapan</th>
                                <th>Aksi</th>
                              </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>
 {{--Modal--}}

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
<style>

tr.group,
tr.group:hover {
    background-color: #ddd !important;
}
</style>
@endsection
@section('script')
<script src="https://cdn.datatables.net/rowgroup/1.0.2/js/dataTables.rowGroup.min.js"></script>

  <script>

     $(document).ready(function () {

      let modalDelete = document.getElementById('modalDelete');
      const bsDelete = new bootstrap.Modal(modalDelete);
      var collapsedGroups = {};
      let dataTable = $('#Datatable').DataTable({
        responsive: true,
        scrollX: false,
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pageLength: 10,
        ajax: {
          url: "{{ route('backend.agenda.index') }}",
          data: function (d) {
            // d.status = $('#Select2Status').find(':selected').val();
          }
        },

        columns: [
        //   {
        //         data: "id", name:'id',
        //         render: function (data, type, row, meta) {
        //             return meta.row + meta.settings._iDisplayStart + 1;
        //         }
        //   },
          {data: 'legislasi.judul', name: 'legislasi.judul'},
          {data: 'judul', name: 'judul'},
          {data: 'deskripsi', name: 'deskripsi'},
          {data: 'tahapan.name', name: 'tahapan.name'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        rowGroup: {
      // Uses the 'row group' plugin
            dataSrc: 'legislasi.judul',
            startRender: function(rows, group) {
                var collapsed = !!collapsedGroups[group];

                rows.nodes().each(function(r) {
                    r.style.display = 'none';
                    if (collapsed) {
                        r.style.display = '';
                    }
                })

                // Add category name to the <tr>. NOTE: Hardcoded colspan
                return $('<tr/>')
                .append('<td colspan="5">' + group + ' (' + rows.count() + ')</td>')
                .attr('data-name', group)
                .toggleClass('collapsed', collapsed);
            }
         }
      })
      $('#Datatable tbody').on('click', 'tr.group-start', function() {
        var judul = $(this).data('name');
        collapsedGroups[judul] = !collapsedGroups[judul];
        dataTable.draw(false);
      });
    //    $('#Datatable tbody').on('click', 'tr.tr-collapse', function() {

	//     });


      modalDelete.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        this.querySelector('.urlDelete').setAttribute('href', '{{ route("backend.agenda.index") }}/' + id);
      });
      modalDelete.addEventListener('hidden.bs.modal', function (event) {
        this.querySelector('.urlDelete').setAttribute('href', '');
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
