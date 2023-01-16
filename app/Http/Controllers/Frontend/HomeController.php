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
        $legislasi = Legislasi::with('pengusul', 'tahapan');
        $tahapan = TahapanLegislasi::withCount('legislasi')->get();
        $data = [
          'legislasi' =>  $legislasi->get(),
          'sliderimage' =>  $sliderimage,
          'tahapan' => $tahapan
        ];
        return view('frontend.home.index', compact('data'));
    }

}
