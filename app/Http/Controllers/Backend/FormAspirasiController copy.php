<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\FormAspirasi;
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

class FormAspirasiController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Form Aspirasi";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Form Aspirasi"],
        ];
        if ($request->ajax()) {
          $data = FormAspirasi::query();
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

        return view('backend.formaspirasi.index', compact('config', 'page_breadcrumbs'));
    }


    public function create()
    {
      $config['page_title'] = "Tambah Form Aspirasi";
      $page_breadcrumbs = [
        ['url' => route('backend.formaspirasi.index'), 'title' => "Daftar Form Aspirasi"],
        ['url' => '#', 'title' => "Tambah Form Aspirasi"],
      ];
      return view('backend.formaspirasi.create', compact('page_breadcrumbs', 'config'));
    }

    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            // 'name' => 'required|unique:dewan,name',
            // 'deskripsi' => 'required',
            'id_form' => 'required|unique:form_aspirasi,id_form',
            'name_form' => 'required|unique:form_aspirasi,name_form',
            'placeholder_form' => 'required|unique:form_aspirasi,placeholder_form',
            'type_form' => 'required',
            'html_form' => 'required',
            'sort' => 'required',
            'status' => 'required'
          ]);

          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $agenda = FormAspirasi::create([
                    // 'judul' => $request['judul'],
                    // 'legislasi_id' => $request['legislasi_id'],
                    // 'deskripsi'  => $request['deskripsi'],
                    // 'tahapan_id'=> $request['tahapan_id']
                    'id_form',
                    'name_form',
                    'placeholder_form',
                    'type_form',
                    'html_form',
                    'sort',
                    'status'
                ]);

                  DB::commit();
                  $response = response()->json($this->responseStore(true, route('backend.formaspirasi.index')));
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

}
