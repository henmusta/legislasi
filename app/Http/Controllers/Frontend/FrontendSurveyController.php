<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Partisipan;
use App\Models\PartisipanDetail;
use App\Models\User;
use App\Models\Question;
use App\Traits\ResponseStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Throwable;
class FrontendSurveyController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "E-Survey";
        $page_breadcrumbs = [
          ['url' => route('home.index'), 'title' => "Home"],
          ['url' => '#', 'title' => "E-Aspirasi"],
        ];
        $survey = Survey::query()->where('status', '1')->get();
        // dd($survey);
            $data = [
                'survey' =>  $survey,
            ];

        return view('frontend.survey.index', compact('config', 'page_breadcrumbs','data'));
    }

    public function edit($id)
    {
      $config['page_title'] = "Survey";

      $page_breadcrumbs = [
        ['url' => route('backend.survey.index'), 'title' => "Daftar Survey"],
        ['url' => '#', 'title' => "Update Survey"],
      ];
      $survey = Survey::with('kategorisurvey')->where('status', '1')->findOrFail($id);
      $question = Question::with('questiondetail')->where([
        ['survey_id' , $id],
        ['kategorisurvey_id' , $survey['kategorisurvey']['id']]
      ])->get();
      $data = [
        'survey' => $survey,
        'question' => $question,
        'kategori' => $survey['kategorisurvey'],
      ];

      return view('frontend.survey.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function store(Request $request)
    {
// dd($request);
          $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'name' => 'required',
            'email' => 'required',
            'telp' => 'required',
            'params' => 'required',
          ]);

          if ($validator->passes()) {
            DB::beginTransaction();
            try {

                $user = User::updateOrCreate(
                    ['nik' => $request['nik']],
                    [
                        'nik' => $request['nik'],
                        'name' => $request['name'],
                        'email' => $request['nik'].'@gmail.com',
                        'telp' => $request['telp'],
                        'jabatan_id' => 7,
                    ]
                );
                $partisipan = Partisipan::create([
                    'kategorisurvey_id'=> $request['kategorisurvey_id'],
                    'survey_id'=> $request['survey_id'],
                    'user_id'=> $user['id'],
                    'name' => ucwords($request['name']),
                    'email'  => $request['email'],
                    'nik'   => $request['nik'],
                    'telp' => $request['telp'],
                ]);


                foreach($request['params'] as $key => $val){

                    // dd($val);
                    $answer = 'answer_'.$val['question_id'];
                    $partisipandetail = PartisipanDetail::create([
                        'participants_id' =>  $partisipan['id'],
                        'question_id' =>  $val['question_id'],
                        'answer' =>  $val[$answer],
                    ]);
                }


                  DB::commit();
                  $response = response()->json($this->responseStore(true, route('e-survey.show',  $partisipan['id'])));
            } catch (Throwable $throw) {
                dd($throw);
                DB::rollBack();
                $response = response()->json($this->responseStore(false));
            }

          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }

    public function show($id)
    {


      $config['page_title'] = "E-Survey";
      $page_breadcrumbs = [
        ['url' => route('home.index'), 'title' => "Detail Survey"],
        ['url' => '#', 'title' => "Detail Survey"],
      ];
      $partisipan = Partisipan::findOrFail($id);
      $data = [
        'partisipan' => $partisipan,
      ];

      return view('frontend.survey.show', compact('page_breadcrumbs', 'config', 'data'));
    }
}
