<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Legislasi;
use App\Models\Agenda;
use App\Models\TahapanLegislasi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Traits\ResponseStatus;
use App\Helpers\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Throwable;


class LaporanLegislasiController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Laporan Legislasi";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Laporan Legislasi"],
        ];
        if ($request->ajax()) {
            $tgl_awal = date("m",strtotime($request['tgl_awal']));
            $tgl_akhir = date("m",strtotime($request['tgl_akhir']));
          $data = Agenda::with('tahapan','legislasi')->select('agenda.*');
            if ($request->filled('tgl_awal')) {
               $data->whereMonth('agenda.created_at', '>=',  $tgl_awal);
            }
            if ($request->filled('tgl_akhir')) {
                $data->whereMonth('agenda.created_at', '<=', $tgl_akhir);
            }
            if ($request->filled('skpd_id')) {
                $data->where('agenda.legislasi_id', $request['legislasi_id']);
            }
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<div class="dropdown">
                <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                    Aksi <i class="mdi mdi-chevron-down"></i>
                </a>

                <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                    <a href="' . route('backend.aspirasi.show', $row->id) . '" class="dropdown-item">Detail</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';

            })
            ->make(true);
        }

        return view('backend.laporanlegislasi.index', compact('config', 'page_breadcrumbs'));
    }

    public function countlegislasi(Request $request){
        // dd($request);
        $tgl_awal = $request['tgl_awal'];
        $tgl_akhir = $request['tgl_akhir'];
        $dateRangePeriod = CarbonPeriod::create($tgl_awal, '1 month' , $tgl_akhir);
        $dateRange = [];
        $dataLegislasi = [];
          foreach ($dateRangePeriod as $date) {
            $month = date('m', strtotime($date));
            $dateRange[] = Carbon::createFromFormat('Y-m-d', $date->toDateString())->isoFormat('MMMM');
            // $datasurvey[] = Survey::whereDate('created_at', $date->toDateString())->first();
            $totalLegislasi = Legislasi::whereMonth('created_at', $month)->count();
            $dataLegislasi[] =  [
                'legislasi_count' =>  $totalLegislasi
            ];
          //  $datasurvey = Survey::withCount('partisipan')->whereDate('created_at', $date->toDateString())->first();
          }


            $ChartLegislasi = [
                'labels' => $dateRange,
                'datasets' => [
                [
                    'label' => "Legislasi",
                    'borderColor' => "rgba(113, 76, 190, 0.9)",
                    'borderWidth' => "1",
                    'tension' => 1,
                    'backgroundColor' => "rgba(113, 76, 190, 0.9)",
                    'data' => collect($dataLegislasi)->pluck('legislasi_count')
                ]
                ],

            ];

            $tahapan = TahapanLegislasi::withCount('legislasi')->get();
            $ChartTahapan = [
                'labels' => collect($tahapan)->pluck('name'),
                'datasets' => [
                  [
                    'label' => "Tahapan",
                    'borderColor' => "#fff",
                    'borderWidth' => "1",
                    'tension' => 1,
                    'backgroundColor' => ['#f0ad4e', '#3f903f', '#2e6da4', '#5bc0de', '#d9534f', '#00FFFF'],
                    'data' => collect($tahapan)->pluck('legislasi_count')
                  ]
                ],
            ];

          $data = [
            'ChartLegislasiJson' => $ChartLegislasi,
            'ChartTahapanJson' =>  $ChartTahapan,
          ];



           $results = array(
            "data" =>  $data
          );
        //   dd(response()->json($results['data']->sortByDesc('urut')));

          return response()->json($results);

    }
}
