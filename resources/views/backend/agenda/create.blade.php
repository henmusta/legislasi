@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
      <div class="card">
        <div class="row row-sm">
            <div class="col-12">
                <form id="formStore" action="{{ route('backend.agenda.store') }}">
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
                                    <input type="hidden" name="cek" value="{{ $data['legislasi']['id'] ?? ''}}">
                                    <input type="hidden" id="legislasi_id" value="{{ $data['legislasi']['id'] ?? ''}}">
                                    <input type="hidden" id="legislasi_judul" value="{{ $data['legislasi']['judul'] ?? ''}}">
                                    <input type="hidden" id="tahapan_id" value="{{ $data['tahapan']['id'] ?? ''}}">
                                    <input type="hidden" id="tahapan_name" value="{{ $data['tahapan']['name'] ?? ''}}">
                                    <label for="select2Ranperda">Ranperda<span class="text-danger">*</span></label>
                                    <select id="select2Ranperda" style="width: 100% !important;" name="legislasi_id">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="select2Tahapan">Tahapan<span class="text-danger">*</span></label>
                                    <select id="select2Tahapan" style="width: 100% !important;" name="tahapan_id">
                                    </select>
                                </div>
                                {{-- <div class="mb-3">

                                  </div> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label>Judul Agenda<span class="text-danger">*</span></label>
                                        <input type="text" id="judul" name="judul"  class="form-control" placeholder="Masukan Judul Agenda"/>
                                      </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Deskripsi<span class="text-danger">*</span></label>
                                    <textarea rows="5" id="deskripsi" autocomplete="off" class="form-control" name="deskripsi" placeholder="Masukan Deskripsi Agenda"></textarea>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                             <label >Maximum Upload 2MB<span class="text-danger">*</span></label>
                               <table id="Datatable" style="border:none;" width="100%">
                                 <thead>
                                       <tr>
                                         <th>Lampiran</th>
                                         <th>Keterangan</th>
                                         <th>Aksi</th>
                                       </tr>
                                 </thead>
                                 <tfoot>
                                     <tr>
                                         <th></th>
                                         <th></th>
                                         <th>
                                             <div class="btn-group">
                                                 <button type="button" class="btn btn-sm btn-outline-secondary btn-add-row"><i class="fa fa-plus"></i></button>
                                             </div>
                                         </th>
                                     </tr>
                                 </tfoot><br>
                             </table>
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
    let select2Tahapan = $('#select2Tahapan');
    let select2Ranperda = $('#select2Ranperda');
    var legislasi_id = $('#legislasi_id').val();
    var legislasi_judul = $('#legislasi_judul').val();
    var tahapan_id = $('#tahapan_id').val();
    var tahapan_name = $('#tahapan_name').val();
    select2Tahapan.select2({
        dropdownParent: select2Tahapan.parent(),
        searchInputPlaceholder: 'Cari Tahapan',
        width: '100%',
        placeholder: 'select tahapan'
      });
    if(legislasi_id != '' || tahapan_id != ''){
        select2Ranperda.select2({
            dropdownParent: select2Ranperda.parent(),
            searchInputPlaceholder: 'Cari Ranperda',
            width: '100%',
            placeholder: 'select legislasi',
        });
        let optionListLegislasi = new Option(legislasi_judul, legislasi_id, false, false);
        select2Ranperda.append(optionListLegislasi).trigger('change');
        let optionListTahapan = new Option(tahapan_name, tahapan_id, false, false);
        select2Tahapan.append(optionListTahapan).trigger('change');
    }else{
      select2Ranperda.select2({
        dropdownParent: select2Ranperda.parent(),
        searchInputPlaceholder: 'Cari Ranperda',
        allowClear: true,
        width: '100%',
        placeholder: 'select legislasi',
        ajax: {
          url: "{{ route('backend.legislasi.select2') }}",
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
            let optionListTahapan = new Option( data.name, data.tahapan_id, false, false);
            select2Tahapan.append(optionListTahapan).trigger('change');
      });
    }



        var dummy = [
            // { name : '', keterangan : '' }
        ]


      const tableFile = $('#Datatable').DataTable({
			paging		: false,
			searching 	: false,
			ordering 	: false,
			info 		: false,
			data 		: dummy ,
			columns : [

				{
					data 		: 'name',
					className 	: 'text-left',
					width 		: '150px',
					render 		: function ( columnData, type, rowData, meta ) {
						return String(`
							<input accept="application/pdf" type="file" id="fl_lampiran` + meta.row + `" class="form-control text-left" value="`+ columnData +`" name="file[`+ meta.row +`][lampiran]" data-column="lampiran" required>
						`).trim();
					}
				},
				{
					data 		: 'keterangan',
					className 	: 'text-right',
					width 		: '150px',
					render 		: function ( columnData, type, rowData, meta ) {
						return String(`
							<input id="fl_keterangan` + meta.row + `" class="form-control text-right" value="`+ columnData +`" name="file[`+ meta.row +`][keterangan]" required data-column="keterangan" >
						`).trim();
					}
				},

				{
					data 		: 'id',
					width 		: '50px',
					className 	: 'text-center',
					render 		: function ( columnData, type, rowData, meta ) {
						return String(`
							<button type="button" id="id_` + meta.row + `" class="btn btn-sm btn-outline-secondary btn-delete-row"><i class="fa fa-minus"></i></button>
						`).trim();
					}
				}
			],
			initComplete : function(settings, json){
				let api = this.api();
				$(api.table().footer()).find('.btn-add-row').click(function(){
					api.row.add({ name : '', keterangan : '' }).draw();
				});
			},
			createdRow : function( row, data, index ){

			},
			rowCallback : function( row, data, displayNum, displayIndex, index ){
				let api = this.api();

				$(row).find('#id_'+ index).click(function(){
					api.row($(this).closest("tr").get(0)).remove().draw();
				});
			},
			drawCallback : function( settings ){

			}
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
