@extends('frontend.layouts.master')

@section('content')
        <!-- PAGE TITLE
        ================================================== -->
        <section class="page-title-section2 bg-img cover-background top-position1" data-overlay-dark="4" data-background="{{asset('assets/frontend/img/bg/bg9.jpg')}}">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h1>E-legislasi</h1>
                    </div>
                    <div class="col-md-12">
                        <ul class="ps-0">
                            <li><a href="home-default.html">Home</a></li>
                            <li><a href="#!">{{$data['page']['name']}}</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        <!-- TABLE
        ================================================== -->
        <section  class="bg-img" data-overlay-dark="0" data-background="{{ URL::asset('assets/frontend/img/bg/bg6.jpg')}}" style="background-image: url({{ URL::asset('assets/frontend/img/bg/bg6.jpg')}});">
            <div class="container">
                <div class="row">

                    <!--  start blog left-->
                    <div class="col-lg-12 pe-xl-1-12 mb-1-12 mb-lg-0">
                        <div class="posts">
                            <div class="post">

                                <div class="content">
                                    <div class="post-meta">
                                        <div class="post-title">
                                            <h2>{{$data['page']['judul']}}</h2>
                                        </div>

                                    </div>
                                    <div class="post-cont">
                                     {!!$data['page']['deskripsi']!!}
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end blog left -->


                </div>
            </div>
        </section>




@endsection

@section('css')
<style>
    .disabledTab{
    pointer-events: none;
}
</style>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>



$(document).ready(function () {



});
</script>
@endsection
