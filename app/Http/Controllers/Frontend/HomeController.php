<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Traits\ResponseStatus;
use App\Models\SliderImage;
use App\Models\TahapanLegislasi;
use App\Models\Legislasi;
use App\Models\MenuPermission;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {

        $sliderimage = SliderImage::with('menupermission')->get();
        $legislasi = Legislasi::with('pengusul', 'tahapan')->where('status', '1');
        $tahapan = TahapanLegislasi::selectRaw('CASE
        WHEN
           legislasi.status = "1" THEN COUNT(legislasi.id)
        ELSE 0
              END as legislasi_count, tahapanlegislasi.*')
        ->leftJoin('legislasi', 'legislasi.tahapan_id' , '=', 'tahapanlegislasi.id' )
        ->groupBy('tahapanlegislasi.id')->get();
        // dd( $tahapan->toSql());
        $data = [
          'legislasi' =>  $legislasi->get(),
          'sliderimage' =>  $sliderimage,
          'tahapan' => $tahapan
        ];
        return view('frontend.home.index', compact('data'));
    }

}
