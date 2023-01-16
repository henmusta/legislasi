<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class KabupatenController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Kabupaten";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Kabupaten"],
        ];

        if ($request->ajax()) {
          $data = Kabupaten  ::with('provinsi');
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
                    data-bs-provinsi_id="' . $row->provinsi_id . '"
                    data-bs-provinsi_name="' . $row->provinsi->name . '"
                    class="edit dropdown-item">Ubah</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';
            })
            ->make(true);
        }

        return view('backend.kabupaten.index', compact('config', 'page_breadcrumbs'));
    }


    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'provinsi_id' => 'required|integer',
            'name' => 'required|unique:kabupaten,name',
          ]);

          if ($validator->passes()) {
            Kabupaten::create([
              'provinsi_id' => $request['provinsi_id'],
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



    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'provinsi_id' => 'required|integer',
            'name' => 'required|unique:kabupaten,name',
          ]);

          if ($validator->passes()) {
            $data = Kabupaten::find($id);
            $data->update([
                'provinsi_id' => $request['provinsi_id'],
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

    public function destroy($id)
    {
        $data = Kabupaten::findOrFail($id);
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
      $data = Kabupaten::where('name', 'LIKE', '%' . $request->q . '%')
        ->when($provinsi_id, function ($query, $provinsi_id) {
        return $query->where('provinsi_id', $provinsi_id);
        })
        ->orderBy('name')
        ->skip($offset)
        ->take($resultCount)
        ->selectRaw('id, name as text')
        ->get();

      $count = Kabupaten::where('name', 'LIKE', '%' . $request->q . '%')
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
