<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
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


class AspirasiController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Data Aspirasi";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Data Aspirasi"],
        ];
        if ($request->ajax()) {
          $data = Aspirasi::with('get_dewan','get_skpd', 'get_kabupaten', 'get_kecamatan');
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<div class="dropdown">
                <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                    Aksi <i class="mdi mdi-chevron-down"></i>
                </a>

                <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                    <a href="' . route('backend.aspirasi.show', $row->id) . '" class="dropdown-item">Detail</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';

            })
            ->make(true);
        }

        return view('backend.aspirasi.index', compact('config', 'page_breadcrumbs'));
    }

    public function show($id)
    {
      $config['page_title'] = "Detail Aspirasi";
      $page_breadcrumbs = [
        ['url' => route('backend.aspirasi.index'), 'title' => "Detail Aspirasi"],
        ['url' => '#', 'title' => "Detail Aspirasi"],
      ];
      $aspirasi = Aspirasi::with('get_dewan','get_skpd', 'get_kabupaten', 'get_kecamatan')->findOrFail($id);
    //   dd( $aspirasi);
      $data = [
        'aspirasi' =>  $aspirasi,
      ];

      return view('backend.aspirasi.show', compact('page_breadcrumbs', 'config', 'data'));
    }
}
