<footer>
    <div class="container">
        <div class="row mt-n1-9">

            <div class="col-lg-5 col-md-6 mt-1-9">

                <img alt="footer-logo" width="50px" height="50px" src="{{URL::to('storage/images/logo/'.SettingFront::get_setting()->icon)}}">
                <p class="mt-4 text-light-gray">{!!Footer::get_footer()['about']->deskripsi!!}</p>


            </div>

            <div class="col-lg-2 col-md-6 mt-1-9">
                <h3 class="text-white">Menu</h3>
                <ul class="footer-list ps-0">
                    <li><a href="home">HOME</a></li>
                    <li><a href="e-legislasi">E-LEGISLASI</a></li>
                    <li><a href="e-survey">E-SURVEY</a></li>
                    <li><a href="e-aspirasi">E-ASPIRASI</a></li>
                    <li><a href="e-pages/about">ABOUT</a></li>
                </ul>
            </div>

            <div class="col-lg-5 col-md-6 mt-1-9">
                <h3 class="text-white">Legislasi Terbaru</h3>
                @foreach (Footer::get_footer()['last_legislasi']  as $val)

                <div class="clearfix footer-recent-post mt-0">
                    <div style="width:5% !important" class="footer-recent-post-thumb timeline-badge {{$val->tahapan['badge']}}"><i class="{{$val->tahapan['icon']}}"></i></div>
                    <div class="footer-recent-post-content"><a href="#!">{{$val->judul}}</div>
                </div>
               @endforeach


            </div>
        </div>

    </div>
    <div class="footer-bar">
        <div class="container">
            {{-- <p class="mb-0">&copy; <span class="current-year"></span> Fabrex is Powered by <a href="https://www.chitrakootweb.com/" target="_blank" class="text-light-gray">Chitrakoot Web</a></p> --}}
        </div>
    </div>
</footer>
