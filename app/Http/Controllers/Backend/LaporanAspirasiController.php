<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Aspirasi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Traits\ResponseStatus;
use App\Helpers\FileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Throwable;


class LaporanAspirasiController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Data Aspirasi";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Data Aspirasi"],
        ];
        if ($request->ajax()) {
          $data = Aspirasi::with('get_dewan','get_skpd', 'get_kabupaten', 'get_kecamatan');
            if ($request->filled('tgl_awal')) {
               $data->whereDate('aspirasi.created_at', '>=', $request['tgl_awal']);
            }
            if ($request->filled('tgl_akhir')) {
                $data->whereDate('aspirasi.created_at', '<=', $request['tgl_akhir']);
            }
            if ($request->filled('skpd_id')) {
                $data->where('aspirasi.skpd', $request['skpd_id']);
            }
            if ($request->filled('dewan_id')) {
                $data->where('aspirasi.dewan', $request['dewan_id']);
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

        return view('backend.laporanaspirasi.index', compact('config', 'page_breadcrumbs'));
    }

    public function countaspirasi(Request $request){
        // dd($request);
        $tgl_awal = $request['tgl_awal'];
        $tgl_akhir = $request['tgl_akhir'];
        $dateRangePeriod = CarbonPeriod::create($tgl_awal, '1 month' , $tgl_akhir);
        $dateRange = [];
        $dataAspirasi = [];
          foreach ($dateRangePeriod as $date) {
            $month = date('m', strtotime($date));
            $dateRange[] = Carbon::createFromFormat('Y-m-d', $date->toDateString())->isoFormat('MMMM');
            // $datasurvey[] = Survey::whereDate('created_at', $date->toDateString())->first();
            $totalAspirasi = Aspirasi::whereMonth('created_at', $month)->count();
            $dataAspirasi[] =  [
                'aspirasi_count' => $totalAspirasi
            ];
          //  $datasurvey = Survey::withCount('partisipan')->whereDate('created_at', $date->toDateString())->first();
          }


        $ChartAspirasi = [
            'labels' => $dateRange,
            'datasets' => [
              [
                'label' => "Aspirasi",
                'borderColor' => "rgba(113, 76, 190, 0.9)",
                'borderWidth' => "1",
                'tension' => 1,
                'backgroundColor' => "rgba(113, 76, 190, 0.9)",
                'data' => collect($dataAspirasi)->pluck('aspirasi_count')
              ]
            ],

        ];

          $data = [
            'ChartAspirasiJson' => $ChartAspirasi,
          ];



           $results = array(
            "data" =>  $data
          );
        //   dd(response()->json($results['data']->sortByDesc('urut')));

          return response()->json($results);

    }
}
