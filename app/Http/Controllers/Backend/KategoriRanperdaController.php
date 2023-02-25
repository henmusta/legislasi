<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\KategoriRanperda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class KategoriRanperdaController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Kategori Ranperda";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Kategori Ranperda"],
        ];

        if ($request->ajax()) {
          $data = KategoriRanperda::query();
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
                     data-bs-deskripsi="' . $row->deskripsi . '"
                    class="edit dropdown-item">Ubah</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';


            })
            ->make(true);
        }

        return view('backend.kategoriranperda.index', compact('config', 'page_breadcrumbs'));
    }


    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'name' => 'required|unique:kategoriranperda,name',
            'deskripsi' => 'required',
          ]);

          if ($validator->passes()) {
            KategoriRanperda::create([
              'name' => ucwords($request['name']),
              'deskripsi' => $request['deskripsi'],
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
            'name' => 'required|unique:kategoriranperda,name,'. $id,
            'deskripsi' => 'required',
          ]);

          if ($validator->passes()) {
            $data = KategoriRanperda::find($id);
            $data->update([
              'name' => ucwords($request['name']),
              'deskripsi' => $request['deskripsi']
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
        $data = KategoriRanperda::findOrFail($id);
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
      $provinsi_id = $request['provinsi_id'];
      $data = Kategoriranperda::where('name', 'LIKE', '%' . $request->q . '%')

        ->when($provinsi_id, function ($query, $provinsi_id) {
        return $query->where('provinsi_id', $provinsi_id);
        })
        ->orderBy('name')
        ->skip($offset)
        ->take($resultCount)
        ->selectRaw('id, name as text')
        ->get();

      $count = Kategoriranperda::where('name', 'LIKE', '%' . $request->q . '%')
        ->when($provinsi_id, function ($query, $provinsi_id) {
            return $query->where('provinsi_id', $provinsi_id);
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
