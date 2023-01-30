<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\KategoriSurvey;
use App\Models\Survey;
use Carbon\Carbon;
use App\Traits\ResponseStatus;
use App\Helpers\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
class QuestionController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Data Survey";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Data Survey"],
        ];
        if ($request->ajax()) {
          $survey_id =  $request['survey_id'];
          $data = Question::with('kategorisurvey','survey')
          ->when( $survey_id, function ($query, $survey_id) {
            return $query->where('survey_id',  $survey_id);
          });
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<div class="dropdown">
                <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                    Aksi <i class="mdi mdi-chevron-down"></i>
                </a>

                <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                    <a href="' . route('backend.agenda.show', $row->id) . '" class="dropdown-item">Detail</a>
                    <a class="dropdown-item" href="agenda/' . $row->id . '/edit">Ubah</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';

            })
            ->make(true);
        }

        return view('backend.question.index', compact('config', 'page_breadcrumbs'));
    }

    public function create(Request $request)
    {

      $config['page_title'] = "Tambah Agenda";
      $page_breadcrumbs = [
        ['url' => route('backend.agenda.index'), 'title' => "Daftar Agenda"],
        ['url' => '#', 'title' => "Tambah Agenda"],
      ];

      $kategori = KategoriSurvey::find($request['kategorisurvey_id']);
      $survey = Survey::find($request['survey_id']);
      $data = [
        'kategori' => $kategori,
        'survey' => $survey,
      ];

      return view('backend.question.create', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kategorisurvey_id' => 'required',
            'survey_id' => 'required',
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'e' => 'required'
          ]);


          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $agenda = Question::create([
                    'kategorisurvey_id' => $request['kategorisurvey_id'],
                    'survey_id' => $request['survey_id'],
                    'question' => $request['question'],
                    'a' => $request['a'],
                    'b' => $request['b'],
                    'c' => $request['c'],
                    'd' => $request['d'],
                    'e' => $request['e']
                ]);




                  DB::commit();
                  if(isset($request['cek']) && $request['cek'] != null){
                    $response = response()->json($this->responseStore(true, url('backend/survey/'.$request['survey_id'].'/edit')));
                  }else{
                    $response = response()->json($this->responseStore(true, route('backend.question.index')));
                  }
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

    public function destroy($id)
    {
        $data = Question::findOrFail($id);
        if ($data->delete()) {
          $response = response()->json($this->responseDelete(true));

        }
        return $response;
    }
}
