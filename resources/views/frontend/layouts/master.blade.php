<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from fabrex.websitelayout.net/home-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Jan 2023 05:03:08 GMT -->
<head>

    <!-- metas -->
    <meta charset="utf-8">
    <meta name="author" content="Chitrakoot Web" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="Multipurpose Business and Admin HTML5 Template" />
    <meta name="description" content="Fabrex - Multipurpose Business and Admin Template" />

    <!-- title  -->
    <title>Fabrex - Multipurpose Business and Admin Template</title>

    <!-- favicon -->

    @include('frontend.layouts.headercss')
</head>

<body data-color-mode="green">

    <!-- PAGE LOADING
    ================================================== -->
    <div id="preloader"></div>

    <!-- MAIN WRAPPER
    ================================================== -->
    <div class="main-wrapper">

        <!-- HEADER
        ================================================== -->
        <header class="header-style1">

            <div class="navbar-default">

                <!-- start top search -->
                <div class="top-search bg-primary">
                    <div class="container">
                        <form class="search-form" action="https://fabrex.websitelayout.net/search.html" method="GET" accept-charset="utf-8">
                            <div class="input-group">
                                <span class="input-group-addon cursor-pointer">
                                    <button class="search-form_submit fas fa-search text-white" type="submit"></button>
                                </span>
                                <input type="text" class="search-form_input form-control" name="s" autocomplete="off" placeholder="Type & hit enter...">
                                <span class="input-group-addon close-search"><i class="fas fa-times display-28 mt-1"></i></span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end top search -->

                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="menu_area alt-font">
                                <nav class="navbar navbar-expand-lg navbar-light p-0">

                                    <div class="navbar-header navbar-header-custom">
                                        <!-- logo -->
                                        <a href="index-2.html" class="navbar-brand"><img id="logo" src="{{ asset('assets/frontend/img/tanggamus.png') }}" alt="logo"></a>
                                        <!-- end logo -->
                                    </div>

                                    <div class="navbar-toggler"></div>

                                    <!-- menu area -->
                                    <ul class="navbar-nav ms-auto" id="nav" style="display: none;">
                                        <li><a href="/home">Home</a>

                                        </li>
                                        <li><a href="/e-legislasi">E-LEGISLASI</a>

                                        </li>
                                        <li><a href="#!">E-SURVEY</a>

                                        </li>
                                        <li><a href="#!">E-ASPIRASI</a>

                                        </li>
                                        <li><a href="#!">ABOUT</a>

                                        </li>

                                    </ul>
                                    <!-- end menu area -->


                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <!-- PAGE TITLE
        ================================================== -->
        {{-- <section class="page-title-section2 bg-img cover-background top-position" data-overlay-dark="4" data-background="assets/frontend/img/bg/bg9.jpg">

            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h1>Header 2</h1>
                    </div>
                    <div class="col-md-12">
                        <ul class="ps-0">
                            <li><a href="home-default.html">Home</a></li>
                            <li><a href="#!">Header 2</a></li>
                        </ul>
                    </div>
                </div>

            </div>

        </section> --}}

        {{-- <header class="header-style8">
            <div id="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="top-bar-info">
                                <ul class="ps-0">
                                    <li><i class="fas fa-mobile-alt"></i>(+123) 456 7890</li>
                                    <li><i class="fas fa-envelope"></i>addyour@emailhere</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 d-none d-md-block">
                            <ul class="top-social-icon ps-0">
                                <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#!"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navbar-default">

                <!-- top search -->
                <div class="top-search bg-primary">
                    <div class="container">
                        <form class="search-form" action="https://fabrex.websitelayout.net/search.html" method="GET" accept-charset="utf-8">
                            <div class="input-group">
                                <span class="input-group-addon cursor-pointer">
                                    <button class="search-form_submit fas fa-search text-white" type="submit"></button>
                                </span>
                                <input type="text" class="search-form_input form-control" name="s" autocomplete="off" placeholder="Type & hit enter...">
                                <span class="input-group-addon close-search"><i class="fas fa-times mt-1"></i></span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end top search -->

                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="menu_area alt-font">
                                <nav class="navbar navbar-expand-lg navbar-light p-0">

                                    <div class="navbar-header navbar-header-custom">
                                        <!-- logo -->
                                        <a href="index-2.html" class="navbar-brand logodefault"><img id="logo" src="{{asset('assets/frontend/img/logos/logo.png')}}" alt="logo"></a>
                                        <!-- end logo -->
                                    </div>

                                    <div class="navbar-toggler"></div>

                                    <!-- menu area -->
                                    <ul class="navbar-nav ms-auto" id="nav" style="display: none;">
                                        <li><a href="/home">Home</a>

                                        </li>
                                        <li><a href="/e-legislasi">E-LEGISLASI</a>

                                        </li>
                                        <li><a href="#!">E-SURVEY</a>

                                        </li>
                                        <li><a href="#!">E-ASPIRASI</a>

                                        </li>
                                        <li><a href="#!">ABOUT</a>

                                        </li>

                                    </ul>
                                    <!-- end menu area -->

                                    <!-- atribute navigation -->
                                    <div class="attr-nav" hidden>
                                        <ul>
                                            <li class="search"><a href="#!"><i class="fas fa-search"></i></a></li>
                                        </ul>
                                    </div>
                                    <!-- end atribute navigation -->
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header> --}}


        {{-- section --}}
        @yield('content')

        <!-- FOOTER
        ================================================== -->

        @include('frontend.layouts.footer')
    </div>

    @include('frontend.layouts.footerjs')
</body>


<!-- Mirrored from fabrex.websitelayout.net/home-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Jan 2023 05:03:49 GMT -->
</html>
