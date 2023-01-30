@extends('frontend.layouts.master')

@section('content')
        <!-- PAGE TITLE
        ================================================== -->
        <section class="page-title-section2 bg-img cover-background top-position1" data-overlay-dark="4" data-background="{{asset('assets/frontend/img/bg/bg9.jpg')}}">
            <div class="container text-center">
                <div class="section-heading half white">
                    <h2>Survey Yang Anda Lakukan Sudah Diterima</h2>
                    <p>Terima Kasih {{$data['partisipan']['name']}} Atas Partisipasi Anda</p>
                </div>
                <a href="{{ url('home') }}" class="butn white"><span>Home</span></a>
            </div>
        </section>

        <!-- <section  class="bg-img" data-overlay-dark="0" data-background="{{ asset('assets/frontend/img/bg/bg6.jpg')}}" style="background-image: url({{ asset('assets/frontend/img/bg/bg6.jpg')}});">
            <div class="container">

            </div>
        </section> -->

<!-- <section class="parallax" data-overlay-dark="7" data-background="{{ asset('assets/frontend/img/bg/bg1.jpg')}}">

</section> -->







@endsection

@section('css')

@endsection
@section('script')

@endsection
