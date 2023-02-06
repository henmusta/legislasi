<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use Carbon\Carbon;
use App\Models\Legi;
use App\Traits\ResponseStatus;
use App\Helpers\FileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class SurveyController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Data Survey";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Data Survey"],
        ];
        if ($request->ajax()) {
          $data = Survey::with('kategorisurvey');
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<div class="dropdown">
                <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                    Aksi <i class="mdi mdi-chevron-down"></i>
                </a>

                <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                    <a href="' . route('backend.survey.show', $row->id) . '" class="dropdown-item">Detail</a>
                    <a class="dropdown-item" href="survey/' . $row->id . '/edit">Update</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';

            })
            ->make(true);
        }

        return view('backend.survey.index', compact('config', 'page_breadcrumbs'));
    }

    public function create()
    {
      $config['page_title'] = "Tambah Survey";
      $page_breadcrumbs = [
        ['url' => route('backend.survey.index'), 'title' => "Daftar Survey"],
        ['url' => '#', 'title' => "Tambah Survey"],
      ];
      return view('backend.survey.create', compact('page_breadcrumbs', 'config'));
    }


    public function store(Request $request)
    {
        // dd($request);
          $validator = Validator::make($request->all(), [
            'kategorisurvey_id' => 'required|integer',
            'name' => 'required',
            'deskripsi' => 'required',
          ]);

          if ($validator->passes()) {
            $data = Survey::create([
                'kategorisurvey_id' => $request['kategorisurvey_id'],
                'name' => $request['name'],
                'deskripsi' => $request['deskripsi']
            ]);

            $response = response()->json($this->responseStore(true, route('backend.survey.index')));
          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }

    public function edit($id)
    {

      $config['page_title'] = "Update Survey";

      $page_breadcrumbs = [
        ['url' => route('backend.survey.index'), 'title' => "Daftar Survey"],
        ['url' => '#', 'title' => "Update Survey"],
      ];
      $survey = Survey::with('kategorisurvey')->findOrFail($id);
      $data = [
        'survey' => $survey,
        'kategori' => $survey['kategorisurvey'],
      ];

      return view('backend.survey.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kategorisurvey_id' => 'required|integer',
            'name' => 'required',
            'deskripsi' => 'required',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = Survey::find($id);
                $data->update([
                    'kategorisurvey_id' => $request['kategorisurvey_id'],
                    'name' => $request['name'],
                    'deskripsi' => $request['deskripsi']
                ]);
                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.survey.index')));
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


    public function select2(Request $request)
    {
      $page = $request->page;
      $resultCount = 10;
      $offset = ($page - 1) * $resultCount;
      $kategorisurvey_id = $request['kategorisurvey_id'];
      $data = Survey::where('survey.name', 'LIKE', '%' . $request->q . '%')
        ->leftJoin('kategorisurvey', 'survey.kategorisurvey_id', '=', 'kategorisurvey.id')
        ->when($kategorisurvey_id, function ($query, $kategorisurvey_id) {
          return $query->where('survey.kategorisurvey_id', $kategorisurvey_id);
         })
        ->orderBy('survey.name')
        ->skip($offset)
        ->take($resultCount)
        ->selectRaw('survey.id as id, survey.name as text, kategorisurvey.id as id_kategori, kategorisurvey.name as name_kategori')
        ->get();

      $count = Survey::where('survey.name', 'LIKE', '%' . $request->q . '%')
        ->leftJoin('kategorisurvey', 'survey.kategorisurvey_id', '=', 'kategorisurvey.id')
        ->when($kategorisurvey_id, function ($query, $kategorisurvey_id) {
            return $query->where('survey.kategorisurvey_id', $kategorisurvey_id);
        })
        ->get()
        ->count();

      $endCount = $offset + $resultCount;
      $morePages = $count > $endCount;

      $results = array(
        "results" => $data,
        "pagination" => array(
          "more" => $morePages
        )
      );

      return response()->json($results);
    }
}
