<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Comment;
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

class CommentController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Data Feedback";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Data Feedback"],
        ];
        if ($request->ajax()) {
          $data = Comment::with('legislasi')->select('comment.*');
        //   ->when( $legislasi_id, function ($query,   $legislasi_id) {
        //     return $query->where('legislasi_id',  $legislasi_id);
        //   });
          return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<div class="dropdown">
                <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                    Aksi <i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                    <a href="' . route('backend.feedback.show', $row->id) . '" class="dropdown-item">Detail</a>

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                </div>
            </div>';

            })
            ->make(true);
        }

        return view('backend.feedback.index', compact('config', 'page_breadcrumbs'));
    }

    public function show($id)
    {
      $config['page_title'] = "Detail Comment";
      $page_breadcrumbs = [
        ['url' => route('backend.feedback.index'), 'title' => "Detail Comment"],
        ['url' => '#', 'title' => "Detail Comment"],
      ];
      $comment = Comment::with('legislasi')->findOrFail($id);

    //   dd( $aspirasi);
      $data = [
        'comment' => $comment,
      ];

      return view('backend.feedback.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function destroy($id)
    {
        $data = Comment::findOrFail($id);
        if ($data->delete()) {
          $response = response()->json($this->responseDelete(true));

        }
        return $response;
    }
}
