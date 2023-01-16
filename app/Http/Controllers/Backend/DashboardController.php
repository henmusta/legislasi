<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
      $config['page_title'] = "Dashboard";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "Dashboard"],
      ];
      return view('backend.dashboard.index', compact('config', 'page_breadcrumbs'));
    }


}
