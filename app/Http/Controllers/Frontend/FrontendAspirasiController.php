<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Legislasi;
use App\Models\AgendaFile;
use App\Models\Agenda;
use App\Models\User;
use App\Models\Comment;
use App\Models\TahapanLegislasi;
use App\Models\LegislasiTahapanLegislasi;
use Carbon\Carbon;
use App\Models\Legi;
use App\Traits\ResponseStatus;
use App\Helpers\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Throwable;


class FrontendAspirasiController extends Controller
{

    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "E-Legislasi";
        $page_breadcrumbs = [
          ['url' => route('home.index'), 'title' => "Home"],
          ['url' => '#', 'title' => "E-Legislasi"],
        ];
        // $legislasi = Legislasi::with('pengusul', 'tahapan');
        // $tahapan = TahapanLegislasi::withCount('legislasi')->get();
        //     $data = [
        //         'tahapan' => $tahapan,
        //         'last_legislasi' => $legislasi->orderBy('id', 'DESC')->limit(3)->get()
        //     ];

        // if ($request->ajax()) {
        //   $data = Legislasi::with('pengusul', 'tahapan');
        //   return DataTables::of($data)

        //     ->addColumn('updated_date', function ($row) {
        //         return \Carbon\Carbon::parse($row->updated_at)->isoFormat('D MMMM Y');
        //     })
        //     ->make(true);
        // }

        return view('frontend.aspirasi.index', compact('config', 'page_breadcrumbs'));
    }

}
