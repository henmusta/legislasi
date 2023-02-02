<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pages;
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

class PagesController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Pages";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Data Pages"],
        ];
        if ($request->ajax()) {
          $data = Pages::query();
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<div class="dropdown">
                <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                    Aksi <i class="mdi mdi-chevron-down"></i>
                </a>

                <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                    <a href="' . route('backend.page.show', $row->id) . '" class="dropdown-item">Detail</a>
                    <a class="dropdown-item" href="page/' . $row->id . '/edit">Ubah</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';

            })
            ->make(true);
        }

        return view('backend.page.index', compact('config', 'page_breadcrumbs'));
    }

    public function create()
    {
      $config['page_title'] = "Tambah Pages";
      $page_breadcrumbs = [
        ['url' => route('backend.page.index'), 'title' => "Daftar Pages"],
        ['url' => '#', 'title' => "Tambah Pages"],
      ];
      return view('backend.page.create', compact('page_breadcrumbs', 'config'));
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'judul' => 'required',
        'name' => 'required',
        'deskripsi' => 'required',
      ]);

      if ($validator->passes()) {
        DB::beginTransaction();
        try {
            $data = Pages::create([
                'name' => ucwords($request['name']),
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi']
            ]);

          DB::commit();
        $response = response()->json($this->responseStore(true, route('backend.page.index')));
        } catch (Throwable $throw) {
          dd($throw);
          DB::rollBack();
          $response = $throw;
        }
      } else {
        $response = response()->json(['error' => $validator->errors()->all()]);
      }
      return $response;
    }

    public function show($id)
    {
      $config['page_title'] = "Detail Pages";
      $page_breadcrumbs = [
        ['url' => route('backend.page.index'), 'title' => "Detail Pages"],
        ['url' => '#', 'title' => "Detail Pages"],
      ];

      $pages = Pages::findOrFail($id);
     // $file =  AgendaFile::where('agenda_id', $agenda['id'])->get();
      $data = [
        'page' => $pages,
      ];

      return view('backend.page.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function destroy($id)
    {
        $data = Pages::findOrFail($id);
        if ($data->delete()) {
          $response = response()->json($this->responseDelete(true));

        }
        return $response;
    }

    public function edit($id)
    {

      $config['page_title'] = "Edit Pages";

      $page_breadcrumbs = [
        ['url' => route('backend.page.index'), 'title' => "Daftar Pages"],
        ['url' => '#', 'title' => "Edit Pages"],
      ];
       $pages = Pages::findOrFail($id);
       $data = [
         'page' => $pages,
       ];

      return view('backend.page.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'name' => 'required',
            'deskripsi' => 'required',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = Pages::find($id);
                $data->update([
                    'name' => ucwords($request['name']),
                    'judul' => $request['judul'],
                    'deskripsi' => $request['deskripsi']
                ]);

                DB::commit();
                $response = response()->json($this->responseStore(true, route('backend.page.index')));
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
