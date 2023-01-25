@extends('frontend.layouts.master') @section('content') {{-- class="rev_slider_wrapper fullscreen custom-controls custom-paragraph cover-background top-position" --}}
<!-- REVOLUTION SLIDER
        ================================================== -->
<div class="rev_slider_wrapper  custom-controls custom-paragraph top-position">
  <div id="rev_slider_2" class="rev_slider fullscreenbanner" style="display: none;" data-version="5.4.5">
    <ul> @foreach ($data['sliderimage'] as $val ) <li data-transition="parallaxtoright">
        <!-- overlay -->
        <div class="opacity-extra-medium bg-black z-index-1"></div>
        <img src="{{asset('storage/images/slider/'.$val->image)}}" alt="slide2" class="rev-slidebg">
        <!-- layer 1 -->
        <div class="tp-caption tp-resizeme max-style alt-font" id="slide-2-layer-1" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" data-hoffset="['0','0','0','0']" data-voffset="['-100','-100','-100','-120']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="chars" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" style="z-index: 5; white-space: nowrap; color: #fff; font-weight: 700; text-transform: uppercase;">
          {{$val->judul}}
        </div>
        <!-- end layer 1 -->
        <!-- layer nr. 2 -->
        <div class="tp-caption tp-resizeme slider-text" id="slide-2-layer-2" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" data-hoffset="['0','0','0','0']" data-voffset="['-20','-20','-20','-40']" data-fontsize="['18','20','20','20']" data-lineheight="['30','30','28','28']" data-width="none" data-height="none" data-transform_idle="o:1;" data-transform_in="x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:[-100%];y:0;s:inherit;e:inherit;" data-start="2500" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; color: #fff; text-align: center;">
          <p class="white-space text-center px-3 px-md-0">
            {{$val->deskripsi}}
          </p>
        </div>
        <!-- layer nr. 3 -->
        <div class="tp-caption tp-resizeme" id="slide-2-layer-3" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" data-hoffset="['0','0','0','0']" data-voffset="['65','65','65','65']" data-fontsize="['18','18','14','14']" data-lineheight="['26','26','22','22']" data-width="none" data-height="none" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="2800" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; line-height: 22px;">
          <a href="{{$val->menupermission['path_url']}}" class="butn primary">
            <span>Lebih Lanjut</span>
          </a>
        </div>
      </li> @endforeach {{-- <li data-transition="parallaxtoright">
					<!-- overlay -->
					<div class="opacity-extra-medium bg-black z-index-1"></div>
					<img src="{{asset('storage/slider/E_Survey.jpg')}}" alt="slide2" class="rev-slidebg">
      <!-- layer 1 -->
      <div class="tp-caption tp-resizeme max-style alt-font" id="slide-2-layer-1" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" data-hoffset="['0','0','0','0']" data-voffset="['-100','-100','-100','-120']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="chars" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" style="z-index: 5; white-space: nowrap; color: #fff; font-weight: 700; text-transform: uppercase;"> E-SURVEY </div>
      <!-- end layer 1 -->
      <!-- layer nr. 2 -->
      <div class="tp-caption tp-resizeme slider-text" id="slide-2-layer-2" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" data-hoffset="['0','0','0','0']" data-voffset="['-20','-20','-20','-40']" data-fontsize="['18','20','20','20']" data-lineheight="['30','30','28','28']" data-width="none" data-height="none" data-transform_idle="o:1;" data-transform_in="x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:[-100%];y:0;s:inherit;e:inherit;" data-start="2500" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; color: #fff; text-align: center;">
        <p class="white-space text-center px-3 px-md-0"> Tujuan survey adalah untuk memperoleh gambaran secara objektif mengenai tanggapan masyarakat </p>
      </div>
      <!-- layer nr. 3 -->
      <div class="tp-caption tp-resizeme" id="slide-2-layer-3" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" data-hoffset="['0','0','0','0']" data-voffset="['65','65','65','65']" data-fontsize="['18','18','14','14']" data-lineheight="['26','26','22','22']" data-width="none" data-height="none" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="2800" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; line-height: 22px;">
        <a href="#!" class="butn primary">
          <span>Lebih Lanjut</span>
        </a>
      </div>
      </li>
      <li data-transition="parallaxtoright">
        <!-- overlay -->
        <div class="opacity-extra-medium bg-black z-index-1"></div>
        <img src="{{asset('storage/slider/E_Aspirasi.jpg')}}" alt="slide2" class="rev-slidebg">
        <!-- layer 1 -->
        <div class="tp-caption tp-resizeme max-style alt-font" id="slide-2-layer-1" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" data-hoffset="['0','0','0','0']" data-voffset="['-100','-100','-100','-120']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="chars" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" style="z-index: 5; white-space: nowrap; color: #fff; font-weight: 700; text-transform: uppercase;"> E-Aspirasi </div>
        <!-- end layer 1 -->
        <!-- layer nr. 2 -->
        <div class="tp-caption tp-resizeme slider-text" id="slide-2-layer-2" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" data-hoffset="['0','0','0','0']" data-voffset="['-20','-20','-20','-40']" data-fontsize="['18','20','20','20']" data-lineheight="['30','30','28','28']" data-width="none" data-height="none" data-transform_idle="o:1;" data-transform_in="x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-mask_in="x:[-100%];y:0;s:inherit;e:inherit;" data-start="2500" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; color: #fff; text-align: center;">
          <p class="white-space text-center px-3 px-md-0"> Rancangan Undang-Undang (RUU) terkait otonomi daerah, hubungan pusat dan daerah </p>
        </div>
        <!-- layer nr. 3 -->
        <div class="tp-caption tp-resizeme" id="slide-2-layer-3" data-x="['center','center','center','center']" data-y="['middle','middle','middle','middle']" data-hoffset="['0','0','0','0']" data-voffset="['65','65','65','65']" data-fontsize="['18','18','14','14']" data-lineheight="['26','26','22','22']" data-width="none" data-height="none" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="2800" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; line-height: 22px;">
          <a href="#!" class="butn primary">
            <span>Lebih Lanjut</span>
          </a>
        </div>
      </li> --}}
    </ul>
  </div>
</div>


<section class="box-hover" data-background="{{ asset('assets/frontend/img/bg/bg6.jpg')}}" style="background-image: url({{ asset('assets/frontend/img/bg/bg6.jpg')}});">
    <div class="container">
        <div class="section-heading">
            <h2>--</h2>

        </div>
        <div class="position-relative">
            <div class="row mt-n4">
                <div class="col-lg-4 mt-4">
                    <a href="{{ url('e-legislasi') }}">
                        <div class="feature-box-01">
                            <i class="ti-world display-19"></i>
                            <h3 class="display-28 mt-3">E-LEGISLASI</h3>
                            <p>Rancangan Undang-Undang (RUU) terkait otonomi daerah, hubungan pusat dan daerah.</p>

                        </div>
                    </a>
                </div>
                <div class="col-lg-4 mt-4">
                    <a href="{{ url('e-survey') }}">
                        <div class="feature-box-01">
                            <i class="ti-world display-19"></i>
                            <h3 class="display-28 mt-3">E-SURVEY</h3>
                            <p>Tujuan survey adalah untuk memperoleh gambaran secara objektif mengenai tanggapan masyarakat.</p>

                        </div>
                    </a>
                </div>
                <div class="col-lg-4 mt-4">
                    <a href="{{ url('e-aspirasi') }}">
                        <div class="feature-box-01">
                            <i class="ti-world display-19"></i>
                            <h3 class="display-28 mt-3">E-ASPIRASI</h3>
                            <p>Menampung Pendapat Baik Berupa Saran, Pertanyaan, Informasi dan Keluhan.</p>

                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="parallax about-area p-0" data-overlay-dark="8" data-background="assets/frontend/img/bg/bg3.jpg">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="about-text">
            <div class="section-heading left white">
              <h4>E-LEGISLASI</h4>
            </div>
            <div class="inner-content">
                 <table class="table table-bordered" style="width:100%; color:#ffff;">
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
                                      </tbody>
                                  </table>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-right-box">
              <canvas id="ChartPaiTahapan"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>



<section class="bg-img" data-overlay-dark="0" data-background="{{ asset('assets/frontend/img/bg/bg6.jpg')}}" style="background-image: url({{ asset('assets/frontend/img/bg/bg6.jpg')}});">


       <div class="container">
        <div class="section-heading">
          <h2>Data Terbaru</h2>
          <!-- <p class="w-95 w-md-75 w-lg-55 mx-auto">Business consulting excepteur sint occaecat cupidatat consulting non proident, sunt in culpa qui officia deserunt laborum Market.</p> -->
        </div>
        <div class="owl-carousel owl-theme owl-loaded owl-drag" id="services-carousel">
          <div class="owl-stage-outer">

            <div class="owl-stage" style="transform: translate3d(-1032px, 0px, 0px); transition: all 0s ease 0s; width: 4128px;">
                @foreach ($data['legislasi'] as $val )
                    <div class="owl-item" style="width: 516px;">
                        <div class="service-box">
                        <div class="clearfix service-inner-box">
                            <div class="service-icon-box">
                                <div class="timeline-badge {{$val->tahapan->badge}}"><i style="font-size:10px;" class="{{$val->tahapan->icon}}"></i></div>
                            </div>
                            <div class="service-content-box">
                            <h3>
                                <a href="#!">{{$val->judul}}</a>
                            </h3>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>

          </div>


        </div>
      </div>



</section>



<div class="section-clients bg-light">
  <div class="container">
    <div class="owl-carousel owl-theme clients" id="clients">
      <div class="item">
        <img alt="..." src="{{asset('assets/frontend/img/aksara.png')}}">
      </div>
    </div>
  </div>
</div>
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
                                text: 'Chart Total Per Tahapan',
                                fontColor: "#fff"
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
                                    display: false,
                                    position: 'bottom',
                                    labels: {
                                        fontColor: "#fff"
                                    },
                                }
                        }
                    });
            }
        });
    }


});
</script>
@endsection
