<?php

namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;
use App\Models\TahapanLegislasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class TahapanLegislasiController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Tahapan Legislasi";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Tahapan Legislasi"],
        ];

        if ($request->ajax()) {
          $data = TahapanLegislasi::query();
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<div class="dropdown">
                <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                    Aksi <i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu" data-popper-placement="bottom-start" >
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalEdit"
                    data-bs-id="' . $row->id . '"
                    data-bs-name="' . $row->name . '"
                    data-bs-icon="' . $row->icon . '"
                    data-bs-badge="' . $row->badge . '"
                    class="edit dropdown-item">Ubah</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';


            })
            ->make(true);
        }

        return view('backend.tahapanlegislasi.index', compact('config', 'page_breadcrumbs'));
    }



    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tahapanlegislasi,name',
          ]);

          if ($validator->passes()) {
            TahapanLegislasi::create([
              'name' => ucwords($request['name']),
              'icon' => $request['icon'],
              'badge' => $request['badge'],
            ]);

            $response = response()->json([
              'status' => 'success',
              'message' => 'Data berhasil disimpan'
            ]);
          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tahapanlegislasi,name,' . $id,
          ]);

          if ($validator->passes()) {
            $data = TahapanLegislasi::find($id);
            $data->update([
              'name' => ucwords($request['name']),
              'icon' => $request['icon'],
              'badge' => $request['badge'],
            ]);
            $response = response()->json([
              'status' => 'success',
              'message' => 'Data berhasil diubah',
            ]);
          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }

    public function destroy($id)
    {
        $data = TahapanLegislasi::findOrFail($id);
        if ($data->delete()) {
          $response = response()->json($this->responseDelete(true));

        }
        return $response;
    }

    public function select2(Request $request)
    {
      $page = $request->page;
      $resultCount = 10;
      $offset = ($page - 1) * $resultCount;
      $data = TahapanLegislasi::where('name', 'LIKE', '%' . $request->q . '%')
        ->orderBy('name')
        ->skip($offset)
        ->take($resultCount)
        ->selectRaw('id, name as text')
        ->get();

      $count = TahapanLegislasi::where('name', 'LIKE', '%' . $request->q . '%')
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
