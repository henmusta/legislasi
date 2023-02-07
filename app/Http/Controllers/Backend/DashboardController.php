<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Legislasi;
use App\Models\Agenda;
use App\Models\Aspirasi;
use App\Models\Survey;
use App\Models\Partisipan;
use App\Models\TahapanLegislasi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
      $config['page_title'] = "Dashboard";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "Dashboard"],
      ];
      return view('backend.dashboard.index', compact('config', 'page_breadcrumbs'));
    }

    public function countdashboard(Request $request){
        // dd($request);
        $tgl_awal = $request['tgl_awal'];
        $tgl_akhir = $request['tgl_akhir'];

        ///count
        $legislasi = Legislasi::count();
        $agenda = Agenda::count();
        $aspirasi = Aspirasi::count();
        $survey = Survey::count();
        $partisipan = Partisipan::count();




        $dateRangePeriod = CarbonPeriod::create($tgl_awal, '1 month' , $tgl_akhir);
        $dateRange = [];
        $dataLegislasi = [];
        $dataAspirasi = [];
        $datasurvey = [];
            foreach ($dateRangePeriod as $date) {
                $month = date('m', strtotime($date));
                $dateRange[] = Carbon::createFromFormat('Y-m-d', $date->toDateString())->isoFormat('MMMM');
                $totalLegislasi = Legislasi::whereMonth('created_at', $month)->count();
                $dataLegislasi[] =  [
                    'legislasi_count' =>  $totalLegislasi
                ];
                $totalAspirasi = Aspirasi::whereMonth('created_at', $month)->count();
                $dataAspirasi[] =  [
                    'aspirasi_count' => $totalAspirasi
                ];
                $totalPartisipan = Partisipan::whereMonth('created_at', $month)->count();
                $datasurvey[] =  [
                    'partisipan_count' => $totalPartisipan
                ];
            }


            // foreach ($dateRangePeriod as $date) {
            //   $month = date('m', strtotime($date));
            //   $dateRange[] = Carbon::createFromFormat('Y-m-d', $date->toDateString())->isoFormat('MMMM');
            //   // $datasurvey[] = Survey::whereDate('created_at', $date->toDateString())->first();

            // //  $datasurvey = Survey::withCount('partisipan')->whereDate('created_at', $date->toDateString())->first();
            // }




            $ChartLegislasi = [
                'labels' => $dateRange,
                'datasets' => [
                [
                    'label' => "Legislasi",
                    'borderColor' => "rgba(113, 76, 190, 0.9)",
                    'borderWidth' => "1",
                    'tension' => 1,
                    'backgroundColor' => "#7FFFD4",
                    'data' => collect($dataLegislasi)->pluck('legislasi_count')
                ]
                ],

            ];
            $ChartAspirasi = [
                'labels' => $dateRange,
                'datasets' => [
                  [
                    'label' => "Aspirasi",
                    'borderColor' => "rgba(113, 76, 190, 0.9)",
                    'borderWidth' => "1",
                    'tension' => 1,
                    'backgroundColor' => "#00FFFF",
                    'data' => collect($dataAspirasi)->pluck('aspirasi_count')
                  ]
                ],

            ];
            $ChartSurvey = [
                'labels' => $dateRange,
                'datasets' => [
                  [
                    'label' => "Partisipan",
                    'borderColor' => "rgba(113, 76, 190, 0.9)",
                    'borderWidth' => "1",
                    'tension' => 1,
                    'backgroundColor' => "#0000FF",
                    'data' => collect($datasurvey)->pluck('partisipan_count')
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
            'legislasi' => $legislasi,
            'agenda' =>  $agenda,
            'aspirasi' =>  $aspirasi,
            'survey' => $survey,
            'partisipan' =>  $partisipan,
            'ChartLegislasiJson' => $ChartLegislasi,
            'ChartTahapanJson' =>  $ChartTahapan,
            'ChartAspirasiJson' => $ChartAspirasi,
            'ChartSurveyJson' => $ChartSurvey,
          ];



           $results = array(
            "data" =>  $data
          );
        //   dd(response()->json($results['data']->sortByDesc('urut')));

          return response()->json($results);

    }

}
