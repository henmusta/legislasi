@extends('backend.layouts.master')

@section('title') {{ $config['page_title'] }} @endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card-header mb-3">
            <h5 class="card-title mb-3">{{ $config['page_title'] }}</h5>
            <div class="row">

                 <div class="col-sm-4">
                    <div class="mb-3">
                        <label>Filter Tanggal</label>
                        <div class=" input-group mb-3">
                            <input type="text" id="tgl_awal" class="form-control datePicker"
                                    placeholder="Tanggal Awal" value="{{ \Carbon\Carbon::now()->startOfYear()->format('Y-m-d') }}"
                                    readonly/>
                            <span class="input-group-text" id="basic-addon2">S/D</span>
                            <input type="text" id="tgl_akhir" class="form-control datePicker"
                                    placeholder="Tanggal Akhir" value="{{ \Carbon\Carbon::now()->lastOfYear()->format('Y-m-d') }}"
                                    readonly/>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="mb-3">
                        <label for="select2survey">Survey<span class="text-danger">*</span></label>
                        <select id="select2survey" style="width: 100% !important;" name="survey_id">
                        </select>
                    </div>
                </div>
                 <div class="col-sm-2">
                    <div id="print" style="float:right; padding-top:25px;">
                    </div>
                 </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header mb-3">
                <h5 class="card-title mb-3">Table {{ $config['page_title'] }}</h5>
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        {{-- <h5 class="card-title mb-3">Transaction</h5> --}}
                    </div>
                    <div class="flex-shrink-0">
                        {{-- <a class="btn btn-primary " href="{{ route('backend.survey.create') }}">
                            Tambah
                            <i class="fas fa-plus"></i>
                        </a> --}}
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsove">
                    <table id="Datatable" class="table table-bordered border-bottom w-100" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th width="5%">No</th>
                                <th>Judul Survey</th> --}}
                                <th>Survey</th>
                                <th>Question</th>
                                <th>Jawaban</th>
                                <th width="5%">Total</th>
                              </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
        <div class="card">
            <div class="row">
                <div class="col-sm-12">
                    <div class="chartjs-wrapper-demo">
                     <canvas id="ChartAreaSurvey"></canvas>
                   </div>
                 </div>
            </div>
        </div>
    </div>
</div>
 {{--Modal--}}


@endsection

@section('css')
<style>

tr.dtrg-level-0,
tr.dtrg-level-0:hover {
    background-color: #ddd !important;
}

tr.dtrg-level-1,
tr.dtrg-level-1:hover {
    background-color: rgb(203, 223, 207) !important;
}
</style>
@endsection
@section('script')
<script src="https://cdn.datatables.net/rowgroup/1.3.0/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script src="{{ asset('assets/backend/vendor_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor_components/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor_components/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor_components/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor_components/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/backend/vendor_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor_components/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
  <script>

     $(document).ready(function () {
        let select2survey = $('#select2survey');
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
              survey_id:$('#select2survey').find(':selected').val() || '',
              q: e.term || '',
              page: e.page || 1
            }
          },
        },
      }).on('select2:select', function (e) {
            let data = e.params.data;

      });
         $('#tgl_awal').flatpickr({
           dateFormat: "Y-m-d",
           allowInput: true,
         });
         $('#tgl_akhir').flatpickr({
           dateFormat: "Y-m-d",
           allowInput: true,
         });
         var collapsedGroups = {};
      let dataTable = $('#Datatable').DataTable({
        dom: 'lfBrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                footer: true,
                title: 'Laporan',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                },
                // customize : function(doc) {
                //     doc.styles['td:nth-child(2)'] = {
                //     width: '200px',
                //     'max-width': '200px'
                //     }
                // }
            },
            {
                extend: 'excel',
                footer: true,
                title: 'Laporan',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            },

        ],
        responsive: true,
        scrollX: false,
        processing: true,
        serverSide: true,
        order: [[0, 'desc'],[1, 'desc']],
        lengthMenu: [[50, -1], [50, "All"]],
        pageLength: 10,
        ajax: {
          url: "{{ route('backend.laporansurvey.index') }}",
          data: function (d) {
            d.survey_id = $('#select2survey').find(':selected').val();
          }
        },

        columns: [
        //  {
        //         data: "id", name:'id',
        //         render: function (data, type, row, meta) {
        //             return meta.row + meta.settings._iDisplayStart + 1;
        //         }
        //   },
          {data: 'survey_name', name: 'survey_name'},
          {data: 'pertanyaan', name: 'pertanyaan'},
          {data: 'deskripsi', name: 'deskripsi'},
          {data: 'cek', name: 'cek'},
        //   {data: 'answer', name: 'answer'},
        ],
        columnDefs: [ {
            targets: [ 0, 1 ],
            visible: false
        } ],
        rowGroup: {
            dataSrc: ['survey_name', 'pertanyaan'],
         }
      });

      $('#tgl_awal, #tgl_akhir, #select2survey').on('change', function (e) {
        dataTable.draw();
      });
    //   $('#Datatable tbody').on('click', 'tr.group-start', function() {
    //     var judul = $(this).data('name');
    //     collapsedGroups[judul] = !collapsedGroups[judul];
    //     dataTable.draw(false);
    //   });
      dataTable.buttons().container().appendTo($('#print'));
      $('#tgl_awal, #tgl_akhir').on('change', function (e) {
         myChartSurvey.destroy();
         counttotal();
      });


      counttotal();
    });

    function counttotal(){
        let params = new URLSearchParams({
                    tgl_awal : $('#tgl_awal').val() || '',
                    tgl_akhir : $('#tgl_akhir').val() || '',
        });
        var url = "laporansurvey/countsurvey?" + params.toString();
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data.data.ChartSurveyJson);

                let ctxSurvey = document.getElementById("ChartAreaSurvey");
                ctxSurvey.height = 500;
                    myChartSurvey =
                    new Chart(ctxSurvey, {
                    type: "bar",
                    data: data.data.ChartSurveyJson,
                    options: {
                        plugins: {
                            // datalabels: {
                            //     display: false,
                            // }
                        },
                        title: {
                            display: true,
                            text: 'Chart Survey'
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                        mode: 'nearest',
                          intersect: true
                        },
                        legend: {
                            labels: {
                                fontColor: "#77778e"
                            },
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    callback: function (value) { if (Number.isInteger(value)) { return value; } },
                                    stepSize: 1
                                }
                            }]
                        }
                    }
                });





            }
        });
    }
  </script>
@endsection
