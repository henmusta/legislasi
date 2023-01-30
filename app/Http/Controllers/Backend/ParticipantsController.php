<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partisipan;
use App\Models\PartisipanDetail;
use Carbon\Carbon;
use App\Traits\ResponseStatus;
use App\Helpers\FileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Throwable;
class ParticipantsController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Data Partisipan";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Data Partisipan"],
        ];
        if ($request->ajax()) {
            $survey_id =  $request['survey_id'];
            $data = Partisipan::with('survey')
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
                    <a href="' . route('backend.partisipan.show', $row->id) . '" class="dropdown-item">Detail</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';

            })
            ->make(true);
        }

        return view('backend.partisipan.index', compact('config', 'page_breadcrumbs'));
    }
    public function show($id)
    {
      $config['page_title'] = "Detail Partisipan";
      $page_breadcrumbs = [
        ['url' => route('backend.partisipan.index'), 'title' => "Detail Partisipan"],
        ['url' => '#', 'title' => "Detail Partisipan"],
      ];

      $partisipan = Partisipan::with('survey')->findOrFail($id);
      $partisipandetail =  PartisipanDetail::with('question')->where('participants_id', $partisipan['id'])->get();
      $data = [
        'partisipan' => $partisipan,
        'partisipandetail' => $partisipandetail,
        // // 'legislasi' =>$agenda['legislasi'],
        // 'file' =>$file
      ];

      return view('backend.partisipan.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function destroy($id)
    {
        $data = Partisipan::findOrFail($id);
        if ($data->delete()) {
          $response = response()->json($this->responseDelete(true));

        }
        return $response;
    }
}
