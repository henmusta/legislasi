<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class KecamatanController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Kecamatan";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Kecamatan"],
        ];

        if ($request->ajax()) {
          $data = Kecamatan::with('kabupaten')->where('id', '!=', '6998');
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
                    data-bs-kabupaten_id="' . $row->kabupaten_id . '"
                    data-bs-kabupaten_name="' . $row->kabupaten->name . '"
                    class="edit dropdown-item">Ubah</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';
            })
            ->make(true);
        }

        return view('backend.kecamatan.index', compact('config', 'page_breadcrumbs'));
    }


    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'kabupaten_id' => 'required|integer',
            'name' => 'required|unique:kecamatan,name',
          ]);

          if ($validator->passes()) {
            $data = Kecamatan::find($id);
            $data->update([
                'kabupaten_id' => $request['kabupaten_id'],
                'name' => ucwords($request['name']),
            ]);
            // if($data->slug != 'super-admin'){
            //   $data->update([
            //     'name' => ucwords($request['name']),
            //   ]);
            // }
            $response = response()->json([
              'status' => 'success',
              'message' => 'Data berhasil diubah',
            ]);
          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }


    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'kabupaten_id' => 'required|integer',
            'name' => 'required|unique:kecamatan,name',
          ]);

          if ($validator->passes()) {
            Kecamatan::create([
              'kabupaten_id' => $request['kabupaten_id'],
              'name' => ucwords($request['name']),
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

    public function select2(Request $request)
    {
      $page = $request->page;
      $resultCount = 10;
      $offset = ($page - 1) * $resultCount;
      $kabupaten_id = $request['kabupaten_id'];
      $data = Kecamatan::where('name', 'LIKE', '%' . $request->q . '%')
        ->where('id', '!=', '6998')
        ->when($kabupaten_id, function ($query, $kabupaten_id) {
        return $query->where('kabupaten_id', $kabupaten_id);
        })
        ->orderBy('name')
        ->skip($offset)
        ->take($resultCount)
        ->selectRaw('id, name as text')
        ->get();

      $count = Kecamatan::where('name', 'LIKE', '%' . $request->q . '%')
      ->where('id', '!=', '6998')
      ->when($kabupaten_id, function ($query, $kabupaten_id) {
        return $query->where('kabupaten_id', $kabupaten_id);
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

    public function destroy($id)
    {
        $data = Kecamatan::findOrFail($id);
        if ($data->delete()) {
          $response = response()->json($this->responseDelete(true));

        }
        return $response;
    }
}
