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
                            <li><a href="#!">E-legislasi</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        <section  class="bg-img" data-overlay-dark="0" data-background="{{ asset('assets/frontend/img/bg/bg6.jpg')}}" style="background-image: url({{ asset('assets/frontend/img/bg/bg6.jpg')}});">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $config['page_title'] }}</h5>
                        <div class="d-flex">

                            <p style="padding-right:20px">Disusulkan pada :    {{ \Carbon\Carbon::parse($data['legislasi']['created_at'])->isoFormat('dddd, D MMMM Y')}}</p>
                            <p style="padding-right:20px">Disiapkan Oleh : {{ $data['legislasi']['pengusul']['name'] ?? '' }}</p>
                        </div>


                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="page-header">
                                      <h5>Progress RUU</h5>
                                    </div>
                                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                                    <ul class="timeline timeline-horizontal">
                                        @foreach ($data['tahapan'] as $val )
                                        <li class="timeline-item">
                                            @if($val->id == $data['legislasi']['tahapan_id'])
                                            <div class="timeline-badge {{$val->badge ?? ''}} {{isset($val->badge) ? 'ceking'.$val->badge : ''}}"><i class="{{$val->icon ?? ''}}"></i></div>
                                            @else
                                            <div class="timeline-badge {{$val->badge ?? ''}}"><i class="{{$val->icon ?? ''}}"></i></div>
                                            @endif
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <p class="timeline-title">{{$val->name}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach


                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="container">
                            <div class="section-heading">
                                <h5>Agenda Terakhir</h5>
                            </div>
                            <div class="position-relative">
                                <div class="row mt-n1-9">
                                    <!-- services item -->
                                @foreach ($data['agenda_terakhir'] as $obj => $val )
                                    <div class="col-lg-6 col-md-6 mt-1-9">
                                        <div class="bg-white border border-width-2 border-color-extra-light-gray text-center p-1-9 feature-box9">
                                            {{-- <div class="d-inline-block mb-3"><i class="ti-desktop display-10"></i></div> --}}
                                            <div class="d-inline-block mb-3 timeline-badge {{$val->tahapan['badge'] ?? ''}} "><i class="{{$val->tahapan['icon'] ?? ''}}"></i></div>
                                            <div class="alt-font text-extra-dark-gray mb-2">{{$val->judul}}</div>
                                            <p class="mx-auto mb-0">{{$val->deskripsi}}</p>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <div class="horizontaltab tab-style6">
                            <ul class="resp-tabs-list hor_1">
                                <li><i class="fas fa-medkit"></i>
                                    <div class="tab-box">
                                        <h6>Rekam Jejak</h6></div>
                                </li>
                                <li><i class="fas fa-cog"></i>
                                    <div class="tab-box">
                                        <h6>Informasi RUU</h6></div>
                                </li>
                                <li><i class="fas fa-flask"></i>
                                    <div class="tab-box">
                                        <h6>Feedback</h6></div>
                                </li>
                            </ul>
                            <div class="resp-tabs-container hor_1">
                                <div>
                                    <div class="container box-hover">
                                        <div class="position-relative">
                                            <div  style="text-align: center; font-weight:bold;">
                                                <p>Mulai</p>
                                            </div>
                                            <ul class="timeline">
                                                @foreach ($data['tahapan'] as $obj => $val )

                                                    <li class="timeline-{{$obj % 2 == 0 ? 'item':'inverted'}}">
                                                        @if($val->id == $data['legislasi']['tahapan_id'])
                                                        <div class="timeline-badge {{$val->badge ?? ''}} {{isset($val->badge) ? 'ceking'.$val->badge : ''}}"><i class="{{$val->icon ?? ''}}"></i></div>
                                                        @else
                                                        <div class="timeline-badge {{$val->badge ?? ''}}"><i class="{{$val->icon ?? ''}}"></i></div>
                                                        @endif
                                                        @php($html = '<div class="timeline-panel" style="visibility:hidden;">
                                                            <div class="timeline-heading">
                                                                <div class="inner-title">
                                                                    <h4></h4>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-body">
                                                                <p></p>
                                                            </div>
                                                            <div class="timeline-footer">

                                                            </div>
                                                        </div>')
                                                        {{-- @php($judul = '')
                                                        @php($deskripsi = '') --}}


                                                        @for ($i = 0; $i < count($val->agenda); $i++)
                                                             {{-- @php($judul = $val->agenda[0]['judul'])
                                                             @php($deskripsi = $val->agenda[0]['deskripsi']) --}}
                                                             @php($file_html = '')
                                                             @if (isset($val->agenda[0]['agendafile']))

                                                                @foreach ($val->agenda[0]['agendafile'] as $file)
                                                                      @php($file_html .= '<tr>
                                                                                        <td>'.$file['name'].'</td>
                                                                                        <td>'.$file['keterangan'].'</td>
                                                                                    </tr>')
                                                                @endforeach
                                                             @else
                                                                @php($file_html = '')
                                                             @endif
                                                             @php($html = '<div class="timeline-panel">

                                                                <div class="timeline-heading">
                                                                    <div class="inner-title">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <small class="text-muted">'.$val->name.'</small>
                                                                            </div>
                                                                            <div class="col-6 text-end">

                                                                                <small class="text-muted">'.\Carbon\Carbon::parse($val->agenda[0]['created_at'])->isoFormat('D MMMM Y').'</small>
                                                                            </div>
                                                                        </div>


                                                                        <h4>'.$val->agenda[0]['judul'].'</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>'.$val->agenda[0]['deskripsi'].'</p>
                                                                </div>
                                                                <div class="timeline-footer" style="padding-top:20px">
                                                                    <div id="accordion" class="accordion-style">
                                                                        <div class="card">
                                                                            <div class="card-header" id="headingOne">
                                                                                <h5 class="mb-0">
                                                                                    <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#id_'.$val->agenda[0]['id'].'" aria-expanded="false" aria-controls="collapseOne">
                                                                                        Document</button>
                                                                                </h5>
                                                                            </div>
                                                                            <div id="id_'.$val->agenda[0]['id'].'" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordion_'.$val->agenda[0]['id'].'" style="">
                                                                                <div class="card-body">
                                                                                    <table class="table table-bordered">
                                                                                        <thead >
                                                                                            <tr>
                                                                                                <th>Lampiran</th>
                                                                                                <th>Keterangan</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            '. $file_html.'
                                                                                        </tbody>
                                                                                    </table>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>')
                                                        @endfor

                                                        {!!$html!!}

                                                    </li>
                                                    @for ($i = 1; $i < count($val->agenda); $i++)

                                                    @php($file_html = '')
                                                    @if (isset($val->agenda[$i]['agendafile']))

                                                       @foreach ($val->agenda[$i]['agendafile'] as $file)
                                                             @php($file_html .= '<tr>
                                                                               <td>'.$file['name'].'</td>
                                                                               <td>'.$file['keterangan'].'</td>
                                                                           </tr>')
                                                       @endforeach
                                                    @else
                                                       @php($file_html = '')
                                                    @endif
                                                    <li class="timeline-{{$obj % 2 == 0 ? 'item':'inverted'}}">
                                                        <div class="timeline-panel">
                                                            <div class="timeline-heading">

                                                                <div class="inner-title">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <small class="text-muted">{{$val->name}}</small>
                                                                        </div>
                                                                        <div class="col-6 text-end">
                                                                            <small class="text-muted">{{\Carbon\Carbon::parse($val->agenda[$i]['created_at'])->isoFormat('D MMMM Y')}}</small>
                                                                        </div>
                                                                    </div>

                                                                    <h4>{{$val->agenda[$i]['judul']}}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-body">
                                                                <p>{{$val->agenda[$i]['deskripsi']}}</p>
                                                            </div>
                                                            <div class="timeline-footer" style="padding-top:20px">
                                                                <div id="accordion" class="accordion-style">
                                                                    <div class="card">
                                                                        <div class="card-header" id="headingOne">
                                                                            <h5 class="mb-0">
                                                                                <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#id_{{$val->agenda[$i]['id']}}" aria-expanded="false" aria-controls="collapseOne">
                                                                                    Document</button>
                                                                            </h5>
                                                                        </div>
                                                                        <div id="id_{{$val->agenda[$i]['id']}}" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordion_{{$val->agenda[$i]['id']}}" style="">
                                                                            <div class="card-body">
                                                                                <table class="table table-bordered">
                                                                                    <thead >
                                                                                        <tr>
                                                                                            <th>Lampiran</th>
                                                                                            <th>Keterangan</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                       {!!$file_html!!}
                                                                                    </tbody>
                                                                                </table>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endfor
                                                @endforeach
                                                {{-- <li class="timeline-inverted">
                                                    <div class="timeline-badge success"><i class="far fa-thumbs-up"></i></div>
                                                    <div class="timeline-panel">
                                                        <div class="timeline-heading">
                                                            <div class="inner-title half">
                                                                <h4>Pengesahan</h4>
                                                            </div>
                                                        </div>
                                                        <div class="timeline-body">

                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge"><i class="fas fa-check-double"></i></div>
                                                    <div class="timeline-panel">
                                                        <div class="timeline-heading">
                                                            <div class="inner-title half">
                                                                <h4>Perencanaan</h4>
                                                            </div>
                                                        </div>
                                                        <div class="timeline-body">

                                                        </div>
                                                    </div>
                                                </li> --}}
                                            </ul>
                                            <div  style="text-align: center; font-weight:bold;">
                                                <p>Selesai</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="container blogs">
                                        <div class="row">
                                            <!--  start blog left-->
                                            <div class="col-lg-12 pe-xl-1-12 mb-1-12 mb-lg-0">
                                                <div class="posts">
                                                    <div class="post">
                                                        <div class="content">
                                                            <div class="post-meta">
                                                                <div class="post-title">
                                                                    <h2>   {{$data['legislasi']['judul']}}</h2>
                                                                </div>
                                                                <ul class="meta ps-0">

                                                                </ul>
                                                            </div>
                                                            <div class="post-cont">
                                                            {!!$data['legislasi']['deskripsi']!!}
                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <!-- end blog left -->

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="container blogs">
                                        <div class="row">
                                            <!--  start blog left-->
                                            <div class="col-lg-12 pe-xl-1-12 mb-1-12 mb-lg-0">
                                                <div id="accordion" class="accordion-style">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Feedback</button></h5>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                                            <div class="card-body">
                                                                            <!-- form -->
                                                                    <div class="comment-form">

                                                                        <form id="formStore" action="{{ route('e-legislasi.store') }}">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <input type="hidden" name="legislasi_id" value="{{Request::segment(2)}}">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <input type="email" class="form-control" name="email" placeholder="Masukan Email">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="nik" placeholder="Masukan NIk">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" name="telp" placeholder="Masukan No Telp">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <textarea name="comment" rows="6" class="form-control h-100" placeholder="Masukan Feedback"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <button class="butn" type="submit"><span>Send Message</span></button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                    <!-- end form-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="posts" id="chat-area" style="">
                                                    @foreach ($data['comment'] as $val)

                                                    <div class="comments-area">
                                                        <div class="title-g mb-4">

                                                        </div>
                                                        <div class="comment-box" style="padding-top: 25px;">
                                                            <div class="author-thumb">

                                                            </div>
                                                            <div class="comment-info">
                                                                <div class="row">
                                                                    <div class="col-sm-6">

                                                                        <h6><i class="fa fa-address-card" aria-hidden="true"></i>-{{$val->name}}</h6>
                                                                    </div>
                                                                    <div class="col-sm-6 text-end">
                                                                        <small>{{ \Carbon\Carbon::parse($val->created_at)->isoFormat(' D MMMM Y')}}</small>
                                                                    </div>
                                                                </div>

                                                                <p>{{$val->comment}}</p>
                                                                @if (count($val->comment_child) > 0)
                                                                <div class="reply">
                                                                    <a href="#!">
                                                                        <i class="fa fa-reply" aria-hidden="true"></i> Reply
                                                                    </a>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if (count($val->comment_child) > 0)
                                                            @foreach ($val->comment_child as $item)
                                                            <div class="comment-box" style="padding-top: 15px;">
                                                                <div class="author-thumb">
                                                                </div>
                                                                <div class="comment-info">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <h6><i style="width:20px;" class="fa fa-reply"></i>{{$item->name}}</h6>
                                                                        </div>
                                                                        <div class="col-sm-6 text-end">
                                                                            <small>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat(' D MMMM Y')}}</small>
                                                                        </div>
                                                                    </div>

                                                                    <p>{{$item->comment}}</p>
                                                                </div>

                                                            </div>
                                                            @endforeach

                                                        @endif

                                                    </div>
                                                    @endforeach
                                                    <!-- comment -->

                                                    {{-- <div class="comments-area">
                                                        <div class="title-g mb-4">

                                                        </div>
                                                        <div class="comment-box">
                                                            <div class="author-thumb">

                                                            </div>
                                                            <div class="comment-info">
                                                                <h6><a href="#!">Alex Joyrina</a></h6>
                                                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                                            </div>
                                                        </div>

                                                    </div> --}}
                                                    <!-- end comment-->


                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </section>




        <!-- TABLE
        ================================================== -->
        <section class="box-hover">

        </section>




@endsection

@section('css')
<style>

/* button::before {
  content: '';
  border-radius: 1000px;
  min-width: calc(300px + 12px);
  min-height: calc(60px + 12px);
  border: 6px solid #00FFCB;
  box-shadow: 0 0 60px rgba(0,255,203,.64);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  transition: all .3s ease-in-out 0s;
} */



</style>
<style>
/*
.timeline {
    list-style: none;
    padding: 20px 0 20px;
    position: relative;
  }
  .timeline:before {
    top: 0;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 3px;
    background-color: #eeeeee;
    left: 50%;
    margin-left: -1.5px;
  }
  .timeline > li {
    margin-bottom: 20px;
    position: relative;
  }
  .timeline > li:before {
    content: " ";
    display: table;
  }
  .timeline > li:after {
    content: " ";
    display: table;
    clear: both;
  }
  .timeline > li:before {
    content: " ";
    display: table;
  }
  .timeline > li:after {
    content: " ";
    display: table;
    clear: both;
  }
  .timeline > li > .timeline-panel {
    width: 46%;
    float: left;
    border: 1px solid #e8e8e8;
    border-radius: 2px;
    padding: 20px;
    position: relative;
    -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
    box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
  }
  .timeline > li > .timeline-panel:before {
    position: absolute;
    top: 26px;
    right: -15px;
    display: inline-block;
    border-top: 15px solid transparent;
    border-left: 15px solid #ccc;
    border-right: 0 solid #ccc;
    border-bottom: 15px solid transparent;
    content: " ";
  }
  .timeline > li > .timeline-panel:after {
    position: absolute;
    top: 27px;
    right: -14px;
    display: inline-block;
    border-top: 14px solid transparent;
    border-left: 14px solid #fff;
    border-right: 0 solid #fff;
    border-bottom: 14px solid transparent;
    content: " ";
  }
  .timeline-badge {
    color: #fff;
    width: 25px;
    height: 25px;
    line-height: 25px;
    font-size: 12px;
    text-align: center;
    top: 16px;
    left: 50%;
    background-color: #999999;
    z-index: 100;
    border-top-right-radius: 50%;
    border-top-left-radius: 50%;
    border-bottom-right-radius: 50%;
    border-bottom-left-radius: 50%;
  }


  .timeline > li >
  .timeline-badge {
    color: #fff;
    width: 50px;
    height: 50px;
    line-height: 50px;
    font-size: 1.4em;
    text-align: center;
    position: absolute;
    top: 16px;
    left: 50%;
    margin-left: -25px;
    background-color: #999999;
    z-index: 100;
    border-top-right-radius: 50%;
    border-top-left-radius: 50%;
    border-bottom-right-radius: 50%;
    border-bottom-left-radius: 50%;
  }

  .timeline > li.timeline-inverted > .timeline-panel {
    float: right;
  }
  .timeline > li.timeline-inverted > .timeline-panel:before {
    border-left-width: 0;
    border-right-width: 15px;
    left: -15px;
    right: auto;
  }
  .timeline > li.timeline-inverted > .timeline-panel:after {
    border-left-width: 0;
    border-right-width: 14px;
    left: -14px;
    right: auto;
  }


  .timeline-badge.primary {
    background-color: #2e6da4 !important;
  }

  .timeline-badge.success {
    background-color: #3f903f !important;
  }
  .timeline-badge.warning {
    background-color: #f0ad4e !important;
  }
  .timeline-badge.danger {
    background-color: #d9534f !important;
  }
  .timeline-badge.info {
    background-color: #5bc0de !important;
  }
  .timeline-body > p,
  .timeline-body > ul {
    margin-bottom: 0;
  }
  .timeline-body > p + p {
    margin-top: 5px;
  }
  @media (max-width: 767px) {
    ul.timeline:before {
      left: 40px;
    }
    ul.timeline > li > .timeline-panel {
      width: calc(100% - 90px);
      width: -moz-calc(100% - 90px);
      width: -webkit-calc(100% - 90px);
    }
    ul.timeline > li > .timeline-badge {
      left: 15px;
      margin-left: 0;
      top: 16px;
    }
    ul.timeline > li > .timeline-panel {
      float: right;
    }
    ul.timeline > li > .timeline-panel:before {
      border-left-width: 0;
      border-right-width: 15px;
      left: -15px;
      right: auto;
    }
    ul.timeline > li > .timeline-panel:after {
      border-left-width: 0;
      border-right-width: 14px;
      left: -14px;
      right: auto;
    }
  } */

.timeline-horizontal {
  list-style: none;
  padding: 20px;
  position: relative;
}

.timeline-horizontal {
  list-style: none;
  position: relative;
  padding: 20px 0px 20px 0px;
  display: inline-block;
}
.timeline-horizontal:before {
  height: 3px !important;
  top: auto !important;
  bottom: 26px !important;
  left: 56px !important;
  background-color: #999999;
  right: 0;
  width: 100% !important;
  margin-bottom: 20px;
}

.timeline-horizontal.danger {
    background-color: #d9534f !important;
}


.timeline-horizontal .timeline-item {
  display: table-cell;
  height: 180px;
  width: 20%;
  min-width: 320px;
  float: none !important;
  padding-left: 0px;
  padding-right: 20px;
  margin: 0 auto;
  vertical-align: bottom;
}
.timeline-horizontal .timeline-item .timeline-panel {
  top: auto;
  bottom: 64px;
  display: inline-block;
  float: none !important;
  left: 0 !important;
  right: 0 !important;
  width: 100%;
  margin-bottom: 20px;
}
.timeline-horizontal .timeline-item .timeline-panel:before {
  top: auto;
  bottom: -16px;
  left: 28px !important;
  right: auto;
  border-right: 16px solid transparent !important;
  border-top: 16px solid #c0c0c0 !important;
  border-bottom: 0 solid #c0c0c0 !important;
  border-left: 16px solid transparent !important;
}
.timeline-horizontal .timeline-item:before,
.timeline-horizontal .timeline-item:after {
  display: none;
}
.timeline-horizontal .timeline-item .timeline-badge {
  top: auto;
  bottom: 0px;
  left: 43px;
}

 .ceking::after {
  content: '';
  width: 30px; height: 30px;
  border-radius: 100%;
  border: 6px solid #00FFCB;
  position: absolute;
  z-index: -1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: ring 1.5s infinite;
 }
 .cekingprimary::after {
  content: '';
  width: 30px; height: 30px;
  border-radius: 100%;
  border: 6px solid #2e6da4;
  position: absolute;
  z-index: -1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: ring 1.5s infinite;
 }


 .cekingsuccess::after {
  content: '';
  width: 30px; height: 30px;
  border-radius: 100%;
  border: 6px solid  #3f903f;
  position: absolute;
  z-index: -1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: ring 1.5s infinite;
 }

 .cekinginfo::after {
  content: '';
  width: 30px; height: 30px;
  border-radius: 100%;
  border: 6px solid #5bc0de;
  position: absolute;
  z-index: -1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: ring 1.5s infinite;
 }

 .cekingdanger::after {
  content: '';
  width: 30px; height: 30px;
  border-radius: 100%;
  border: 6px solid #d9534f !important;
  position: absolute;
  z-index: -1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: ring 1.5s infinite;
 }

 .cekingwarning::after {
  content: '';
  width: 30px; height: 30px;
  border-radius: 100%;
  border: 6px solid #f0ad4e !important;
  position: absolute;
  z-index: -1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: ring 1.5s infinite;
 }










@keyframes ring {
  0% {
    width: 30px;
    height: 30px;
    opacity: 1;
  }
  100% {
    width: 90px;
    height: 90px;
    opacity: 0;
  }
}
</style>
@endsection
@section('script')
<script>
$(document).ready(function () {




      $("#formStore").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let btnSubmit = form.find("[type='submit']");
        let btnSubmitHtml = btnSubmit.html();
        let url = form.attr("action");
        let data = new FormData(this);
        $.ajax({
          beforeSend: function () {
            btnSubmit.addClass("disabled").html("<span aria-hidden='true' class='spinner-border spinner-border-sm' role='status'></span> Loading ...").prop("disabled", "disabled");
          },
          cache: false,
          processData: false,
          contentType: false,
          type: "POST",
          url: url,
          data: data,
          success: function (response) {
            let errorCreate = $('#errorCreate');
            errorCreate.css('display', 'none');
            errorCreate.find('.alert-text').html('');
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
            if (response.status === "success") {
              let comment =  response.data;
              console.log(comment);
              let html = '<div class="comments-area">'+
                            '<div class="title-g mb-4">'+
                            '</div>'+
                            '<div class="comment-box" style="padding-top: 25px;">'+
                                '<div class="author-thumb">'+
                                '</div>'+
                                '<div class="comment-info">'+
                                    '<div class="row">'+
                                       '<div class="col-sm-6">'+
                                            '<h6><i class="fa fa-address-card" aria-hidden="true"></i>'+comment.name+'</h6>'+
                                        '</div>'+
                                        '<div class="col-sm-6 text-end">'+
                                            '<small>'+response.date+'</small>'+
                                        '</div>'+
                                    '</div>'+
                                     '<p>'+comment.comment+'</p>'+
                                '</div>'+
                            '</div>'+
                         '</div>';
            let chatBody = document.querySelector("#chat-area");
            chatBody.insertAdjacentHTML("beforeend", html);
            chatBody.scrollTo({
                left: 0,
                top: chatBody.scrollHeight,
                behavior: "smooth"
            });
            console.log(form);
            //   toastr.success(response.message, 'Success !');
            //   dataTable.draw();
            //   bsCreate.hide();
            } else {
                alert('failed');
            //   toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
            //   if (response.error !== undefined) {
            //     errorCreate.removeAttr('style');
            //     $.each(response.error, function (key, value) {
            //       errorCreate.find('.alert-text').append('<span style="display: block">' + value + '</span>');
            //     });
            //   }
            }
          },
          error: function (response) {
            btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
            toastr.error(response.responseJSON.message, 'Failed !');
          }
        });
      });

});
</script>
@endsection
