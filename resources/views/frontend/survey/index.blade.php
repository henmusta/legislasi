@extends('frontend.layouts.master')

@section('content')
        <!-- PAGE TITLE
        ================================================== -->
        <section class="page-title-section2 bg-img cover-background top-position1" data-overlay-dark="4" data-background="assets/frontend/img/bg/bg9.jpg">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h1>E-Survey</h1>
                    </div>
                    <div class="col-md-12">
                        <ul class="ps-0">
                            <li><a href="home-default.html">Home</a></li>
                            <li><a href="#!">E-Survey</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        <!-- TABLE
        ================================================== -->
        <section  class="bg-img" data-overlay-dark="0" data-background="{{ asset('assets/frontend/img/bg/bg6.jpg')}}" style="background-image: url({{ asset('assets/frontend/img/bg/bg6.jpg')}});">
            <div class="container">
                <div class="section-heading">
                  <span>Survey</span>
                  <h2>Survey Tersedia</h2>
                </div>
                <div class="owl-carousel owl-theme owl-loaded owl-drag" id="blog-grid">
                  <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(-1728px, 0px, 0px); transition: all 0.9s ease 0s; width: 4320px;">
                        @foreach ($data['survey'] as $val )
                        <div class="owl-item" style="width: 400px;">
                            <article class="blog-grid-simple">
                              <h3>
                                <a href="#!">{{$val['name']}}</a>
                              </h3>
                              {!!$val['deskripsi']!!}
                              <div class="blog-grid-simple-content">
                                <div class="row">
                                  <div class="blog-grid-simple-date">
                                    <div class="w-50 float-start">
                                      <i class="fas fa-calendar-alt"></i>
                                      <h5>{{ \Carbon\Carbon::parse($val['created_at'])->isoFormat('D MMMM Y')}}</h5>
                                    </div>
                                    <div class="w-50 float-end text-end">
                                      <a href="e-survey/{{$val['id']}}/edit">Mulai</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </article>
                          </div>
                        @endforeach

                    </div>
                  </div>
                  <div class="owl-nav disabled">
                    <button type="button" role="presentation" class="owl-prev">
                      <span aria-label="Previous">‹</span>
                    </button>
                    <button type="button" role="presentation" class="owl-next">
                      <span aria-label="Next">›</span>
                    </button>
                  </div>
                  <div class="owl-dots disabled"></div>
                </div>
              </div>
        </section>




@endsection

@section('css')
<style>

</style>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>

</script>
@endsection
