<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\User;
use Carbon\Carbon;
use App\Traits\ResponseStatus;
use App\Helpers\FileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class FrontendPagesController extends Controller
{
    use ResponseStatus;
    public function index(Request $request, $name)
    {
        $config['page_title'] = $name;
        $page_breadcrumbs = [
          ['url' => route('home.index'), 'title' => "Home"],
          ['url' => '#', 'title' => $name],
        ];
        $pages = Pages::where('name', $name)->first();
            $data = [
                'page' =>  $pages,
            ];

        return view('frontend.pages.index', compact('config', 'page_breadcrumbs','data'));
    }

}
