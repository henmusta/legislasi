<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" href="{{isset(Setting::get_setting()->favicon) ? URL::to('storage/images/logo/'.Setting::get_setting()->favicon) : asset('assets/img/profile-photos/1.png')}}">
    <title>{{ Setting::get_setting()->name ?? 'Laravel'}}</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/login/css/portal.css')}}">
</head>

<body>
    <main>
        <div class="row">
            {{-- <img src="{{ URL::to('assets/login/img/side.png') }}" alt=""> --}}
            <div class="side-section" >
            </div>
            <div class="col-sm-5 first-section"  style="padding-right: 0px;">
                <div class="content" style=" padding-top: 60px;">
                    <img  src="{{ URL::to('assets/login/img/lampung.png')}}" width="48px" alt="">
                    <img  src="{{ URL::to('assets/login/img/tanggamus.png')}}" width="50px" alt="">
                </div>


                <div class="content" style=" padding-top: 60px;" >
                    <img  src="{{ isset(Setting::get_setting()->favicon) ? URL::to('storage/images/logo/'.Setting::get_setting()->favicon) : asset('assets/img/profile-photos/1.png') }}" width="250px" alt="">
                    {{-- <h1>Henmus</h1> --}}
                    {{-- <h2>{{ Setting::get_setting()->name ?? 'Laravel'}}</h2>
                    <p>---------------</p> --}}


                </div>
                <div style=" text-align:right;">
                    <img  src="{{ URL::to('assets/login/img/back.png')}}" width="70%" alt="">
                </div>
            </div>
            <div class="col-sm-6 second-section">
                <div class="content">
                    <!-- <img src="assets/images/tanggamus.png" alt=""> -->
                    <form class="custom-form mt-4 pt-2 login" method="POST" action="{{ route('backend.login') }}">
                        @csrf
                        <p style="font-size:20px;" class="title">LOGIN</p>
                        <small>Isi form berikut dengan benar</small>
                        <div class="form-group">
                            <label for="username" class="form-label">Email</label>
                            <input name="email" type="text"
                                class="form-control form-control-sm @error('email') is-invalid @enderror"
                                value="{{ old('email', '') }}" id="username" placeholder="Enter Email"
                                autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <label class="form-label">Password</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-muted">Forgot
                                                password?</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                <div class="input-group auth-pass-inputgroup ">
                                    <input type="password" name="password"  class="form-control  "
                                           id="userpassword" placeholder="Enter password">
                                         <button class="btn btn-light shadow-none ms-0" type="button" onclick="myFunction()" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="cage-button">
                            <button type="submit" class="btn btn-sm btn-success">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="{{asset('assets/login/js/vendor.js')}}"></script>
    <script src="{{asset('assets/login/js/main.js')}}"></script>
    <script>
        function myFunction() {
          var x = document.getElementById("userpassword");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
       }
</script>
</body>

</html>
