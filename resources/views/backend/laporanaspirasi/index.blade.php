@extends('backend.layouts.master')

@section('title') {{ $config['page_title'] }} @endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header mb-3">
                <h5 class="card-title mb-3">Table {{ $config['page_title'] }}</h5>
                <div class="row">

                    <div class="col-sm-3">
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
                    <div class="col-md-3">
                       <div class="mb-3">
                           <label for="select2Dewan">Dewan<span class="text-danger">*</span></label>
                           <select id="select2Dewan" style="width: 100% !important;" name="dewan_id">
                           </select>
                       </div>
                   </div>
                   <div class="col-md-3">
                    <div class="mb-3">
                        <label for="select2Skpd">Skpd<span class="text-danger">*</span></label>
                        <select id="select2Skpd" style="width: 100% !important;" name="skpd_id">
                        </select>
                    </div>
                     </div>
                    <div class="col-sm-3">
                       <div id="print" style="float:right; padding-top:25px;">
                       </div>
                    </div>

               </div>
            </div>
            <div class="card-body">
                <div class="table-responsove">
                    <table id="Datatable" class="table table-bordered border-bottom w-100" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nik</th>
                                <th>Name</th>
                                <th>Aspirasi</th>
                                <th>Kecamatan</th>
                                <th>Dewan</th>
                                <th>Skpd</th>
                                {{-- <th>Aksi</th> --}}
                              </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>


            </div>
            <div class="card">
                <div class="row">
                    <div class="col-sm-12" style="text-align: right">
                        <button style="margin: 20px" class="btn-primary" onclick="PrintChart()">Print Chart</button>
                        <div class="chartjs-wrapper-demo">
                         <canvas id="ChartAreaAspirasi"></canvas>
                       </div>
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


</style>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/jspdf@1.5.3/dist/jspdf.min.js"></script>
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
function PrintChart() {
    var canvas = document.querySelector("#ChartAreaAspirasi");
    var canvas_img = canvas.toDataURL("image/png",1.0); //JPEG will not match background color
    var pdf = new jsPDF('landscape','in', 'letter'); //orientation, units, page size
    pdf.addImage(canvas_img, 'png', .5, 1.75, 10, 5); //image, type, padding left, padding top, width, height
    pdf.autoPrint(); //print window automatically opened with pdf
    var blob = pdf.output("bloburl");
    window.open(blob);
}
     $(document).ready(function () {
        $('#tgl_awal').flatpickr({
            disableMobile: "true",
            plugins: [
                new monthSelectPlugin({
                shorthand: true,
                dateFormat: "Y-m",
                altFormat: "F Y",
                theme: "material_blue"
                })
            ]
         });
         $('#tgl_akhir').flatpickr({
            disableMobile: "true",
            plugins: [
                new monthSelectPlugin({
                shorthand: true,
                dateFormat: "Y-m",
                altFormat: "F Y",
                theme: "material_blue"
                })
            ]
         });
      let select2Skpd = $('#select2Skpd');
      let select2Dewan = $('#select2Dewan');
      select2Skpd.select2({
        dropdownParent: select2Skpd.parent(),
        searchInputPlaceholder: 'Cari Skpd',
        allowClear: true,
        width: '100%',
        placeholder: 'Pilih Skpd',
        ajax: {
          url: "{{ route('backend.skpd.select2') }}",
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
      });

      select2Dewan.select2({
        dropdownParent: select2Dewan.parent(),
        searchInputPlaceholder: 'Cari Dewan',
        allowClear: true,
        width: '100%',
        placeholder: 'Pilih Dewan',
        ajax: {
          url: "{{ route('backend.dewan.select2') }}",
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
      });
      let dataTable = $('#Datatable').DataTable({
        dom: 'lfBrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                footer: true,
                title: 'Laporan',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                },
            },
            {
                extend: 'excel',
                footer: true,
                title: 'Laporan',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },

        ],
        responsive: true,
        scrollX: false,
        processing: true,
        serverSide: true,
        order: [[1, 'desc']],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pageLength: 10,
        ajax: {
          url: "{{ route('backend.laporanaspirasi.index') }}",
          data: function (d) {
            d.tgl_awal = $('#tgl_awal').val();
            d.tgl_akhir = $('#tgl_akhir').val();
            d.spkd_id = $('#select2Skpd').find(':selected').val();
            d.dewan_id = $('#select2Dewan').find(':selected').val();
          }
        },

        columns: [
          {data: 'tgl_buat', name: 'tgl_buat'},
          {data: 'nik', name: 'nik'},
          {data: 'name', name: 'name'},
          {data: 'aspirasi', name: 'aspirasi'},
          {data: 'get_kecamatan.name', name: 'get_kecamatan.name'},
          {data: 'get_dewan.name', name: 'get_dewan.name'},
          {data: 'get_skpd.name', name: 'get_skpd.name'},
        //   {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [


        ],
      });


      dataTable.buttons().container().appendTo($('#print'));
      $('#tgl_awal, #tgl_akhir').on('change', function (e) {
         myChartAspirasi.destroy();
         counttotal();
      });

      $('#select2Skpd, #select2Dewan').on('change', function (e) {
        dataTable.draw();
      });
      counttotal();

    });
    function counttotal(){
        let params = new URLSearchParams({
                    tgl_awal : $('#tgl_awal').val() || '',
                    tgl_akhir : $('#tgl_akhir').val() || '',
        });
        var url = "laporanaspirasi/countaspirasi?" + params.toString();
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data.data.ChartAspirasiJson);
                let ctxAspirasi = document.getElementById("ChartAreaAspirasi");
                ctxAspirasi.height = 500;
                    myChartAspirasi =
                    new Chart(ctxAspirasi, {
                    type: "bar",
                    data: data.data.ChartAspirasiJson,
                    options: {
                        plugins: {
                            // datalabels: {
                            //     display: false,
                            // }
                        },
                        title: {
                            display: true,
                            text: 'Chart Total Aspirasi Per Bulan'
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
