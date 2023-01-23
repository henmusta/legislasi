@extends('frontend.layouts.master')

@section('content')
        <!-- PAGE TITLE
        ================================================== -->
        <section class="page-title-section2 bg-img cover-background top-position1" data-overlay-dark="4" data-background="assets/frontend/img/bg/bg9.jpg">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h1>E-legislasi</h1>
                    </div>
                    <div class="col-md-12">
                        <ul class="ps-0">
                            <li><a href="home-default.html">Home</a></li>
                            <li><a href="#!">E-legislasi</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        <!-- TABLE
        ================================================== -->
        <section  class="bg-img" data-overlay-dark="0" data-background="{{ asset('assets/frontend/img/bg/bg6.jpg')}}" style="background-image: url({{ asset('assets/frontend/img/bg/bg6.jpg')}});">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="select2Pengusul">Pengusul<span class="text-danger">*</span></label>
                                            <select id="select2Pengusul" style="width: 100% !important;" name="pengusul_id">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="select2Tahapan">Tahapan<span class="text-danger">*</span></label>
                                            <select id="select2Tahapan" style="width: 100% !important;" name="tahapan_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped" id="Datatable">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="10%">Posisi</th>
                                                    <th width="35%">RUU</th>
                                                    <th width="25%">Pengusul</th>
                                                    <th width="25%">Tanggal Update</th>
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
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered" style="width:100%">
                                    {{-- <div class="timeline-badge"><i class="fas fa-check-double"></i></div> --}}
                                    <thead>
                                        <tr>
                                            <th width="75%" colspan="2">Posisi</th>
                                            <th width="25%">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['tahapan'] as $val)
                                            <tr>
                                                <th width="5%"><div class="timeline-badge {{$val->badge}}"><i class="{{$val->icon}}"></i></div></th>
                                                <th  width="85%">{{$val->name}}</th>
                                                <th style="text-align:center"  width="10%">{{$val->legislasi_count}}</th>
                                            </tr>
                                        @endforeach

                                        {{-- <tr>
                                            <th width="5%"><div class="timeline-badge warning"><i class="far fa-building"></i></div></th>
                                            <th width="85%">teset</th>
                                            <th style="text-align:center"  width="10%">2</th>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="ChartPaiTahapan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </section>




@endsection

@section('css')

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>
$(document).ready(function () {
    countlegislasi();
    function countlegislasi(){
        let params = new URLSearchParams({

          });
        var url = "e-legislasi/countlegislasi?" + params.toString();
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data.paijsontahapan);

                let ctxPie = document.getElementById("ChartPaiTahapan");
                    ctxPie.height = 300;
                        myChartPie =
                        new Chart(ctxPie, {
                        type: "pie",
                        data: data.paijsontahapan,
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
                                      color: '#fff'
                                }
                              },
                            title: {
                                display: true,
                                text: 'Chart Total Per Tahapan'
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
                                    display: true,
                                    position: 'bottom',
                                    labels: {
                                        fontColor: "#77778e"
                                    },
                                }
                        }
                    });
            }
        });
    }




    let select2Tahapan = $('#select2Tahapan');
    let select2Pengusul = $('#select2Pengusul');
    select2Tahapan.select2({
        dropdownParent: select2Tahapan.parent(),
        searchInputPlaceholder: 'Cari Tahapan',
        allowClear: true,
        width: '100%',
        placeholder: 'select tahapan',
        ajax: {
          url: "{{ route('backend.tahapanlegislasi.select2') }}",
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

      select2Pengusul.select2({
        dropdownParent: select2Pengusul.parent(),
        searchInputPlaceholder: 'Cari Pengusul',
        allowClear: true,
        width: '100%',
        placeholder: 'select tahapan',
        ajax: {
          url: "{{ route('backend.pengusul.select2') }}",
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

      let dataTable = $('#Datatable').DataTable({
        responsive: true,
        scrollX: false,
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        lengthMenu: [[50, -1], [ 50, "All"]],
        pageLength: 50,
        ajax: {
          url: "{{ route('e-legislasi.index') }}",
          data: function (d) {
            // d.status = $('#Select2Status').find(':selected').val();
          }
        },

        columns: [
          {  data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
          },
          {data: 'id', name: 'id',
            render: function (data, type,  row, meta) {
                console.log(row);
              return '<div class="timeline-badge '+row.tahapan.badge+'"><i class="'+row.tahapan.icon+'"></i></div>';
            },
          },
          {data: 'judul', name: 'judul',
            render: function (data, type,  row, meta) {
              return '<a href="e-legislasi/'+row.id+'">'+data+'</a>';
            },
          },
        //   {data: 'deskripsi', name: 'deskripsi'},
          {data: 'pengusul.name', name: 'pengusul.name'},
          {data: 'updated_date', name: 'updated_at'},
        //   {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
          {
            className: 'dt-center',
            targets: 1,
          },
        ],
      });

});
</script>
@endsection
