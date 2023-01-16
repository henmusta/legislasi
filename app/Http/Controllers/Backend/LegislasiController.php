<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Legislasi;
use App\Models\AgendaFile;
use App\Models\Agenda;
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


class LegislasiController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Data Legislasi";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Data Legislasi"],
        ];
        if ($request->ajax()) {
          $data = Legislasi::with('pengusul', 'tahapan');
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<div class="dropdown">
                <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                    Aksi <i class="mdi mdi-chevron-down"></i>
                </a>

                <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                    <a href="' . route('backend.legislasi.show', $row->id) . '" class="dropdown-item">Detail</a>
                    <a class="dropdown-item" href="legislasi/' . $row->id . '/edit">Ubah</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';

            })
            ->make(true);
        }

        return view('backend.legislasi.index', compact('config', 'page_breadcrumbs'));
    }

    public function create()
    {
      $config['page_title'] = "Tambah Legislasi";
      $page_breadcrumbs = [
        ['url' => route('backend.legislasi.index'), 'title' => "Daftar Legislasi"],
        ['url' => '#', 'title' => "Tambah Legislasi"],
      ];
      return view('backend.legislasi.create', compact('page_breadcrumbs', 'config'));
    }

    public function store(Request $request)
    {
        // dd($request);
          $validator = Validator::make($request->all(), [
            'tahapan_id' => 'required|integer',
            'keterangan' => 'required',
            'pengusul_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
          ]);

          if ($validator->passes()) {
            $data = Legislasi::create([
                'tahapan_id' => $request['tahapan_id'],
                'keterangan'  => $request['keterangan'],
                'pengusul_id' => $request['pengusul_id'],
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi'],
            ]);
            if($data->save()){
                $tahapan = LegislasiTahapanLegislasi::create([
                    'legislasi_id' => $data['id'],
                    'tahapan_legislasi_id'  =>   $request['tahapan_id'],
                    'keterangan' => $request['keterangan'],
                ]);

            }
            $response = response()->json($this->responseStore(true, route('backend.legislasi.index')));
          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }

    public function show($id)
    {
      $config['page_title'] = "Detail Legislasi";
      $page_breadcrumbs = [
        ['url' => route('backend.legislasi.index'), 'title' => "Detail Legislasi"],
        ['url' => '#', 'title' => "Detail Legislasi"],
      ];
      $legislasi = Legislasi::with('pengusul', 'tahapan')->findOrFail($id);
      $agenda = Agenda::with('agendafile')->where('legislasi_id', $legislasi['id'])->get();

      $data = [
        'legislasi' =>  $legislasi,
        'agenda' =>   $agenda
      ];
      return view('backend.legislasi.show', compact('page_breadcrumbs', 'config', 'data'));
    }


    public function edit($id)
    {

      $config['page_title'] = "Update Legislasi";

      $page_breadcrumbs = [
        ['url' => route('backend.legislasi.index'), 'title' => "Daftar Legislasi"],
        ['url' => '#', 'title' => "Update Legislasi"],
      ];
      $legislasi = Legislasi::with('pengusul', 'tahapan')->findOrFail($id);
      $data = [
        'legislasi' => $legislasi,
        'tahapan' => $legislasi['tahapan'],
        'pengusul' => $legislasi['pengusul']
      ];

      return view('backend.legislasi.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahapan_id' => 'required|integer',
            'keterangan' => 'required',
            'pengusul_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = Legislasi::find($id);
                $data->update([
                    'tahapan_id' => $request['tahapan_id'],
                    'keterangan'  => $request['keterangan'],
                    'pengusul_id' => $request['pengusul_id'],
                    'judul' => $request['judul'],
                    'deskripsi' => $request['deskripsi'],
                ]);
                if($data->update()){
                    $tahapan = LegislasiTahapanLegislasi::create([
                        'legislasi_id' => $id,
                        'tahapan_legislasi_id'  => $request['tahapan_id'],
                        'keterangan' => $request['keterangan'],
                    ]);
                }
                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.legislasi.index')));
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
      $data = Legislasi::where('judul', 'LIKE', '%' . $request->q . '%')
        ->leftJoin('tahapanlegislasi', 'tahapanlegislasi.id', '=', 'legislasi.tahapan_id')
        ->orderBy('judul')
        ->skip($offset)
        ->take($resultCount)
        ->selectRaw('legislasi.id, judul as text, tahapan_id, name')
        ->get();

      $count = Legislasi::where('judul', 'LIKE', '%' . $request->q . '%')
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

    public function destroy($id)
    {
        $data = Legislasi::findOrFail($id);
        $uploadcek = AgendaFile::where('legislasi_id', $id)->get();
        if (isset($data)) {
            if(isset($uploadcek)){
                foreach($uploadcek as $val){
                    Fileupload::deleteFile($val['name'], 'lampiran');
                    $uploaddel = AgendaFile::find($val['id']);
                    $uploaddel->delete();
                }
            }
            $data->delete();
            $response = response()->json($this->responseDelete(true));

        }
        return $response;
    }

}
