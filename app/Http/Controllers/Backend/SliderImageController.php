<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SliderImage;
use App\Models\MenuPermission;
use App\Helpers\FileUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ResponseStatus;

class SliderImageController extends Controller
{
    use ResponseStatus;

    function __construct()
    {
      // $this->middleware('can:backend-users-list', ['only' => ['index', 'show']]);
      // $this->middleware('can:backend-users-create', ['only' => ['create', 'store']]);
      // $this->middleware('can:backend-users-edit', ['only' => ['edit', 'update']]);
      // $this->middleware('can:backend-users-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
      $config['page_title'] = "Slider Image";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "Slider Image"],
      ];

      if ($request->ajax()) {
        $data = SliderImage::query();
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
              return '<div class="dropdown">
                      <a href="#" class="btn btn-secondary" data-bs-toggle="dropdown">
                          Aksi <i class="mdi mdi-chevron-down"></i>
                      </a>

                      <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                          <a class="dropdown-item" href="imageslider/' . $row->id . '/edit">Ubah</a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete" data-bs-id="' . $row->id . '" class="delete dropdown-item">Hapus</a>
                      </div>
                  </div>';

          })
          ->editColumn('image', function (SliderImage $sliderimage) {
             $data = asset('assets/backend/images/noimg.png');
            if(isset($sliderimage->image)){
             $data =  asset("/storage/images/slider/$sliderimage->image");
            }
            return '<img  src="'.$data.'"alt="photo" style="width:150px; height: 50px;">';
          })
          ->rawColumns(['image', 'action'])
          ->make(true);
      }
      return view('backend.sliderimage.index', compact('config', 'page_breadcrumbs'));
    }

    public function create()
    {
      $config['page_title'] = "Tambah Slider Image";
      $page_breadcrumbs = [
        ['url' => route('backend.imageslider.index'), 'title' => "Daftar Slider Image"],
        ['url' => '#', 'title' => "Tambah Slider Image"],
      ];
      return view('backend.sliderimage.create', compact('page_breadcrumbs', 'config'));
    }

    public function store(Request $request)
    {
        // dd($request);
      $validator = Validator::make($request->all(), [
        'image' => 'image|mimes:jpg,png,jpeg',
        'judul' => 'required',
        'deskripsi' => 'required',
        'menu_permission_id' => 'required',
        'urut' => 'required',
      ]);


      if ($validator->passes()) {
        $image = NULL;
        $dimensions = [array('1920', '900', 'slider')];
        try {
          $img = isset($request->image) && !empty($request->image) ? FileUpload::uploadImage('image', $dimensions) : NULL;
          $data = SliderImage::create([
            'image' => $img,
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            'menu_permission_id' => $request['menu_permission_id'],
            'urut' => $request['urut']
        ]);
          DB::commit();
          $response = response()->json($this->responseUpdate(true, route('backend.imageslider.index')));
        } catch (\Throwable $e) {
          dd($e);
          DB::rollback();
          $response = response()->json($this->responseUpdate(false));
        }
      } else {
        $response = response()->json(['error' => $validator->errors()->all()]);
      }

      return $response;
    }

    public function edit($id)
    {

      $config['page_title'] = "Edit Slider Image";

      $page_breadcrumbs = [
        ['url' => route('backend.imageslider.index'), 'title' => "Slider Image"],
        ['url' => '#', 'title' => "Edit Slider Image"],
      ];
      $sliderimage = SliderImage::findOrFail($id);
      $menu = MenuPermission::find($sliderimage['menu_permission_id']);
      $data = [
        'sliderimage' => $sliderimage,
        'menu' => $menu
      ];

      return view('backend.sliderimage.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
      $validator = Validator::make($request->all(), [
        'image' => 'image|mimes:jpg,png,jpeg',
        'judul' => 'required',
        'deskripsi' => 'required',
        'menu_permission_id' => 'required',
        'urut' => 'required',
      ]);

      $data = SliderImage::findOrFail($id);
      if ($validator->passes()) {
        $image = NULL;
        $dimensions = [array('1920', '900', 'slider')];
        try {
          DB::beginTransaction();
          if (isset($request['image']) && !empty($request['image'])) {
            $img = FileUpload::uploadImage('image', $dimensions, 'storage', $data['image']);
          } else {
            $img =  $data['image'];
          }


          $data->update([
            'image' => $img,
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            'menu_permission_id' => $request['menu_permission_id'],
            'urut' => $request['urut']
          ]);

          DB::commit();
          $response = response()->json($this->responseUpdate(true, route('backend.imageslider.index')));
        } catch (\Throwable $e) {
          dd($e);
          DB::rollback();
          $response = response()->json($this->responseUpdate(false));
        }
      } else {
        $response = response()->json(['error' => $validator->errors()->all()]);
      }

      return $response;
    }

}
