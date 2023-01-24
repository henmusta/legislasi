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
                return ' <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#modalEdit"
                data-bs-id="' . $row->id . '"
                data-bs-status="' . $row->status . '"
               class="btn btn-primary">Ubah</a>';

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

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
          ]);

          if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = FormAspirasi::find($id);
                $data->update([
                    'status' => $request['status']
                ]);
                DB::commit();
                $response = response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil diubah',
                  ]);
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
