@extends('backend.layouts.master')

@section('title') {{ $config['page_title'] }} @endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header mb-3">
                <h5 class="card-title mb-3">Table {{ $config['page_title'] }}</h5>
                <div class="row">

                    <div class="col-sm-4">
                       <div class="mb-3">
                           <label>Filter Tanggal</label>
                           <div class=" input-group mb-3">
                               <input type="text" id="tgl_awal" class="form-control datePicker"
                                       placeholder="Tanggal Awal" value="{{ \Carbon\Carbon::now()->startOfYear()->format('Y-m') }}"
                                       readonly/>
                               <span class="input-group-text" id="basic-addon2">S/D</span>
                               <input type="text" id="tgl_akhir" class="form-control datePicker"
                                       placeholder="Tanggal Akhir" value="{{ \Carbon\Carbon::now()->lastOfYear()->format('Y-m') }}"
                                       readonly/>
                           </div>
                       </div>
                    </div>
                    <div class="col-md-4">
                       <div class="mb-3">
                           <label for="select2Dewan">Ranperda<span class="text-danger">*</span></label>
                           <select id="select2Ranperda" style="width: 100% !important;" name="legislasi_id">
                             </select>
                       </div>
                   </div>
                   {{-- <div class="col-md-3">
                        <div class="mb-3">
                            <label for="select2Skpd">Skpd<span class="text-danger">*</span></label>
                            <select id="select2Skpd" style="width: 100% !important;" name="skpd_id">
                            </select>
                        </div>
                     </div> --}}
                    <div class="col-sm-4">
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
                                {{-- <th width="5%">No</th> --}}
                                <th>Ranperda</th>
                                <th>Agenda</th>
                                <th>Deskripsi</th>
                                <th>Tahapan</th>
                                {{-- <th>Aksi</th> --}}
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
                <div class="col-sm-8" style="text-align: right">
                    <button style="margin: 20px" class="btn-primary" onclick="PrintChart('ChartAreaLegislasi')">Print Chart</button>
                    <div class="chartjs-wrapper-demo">
                     <canvas id="ChartAreaLegislasi"></canvas>
                   </div>
                 </div>
                 <div class="col-sm-4" style="text-align: right">
                    <button style="margin: 20px" class="btn-primary" onclick="PrintChart('ChartTahapan')">Print Chart</button>
                    <div class="chartjs-wrapper-demo">
                     <canvas id="ChartTahapan"></canvas>
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
function PrintChart(id) {
    // id = 'ChartAreaSurvey';
    // var canvas = document.getElementById(id);
    // var win = window.open(canvas.toDataURL(), '_blank');
    var id_canvas = '#'+id;
    var canvas = document.querySelector(id_canvas);
    var canvas_img = canvas.toDataURL("image/png",1.0); //JPEG will not match background color
    var pdf = new jsPDF('landscape','in', 'letter'); //orientation, units, page size
    pdf.addImage(canvas_img, 'png', .5, 1.75, 10, 5); //image, type, padding left, padding top, width, height
    pdf.autoPrint(); //print window automatically opened with pdf
    var blob = pdf.output("bloburl");
    window.open(blob);

    // win.document.write("<br><img src='" + canvas.toDataURL() + "'/>");
    // setTimeout(function () {
    //     win.print();
    //     win.location.reload();
    // }, 500);

}
     $(document).ready(function () {
        let select2Ranperda = $('#select2Ranperda');
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
        order: [[0, 'desc']],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pageLength: 10,
        ajax: {
          url: "{{ route('backend.laporanlegislasi.index') }}",
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
        //   {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [ {
            targets: [ 0],
            visible: false
        } ],
        rowGroup: {
      // Uses the 'row group' plugin
            dataSrc: 'legislasi.judul',
            // startRender: function(rows, group) {
            //     var collapsed = !!collapsedGroups[group];

            //     rows.nodes().each(function(r) {
            //         r.style.display = 'none';
            //         if (collapsed) {
            //             r.style.display = '';
            //         }
            //     })

            //     // Add category name to the <tr>. NOTE: Hardcoded colspan
            //     return $('<tr/>')
            //     .append('<td colspan="5">' + group + ' (' + rows.count() + ')</td>')
            //     .attr('data-name', group)
            //     .toggleClass('collapsed', collapsed);
            // }
         }
      });
      dataTable.buttons().container().appendTo($('#print'));
    //   $('#Datatable tbody').on('click', 'tr.group-start', function() {
    //     var judul = $(this).data('name');
    //     collapsedGroups[judul] = !collapsedGroups[judul];
    //     dataTable.draw(false);
    //   });
    //    $('#Datatable tbody').on('click', 'tr.tr-collapse', function() {

	//     });


      $('#tgl_awal, #tgl_akhir').on('change', function (e) {
         myChartLegislasi.destroy();
         counttotal();
      });
      counttotal();



    });
    function counttotal(){
        let params = new URLSearchParams({
                    tgl_awal : $('#tgl_awal').val() || '',
                    tgl_akhir : $('#tgl_akhir').val() || '',
        });
        var url = "laporanlegislasi/countlegislasi?" + params.toString();
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let ctxLegislasi = document.getElementById("ChartAreaLegislasi");
                ctxLegislasi.height = 500;
                    myChartLegislasi =
                    new Chart(ctxLegislasi, {
                    type: "bar",
                    data: data.data.ChartLegislasiJson,
                    options: {
                        plugins: {
                            // datalabels: {
                            //     display: false,
                            // }
                        },
                        title: {
                            display: true,
                            text: 'Chart Total Legislasi Per Bulan'
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
                                fontColor: "black"
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

                let ctxPie = document.getElementById("ChartTahapan");
                    ctxPie.height = 300;
                        myChartPie =
                        new Chart(ctxPie, {
                        type: "pie",
                        data: data.data.ChartTahapanJson,
                        options: {
                            plugins: {
                                datalabels: {
                                    display: function(context) {
                                        return context.dataset.data[context.dataIndex] !== 0; // or >= 1 or ...
                                     },
                                     font: {
                                        weight: 'bold',
                                        size: 14,
                                      },
                                      color: 'black'
                                }
                              },
                            title: {
                                display: true,
                                text: 'Chart Total Per Tahapan',
                                fontColor: "black"
                            },
                            responsive: true,
                            maintainAspectRatio: false,

                            tooltips: {
                            mode: 'index',
                            //   intersect: false
                            },
                            hover: {
                            mode: 'nearest',
                              intersect: true
                            },
                            legend: {
                                    // display: false,
                                    position: 'bottom',
                                    labels: {
                                        // fontColor: "#fff"
                                    },
                                }
                        }
                    });





            }
        });
    }
  </script>
@endsection
