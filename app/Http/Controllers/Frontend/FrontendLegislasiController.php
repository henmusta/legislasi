<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Legislasi;
use App\Models\AgendaFile;
use App\Models\Agenda;
use App\Models\User;
use App\Models\Comment;
use App\Models\TahapanLegislasi;
use App\Models\LegislasiTahapanLegislasi;
use Carbon\Carbon;
use App\Models\Legi;
use App\Traits\ResponseStatus;
use App\Helpers\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Throwable;


class FrontendLegislasiController extends Controller
{

    use ResponseStatus;
    public function index(Request $request)
    {
        $config['page_title'] = "E-Legislasi";
        $page_breadcrumbs = [
          ['url' => route('home.index'), 'title' => "Home"],
          ['url' => '#', 'title' => "E-Legislasi"],
        ];
        $legislasi = Legislasi::with('pengusul', 'tahapan');
        $tahapan = TahapanLegislasi::withCount('legislasi')->get();
            $data = [
                'tahapan' => $tahapan,
                'last_legislasi' => $legislasi->orderBy('id', 'DESC')->limit(3)->get()
            ];

        if ($request->ajax()) {
          $data = Legislasi::with('pengusul', 'tahapan');
          return DataTables::of($data)

            ->addColumn('updated_date', function ($row) {
                return \Carbon\Carbon::parse($row->updated_at)->isoFormat('D MMMM Y');
            })
            ->make(true);
        }

        return view('frontend.legislasi.index', compact('config', 'page_breadcrumbs', 'data'));
    }

    public function show($id)
    {
      $legislasi = Legislasi::with('pengusul', 'tahapan')->findOrFail($id);
      $agenda = Agenda::with('agendafile','tahapan')->where('legislasi_id', $legislasi['id']);
      $tahapan = TahapanLegislasi::with(["agenda" => function($q) use($id){
        $q->where('agenda.legislasi_id', '=', $id);
       }])->get();

      $comment = Comment::where('legislasi_id', $legislasi['id'])->where('parent_id', '0')->get();
      foreach($comment as $key => $val){
        $comment[$key]['comment_child'] = Comment::where('parent_id', $val->id)->get();
      }

      $config['page_title'] = "RUU ". $legislasi['judul'];
      $page_breadcrumbs = [
        ['url' => route('home.index'), 'title' => "Home"],
        ['url' => '#', 'title' => "RUU ". $legislasi['judul']],
      ];

      $data = [
        'comment' => $comment,
        'legislasi' =>  $legislasi,
        'agenda' =>   $agenda->get(),
        'agenda_terakhir' => $agenda->orderBy('id', 'DESC')->limit(2)->get(),
        'tahapan' =>   $tahapan
      ];
      return view('frontend.legislasi.show', compact('page_breadcrumbs', 'config', 'data'));
    }

    public function store(Request $request)
    {
        // dd($request);
          $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'name' => 'required',
            'email' => 'required',
            'telp' => 'required',
            'comment' => 'required',
          ]);

          if ($validator->passes()) {

            $user = User::updateOrCreate(
                ['nik' => $request['nik']],
                [
                    'nik' => $request['nik'],
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'telp' => $request['telp'],
                    'jabatan_id' => 2,
                ]
            );
            $data = Comment::create([
                'user_id' => $user['id'],
                'legislasi_id' => $request['legislasi_id'],
                'nik' => $request['nik'],
                'name' => $request['name'],
                'email' => $request['email'],
                'telp' => $request['telp'],
                'comment' => $request['comment'],
            ]);
            $response = response()->json([
                'date' => \Carbon\Carbon::parse($data['created_at'])->isoFormat('D MMMM Y'),
                'data' => $data,
                'status' => 'success',
                'message' => 'Terkirim',
            ]);
          } else {
            $response = response()->json(['error' => $validator->errors()->all()]);
          }
          return $response;
    }

    public function countlegislasi(Request $request){

        $tahapan = TahapanLegislasi::withCount('legislasi')->get();
        $ChartTahapan = [
            'labels' => collect($tahapan)->pluck('name'),
            'datasets' => [
              [
                'label' => "Tahapan",
                'borderColor' => "#fff",
                'borderWidth' => "1",
                'tension' => 1,
                'backgroundColor' => ['#f0ad4e', '#3f903f', '#2e6da4', '#5bc0de', '#d9534f'],
                'data' => collect($tahapan)->pluck('legislasi_count')
              ]
            ],
        ];
        // $ChartJsonTahapan = json_encode($ChartTahapan);
        // dd($ChartJsonTahapan);

            $results = [
                'tahapan' => $tahapan,
                'paijsontahapan' => $ChartTahapan
            ];

          return response()->json($results);

    }

}
