<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Helpers\FileUpload;
use App\Models\SettingsFront;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FrontendSettingsController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "Settings Logo";
        $page_breadcrumbs = [
          ['url' => '#', 'title' => "Daftar Settings Logo"],
        ];

        if ($request->ajax()) {
            $data = SettingsFront::query();
            return DataTables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function ($row) {
                $actionBtn = '<div class="dropdown">
                              <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi <i class="mdi mdi-chevron-down"></i>
                              </button>
                              <ul class="dropdown-menu">
                                 <li><a class="dropdown-item" href="settingsfront/' . $row->id . '/edit">Ubah</a></li>
                              </ul>
                            </div> ';
                return $actionBtn;
              })->editColumn('icon', function (SettingsFront $Settings) {
                $data = asset('assets/img/profile-photos/1.png');
                if(isset($Settings->icon)){
                 $data =  asset("/storage/images/logo/$Settings->icon");
                }
                return '<img class="rounded-circle" src="'.$data.'"alt="photo" style="width:75px; height: 75px;">';
              }) ->editColumn('sidebar_logo', function (SettingsFront $Settings) {
                $data = asset('assets/img/profile-photos/1.png');
                if(isset($Settings->sidebar_logo)){
                 $data =  asset("/storage/images/logo/$Settings->sidebar_logo");
                }
                return '<img class="rounded-circle" src="'.$data.'"alt="photo" style="width:75px; height: 75px;">';
              })->editColumn('favicon', function (SettingsFront $Settings) {
                $data = asset('assets/img/profile-photos/1.png');
                if(isset($Settings->favicon)){
                 $data =  asset("/storage/images/logo/$Settings->favicon");
                }
                return '<img class="rounded-circle" src="'.$data.'"alt="photo" style="width:75px; height: 75px;">';
              })

              ->rawColumns(['icon','sidebar_logo','favicon', 'action'])
              ->make(true);
          }
        return view('backend.settingsfront.index', compact('config', 'page_breadcrumbs'));
    }


    public function edit($id)
    {

      $config['page_title'] = "Edit Settings Logo";

      $page_breadcrumbs = [
        ['url' => route('backend.settings.index'), 'title' => "Settings Logo"],
        ['url' => '#', 'title' => "Edit Settings Logo"],
      ];
      $data = SettingsFront::findOrFail($id);

      return view('backend.settingsfront.edit', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'logo' => 'image|mimes:jpg,png,jpeg',
        'name' => 'required',
      ]);

      $data = SettingsFront::findOrFail($id);
      if ($validator->passes()) {
        $image = NULL;
        $dimensions = [array('300', '300', 'logo')];
        $dimensions_icon = [array('600', '600', 'logo')];
        $dimensions_sidebar_logo = [array('224', '66', 'logo')];

        try {
          DB::beginTransaction();
          if (isset($request['sidebar_logo']) && !empty($request['sidebar_logo'])) {
            $sidebar_logo = FileUpload::uploadImage('sidebar_logo', $dimensions_sidebar_logo, 'storage', $data['sidebar_logo']);
          } else {
            $sidebar_logo =  $data['sidebar_logo'];
          }
          if (isset($request['icon']) && !empty($request['icon'])) {
            $icon = FileUpload::uploadImage('icon', $dimensions_icon, 'storage', $data['icon']);
          } else {
            $icon =  $data['icon'];
          }
          if (isset($request['favicon']) && !empty($request['favicon'])) {
            $favicon = FileUpload::uploadImage('favicon', $dimensions, 'storage', $data['favicon']);
          } else {
            $favicon = $data['favicon'];
          }

          $data->update([
            'favicon' => $favicon,
            'icon' => $icon,
            'sidebar_logo' => $sidebar_logo,
            'name' => $request['name']
          ]);

          DB::commit();
          $response = response()->json($this->responseUpdate(true, route('backend.settingsfront.index')));
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
