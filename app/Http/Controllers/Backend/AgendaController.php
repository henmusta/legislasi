<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Legislasi;
use App\Models\Agenda;
use App\Models\TahapanLegislasi;
use App\Models\AgendaFile;
use App\Models\LegislasiTahapanLegislasi;
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

class AgendaController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Data Agenda";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Data Agenda"],
        ];
        if ($request->ajax()) {
          $legislasi_id =  $request['legislasi_id'];
          $data = Agenda::with('tahapan','legislasi')->select('agenda.*')
          ->when( $legislasi_id, function ($query,   $legislasi_id) {
            return $query->where('legislasi_id',  $legislasi_id);
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

        return view('backend.agenda.index', compact('config', 'page_breadcrumbs'));
    }

    public function create(Request $request)
    {

      $config['page_title'] = "Tambah Agenda";
      $page_breadcrumbs = [
        ['url' => route('backend.agenda.index'), 'title' => "Daftar Agenda"],
        ['url' => '#', 'title' => "Tambah Agenda"],
      ];

      $tahapan = TahapanLegislasi::find($request['tahapan_id']);
      $legislasi = Legislasi::find($request['legislasi_id']);
      $data = [
        'tahapan' => $tahapan,
        'legislasi' => $legislasi,
      ];

    //   $data = [
    //     'legislasi' => $request['legislasi_id'] ?? null,
    //     'tahapan' => $request['tahapan_id'] ?? null,
    //   ];
      return view('backend.agenda.create', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'legislasi_id' => 'required',
            'tahapan_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
          ]);


          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $agenda = Agenda::create([
                    'judul' => $request['judul'],
                    'legislasi_id' => $request['legislasi_id'],
                    'deskripsi'  => $request['deskripsi'],
                    'tahapan_id'=> $request['tahapan_id']
                ]);


                if(isset($agenda['id']) && isset($request['file'])){
                    foreach($request['file'] as $row){
                        $file = $row['lampiran'];
                        $lampiranURL = Fileupload::uploadFileMultiple( $file, 'lampiran');
                        AgendaFile::create([
                            'name' => $lampiranURL,
                            'keterangan' => $row['keterangan'],
                            'legislasi_id' => $request['legislasi_id'],
                            'agenda_id' => $agenda['id'],
                        ]);
                    }

                }

                  DB::commit();
                  if(isset($request['cek']) && $request['cek'] != null){
                    $response = response()->json($this->responseStore(true, url('backend/legislasi/'.$request['legislasi_id'].'/edit')));
                  }else{
                    $response = response()->json($this->responseStore(true, route('backend.agenda.index')));
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

    public function edit($id)
    {

      $config['page_title'] = "Update Agenda";

      $page_breadcrumbs = [
        ['url' => route('backend.legislasi.index'), 'title' => "Daftar Agenda"],
        ['url' => '#', 'title' => "Update Agenda"],
      ];
      $agenda = Agenda::with('tahapan','legislasi')->findOrFail($id);
      $file =  AgendaFile::where('agenda_id', $agenda['id'])->get();
      $data = [
        'agenda' => $agenda,
        'tahapan' => $agenda['tahapan'],
        'legislasi' =>$agenda['legislasi'],
        'file' =>$file
      ];

      return view('backend.agenda.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function show($id)
    {
      $config['page_title'] = "Detail Agenda";
      $page_breadcrumbs = [
        ['url' => route('backend.agenda.index'), 'title' => "Detail Agenda"],
        ['url' => '#', 'title' => "Detail Agenda"],
      ];

      $agenda = Agenda::with('tahapan','legislasi')->findOrFail($id);
      $file =  AgendaFile::where('agenda_id', $agenda['id'])->get();
      $data = [
        'agenda' => $agenda,
        'tahapan' => $agenda['tahapan'],
        'legislasi' =>$agenda['legislasi'],
        'file' =>$file
      ];

      return view('backend.agenda.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'legislasi_id' => 'required',
            'tahapan_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
          ]);
          if ($validator->passes()) {
            $data = Agenda::find($id);
            DB::beginTransaction();
            try {
                  $data->update([
                    'judul' => $request['judul'],
                    'legislasi_id' => $request['legislasi_id'],
                    'deskripsi'  => $request['deskripsi'],
                    'tahapan_id'=> $request['tahapan_id']
                  ]);
                  $uploadcek = AgendaFile::where('agenda_id', $id)->get();
                  if(isset($request['file'])){
                    $idcek = array();
                    foreach($request['file'] as $row){
                        if(isset($row['id'])){
                            $idcek[] =$row['id'];
                            $dataupload = AgendaFile::find($row['id']);
                            if(isset( $dataupload)){
                                $dataupload->update([
                                'keterangan' => $row['keterangan'],
                                ]);
                            }
                        }else{

                            $file = $row['lampiran'];
                            $lampiranURL = Fileupload::uploadFileMultiple( $file, 'lampiran');

                            $newdata = AgendaFile::create([
                                'name' => $lampiranURL,
                                'keterangan' => $row['keterangan'],
                                'pelaporan_id' => $data['id'],
                            ]);
                            $idcek[] = $newdata['id'];
                        }
                    }
                  $delcek = AgendaFile::whereNotIn('id', $idcek)->where('agenda_id', $id)->get();
                  if(isset($delcek)){
                        foreach($delcek as $val){
                            Fileupload::deleteFile($val['name'], 'lampiran');
                            $uploaddel = AgendaFile::find($val['id']);
                            $uploaddel->delete();
                        }
                    }

                  }else if(isset($uploadcek)){
                    foreach($uploadcek as $val){
                        Fileupload::deleteFile($val['name'], 'lampiran');
                        $uploaddel = AgendaFile::find($val['id']);
                        $uploaddel->delete();
                    }
                  }
                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.agenda.index')));
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
        $data = Agenda::findOrFail($id);
        $uploadcek = AgendaFile::where('agenda_id', $id)->get();
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
