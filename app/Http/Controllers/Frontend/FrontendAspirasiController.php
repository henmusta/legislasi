<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\FormAspirasi;
use App\Models\User;
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


class FrontendAspirasiController extends Controller
{
    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "E-Aspirasi";
        $page_breadcrumbs = [
          ['url' => route('home.index'), 'title' => "Home"],
          ['url' => '#', 'title' => "E-Aspirasi"],
        ];
        $fromaspirasi = FormAspirasi::all();
            $data = [
                'form' =>  $fromaspirasi,
            ];

        // if ($request->ajax()) {
        //   $data = Legislasi::with('pengusul', 'tahapan');
        //   return DataTables::of($data)

        //     ->addColumn('updated_date', function ($row) {
        //         return \Carbon\Carbon::parse($row->updated_at)->isoFormat('D MMMM Y');
        //     })
        //     ->make(true);
        // }

        return view('frontend.aspirasi.index', compact('config', 'page_breadcrumbs','data'));
    }


    public function store(Request $request)
    {
        // dd( $request);
        $validasi = [];
        $fromaspirasi = FormAspirasi::query()->get();
        foreach($fromaspirasi as $val){
           if($val->status == '1'){
            $validasi[$val->name] = 'required';
           }
        }
        // dd($validasi);
        $validator = Validator::make($request->all(),$validasi);
          if ($validator->passes()) {
            DB::beginTransaction();
            try {

                $user = User::updateOrCreate(
                    ['nik' => $request['nik']],
                    [
                        'nik' => $request['nik'],
                        'name' => $request['name'],
                        'email' => $request['nik'].'@gmail.com',
                        'telp' => $request['telp'],
                        'jabatan_id' => 7,
                    ]
                );



                $aspirasi = Aspirasi::create([
                    'tgl_buat' => Carbon::now(),
                    'user_id' => $user['id'],
                    'nik' => $request['nik'],
                    'name' => ucwords($request['name']),
                    'telp' => $request['telp'],
                    'kabupaten' =>  $request['kabupaten'],
                    'kecamatan' =>  $request['kecamatan'],
                    'alamat'=>  $request['alamat'],
                    'aspirasi' =>  $request['aspirasi'],
                    'komisi' =>  $request['komisi'],
                    'isu' =>  $request['isu'],
                    'urusan' =>  $request['urusan'],
                    'skpd' =>  $request['skpd'],
                    'anggaran'=>  $request['anggaran'],
                    'sasaran'=>  $request['sasaran'],
                    // 'lampiran'=>  $request['lampiran'],
                    'dewan'=>  $request['dewan']
                ]);


                if(isset($aspirasi['id']) && isset($request['lampiran'])){
                    $file = $request['lampiran'];
                    $lampiranURL = Fileupload::uploadFileMultiple($file, 'lampiran');
                    $aspirasi->update([
                        'lampiran' => $lampiranURL
                    ]);
                }
                  DB::commit();
                  $response = response()->json($this->responseStore(true, route('e-aspirasi.show', $aspirasi['id'])));
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

    public function show($id)
    {


      $config['page_title'] = "E-aspirasi";
      $page_breadcrumbs = [
        ['url' => route('home.index'), 'title' => "Detail Legislasi"],
        ['url' => '#', 'title' => "Detail Legislasi"],
      ];
      $aspirasi = Aspirasi::findOrFail($id);
      $data = [
        'aspirasi' => $aspirasi,
      ];

      return view('frontend.aspirasi.show', compact('page_breadcrumbs', 'config', 'data'));
    }

}
