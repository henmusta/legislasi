<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\QuestionDetail;
use App\Models\Partisipan;
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

class LaporanSurveyController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Laporan Survey";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Laporan Survey"],
        ];
        $survey_id = $request['survey_id'];
        // dd($survey_id);
        $data = QuestionDetail::with('question')->
                            selectRaw('question.question as pertanyaan,
                                survey.name as survey_name,
                                question_detail.deskripsi as deskripsi,
                                COUNT(
                                    IF(
                                        question_detail.answer = participants_detail.answer,
                                    1,
                                    NULL
                                    )
                                ) AS cek')
                                // select('question.question as pertanyaan',
                                //        'survey.name as survey_name',
                                //        'question_detail.deskripsi as deskripsi')
                              ->leftJoin('question', 'question.id', '=', 'question_detail.question_id')
                              ->leftJoin('participants_detail', 'participants_detail.question_id', '=', 'question.id')
                              ->leftJoin('survey', 'question.survey_id', '=', 'survey.id')
                               ->when($survey_id, function ($query, $survey_id) {
                                return $query->where('survey1.id', $survey_id);
                                })
                              ->groupBy('question_detail.id')
                              ->get();
        // $data = [];
        // foreach($query as $key => $val){
        //     // dd($query[$key]['id']);
        //     $data[$key]['survey'][] = $val['survey'];
        //     $data[$key]['question'][] = $val['question'];
        //     if(isset($val['a'])){
        //         $data[$key]['answer']['a'] = $val['a'];
        //     };
        //     if(isset($val['b'])){
        //         $data[$key]['answer']['b'] = $val['b'];
        //     };
        //     if(isset($val['c'])){
        //         $data[$key]['answer']['c'] = $val['c'];
        //     };
        //     if(isset($val['d'])){
        //         $data[$key]['answer']['d'] = $val['d'];
        //     };
        //     if(isset($val['e'])){
        //         $data[$key]['answer']['e'] = $val['e'];
        //     };
        //     // if(isset($val['b'])){
        //     //     // $data[]['question'] = $val['question'];
        //     //     $data[$key]['answer'] = $val['b'];
        //     //     // $data[]['b_count'] = $val['b'];
        //     // };
        //     // if(isset($val['c'])){
        //     //     // $data[]['question'] = $val['question'];
        //     //     $data[$key]['answer'] = $val['c'];
        //     //     // $data[]['c_count'] = $val['c'];
        //     // };
        //     // if(isset($val['d'])){
        //     //     // $data[]['question'] = $val['question'];
        //     //     $data[$key]['answer'] = $val['d'];
        //     //     // $data[]['d_count'] = $val['d'];
        //     // };
        //     // if(isset($val['e'])){
        //     //     // $data[]['question'] = $val['question'];
        //     //     $data[]['answer'] = $val['e'];
        //     //     // $data[]['e_count'] = $val['e'];
        //     // };
        // }
        // foreach ($data as $i => $item){
        //     // dd($query[$key]['question']);
        //     $data[$i]['question'] = $query[$key]['question'];
        // }
        // dd($data);
        if ($request->ajax()) {

          return DataTables::of($data)
          ->addColumn('survey', function ($row) {

            // return $row->question->survey->name;
          })
          ->make(true);
        }

        return view('backend.laporansurvey.index', compact('config', 'page_breadcrumbs'));
    }


    public function countsurvey(Request $request){
        // dd($request);
        $tgl_awal = $request['tgl_awal'];
        $tgl_akhir = $request['tgl_akhir'];
        $dateRangePeriod = CarbonPeriod::create($tgl_awal, '1 month' , $tgl_akhir);
        $dateRange = [];
        $datasurvey = [];
          foreach ($dateRangePeriod as $date) {
            $month = date('m', strtotime($date));
            $dateRange[] = Carbon::createFromFormat('Y-m-d', $date->toDateString())->isoFormat('MMMM');
            // $datasurvey[] = Survey::whereDate('created_at', $date->toDateString())->first();
            $totalPartisipan = Partisipan::whereMonth('created_at', $month)->count();
            $datasurvey[] =  [
                'partisipan_count' => $totalPartisipan
            ];
          //  $datasurvey = Survey::withCount('partisipan')->whereDate('created_at', $date->toDateString())->first();
          }


        $ChartSurvey = [
            'labels' => $dateRange,
            'datasets' => [
              [
                'label' => "Partisipan",
                'borderColor' => "rgba(113, 76, 190, 0.9)",
                'borderWidth' => "1",
                'tension' => 1,
                'backgroundColor' => "rgba(113, 76, 190, 0.9)",
                'data' => collect($datasurvey)->pluck('partisipan_count')
              ]
            ],

        ];

          $data = [
            'ChartSurveyJson' => $ChartSurvey,
          ];



           $results = array(
            "data" =>  $data
          );
        //   dd(response()->json($results['data']->sortByDesc('urut')));

          return response()->json($results);

    }
}
