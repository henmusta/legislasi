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

                </div>

            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary bg-gradient">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="eva eva-pie-chart-2 fill-white"><g data-name="Layer 2"><g data-name="pie-chart-2"><rect width="24" height="24" opacity="0"></rect><path d="M14.5 10.33h6.67A.83.83 0 0 0 22 9.5 7.5 7.5 0 0 0 14.5 2a.83.83 0 0 0-.83.83V9.5a.83.83 0 0 0 .83.83zm.83-6.6a5.83 5.83 0 0 1 4.94 4.94h-4.94z"></path><path d="M21.08 12h-8.15a.91.91 0 0 1-.91-.91V2.92A.92.92 0 0 0 11 2a10 10 0 1 0 11 11 .92.92 0 0 0-.92-1z"></path></g></g></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Legislasi</p>
                                        <h4 class="mb-0" id="total-legislasi"></h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-end ms-2">
                                        {{-- <div class="badge rounded-pill font-size-13 badge-soft-success">+ 2.65%
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary bg-gradient">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="eva eva-pie-chart-2 fill-white"><g data-name="Layer 2"><g data-name="pie-chart-2"><rect width="24" height="24" opacity="0"></rect><path d="M14.5 10.33h6.67A.83.83 0 0 0 22 9.5 7.5 7.5 0 0 0 14.5 2a.83.83 0 0 0-.83.83V9.5a.83.83 0 0 0 .83.83zm.83-6.6a5.83 5.83 0 0 1 4.94 4.94h-4.94z"></path><path d="M21.08 12h-8.15a.91.91 0 0 1-.91-.91V2.92A.92.92 0 0 0 11 2a10 10 0 1 0 11 11 .92.92 0 0 0-.92-1z"></path></g></g></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Agenda</p>
                                        <h4 class="mb-0" id="total-agenda"></h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-end ms-2">
                                        {{-- <div class="badge rounded-pill font-size-13 badge-soft-success">+ 2.65%
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary bg-gradient">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="eva eva-pie-chart-2 fill-white"><g data-name="Layer 2"><g data-name="pie-chart-2"><rect width="24" height="24" opacity="0"></rect><path d="M14.5 10.33h6.67A.83.83 0 0 0 22 9.5 7.5 7.5 0 0 0 14.5 2a.83.83 0 0 0-.83.83V9.5a.83.83 0 0 0 .83.83zm.83-6.6a5.83 5.83 0 0 1 4.94 4.94h-4.94z"></path><path d="M21.08 12h-8.15a.91.91 0 0 1-.91-.91V2.92A.92.92 0 0 0 11 2a10 10 0 1 0 11 11 .92.92 0 0 0-.92-1z"></path></g></g></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Aspirasi</p>
                                        <h4 class="mb-0" id="total-aspirasi"></h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-end ms-2">
                                        {{-- <div class="badge rounded-pill font-size-13 badge-soft-success">+ 2.65%
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>


                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary bg-gradient">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="eva eva-pie-chart-2 fill-white"><g data-name="Layer 2"><g data-name="pie-chart-2"><rect width="24" height="24" opacity="0"></rect><path d="M14.5 10.33h6.67A.83.83 0 0 0 22 9.5 7.5 7.5 0 0 0 14.5 2a.83.83 0 0 0-.83.83V9.5a.83.83 0 0 0 .83.83zm.83-6.6a5.83 5.83 0 0 1 4.94 4.94h-4.94z"></path><path d="M21.08 12h-8.15a.91.91 0 0 1-.91-.91V2.92A.92.92 0 0 0 11 2a10 10 0 1 0 11 11 .92.92 0 0 0-.92-1z"></path></g></g></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Survey</p>
                                        <h4 class="mb-0" id="total-survey"></h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-end ms-2">
                                        {{-- <div class="badge rounded-pill font-size-13 badge-soft-success">+ 2.65%
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary bg-gradient">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="eva eva-pie-chart-2 fill-white"><g data-name="Layer 2"><g data-name="pie-chart-2"><rect width="24" height="24" opacity="0"></rect><path d="M14.5 10.33h6.67A.83.83 0 0 0 22 9.5 7.5 7.5 0 0 0 14.5 2a.83.83 0 0 0-.83.83V9.5a.83.83 0 0 0 .83.83zm.83-6.6a5.83 5.83 0 0 1 4.94 4.94h-4.94z"></path><path d="M21.08 12h-8.15a.91.91 0 0 1-.91-.91V2.92A.92.92 0 0 0 11 2a10 10 0 1 0 11 11 .92.92 0 0 0-.92-1z"></path></g></g></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Partisipan Survey</p>
                                        <h4 class="mb-0" id="total-partisipan"></h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-end ms-2">
                                        {{-- <div class="badge rounded-pill font-size-13 badge-soft-success">+ 2.65%
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>


                </div>


            </div>
        </div>

        <div class="card">
            <div class="card-header mb-3">
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


               </div>

            </div>
            <div class="card-body">

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
                <div class="row">
                    <div class="col-sm-12" style="text-align: right">
                        <button style="margin: 20px" class="btn-primary" onclick="PrintChart('ChartAreaAspirasi')">Print Chart</button>
                        <div class="chartjs-wrapper-demo">
                         <canvas id="ChartAreaAspirasi"></canvas>
                       </div>
                     </div>
                </div>

                <div class="row">
                    <div class="col-sm-12" style="text-align: right">
                        <button style="margin: 20px" class="btn-primary" onclick="PrintChart('ChartAreaSurvey')">Print Chart</button>
                        <div class="chartjs-wrapper-demo">
                         <canvas id="ChartAreaSurvey"></canvas>
                       </div>
                     </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container-fluid -->
</div>
@endsection

@section('css')

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
        var url = "dashboard/countdashboard?" + params.toString();
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
            $('#total-legislasi').html(data.data.legislasi);
            $('#total-agenda').html(data.data.agenda);
            $('#total-aspirasi').html(data.data.aspirasi);
            $('#total-survey').html(data.data.survey);
            $('#total-partisipan').html(data.data.partisipan);

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
                            text: 'Chart Total Partisan Yang Melakukan Survey Perbulan'
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
