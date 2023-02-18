<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use App\Models\Wagon;
use App\Models\WaterHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $train = Train::count();
        $wagon = Wagon::count();
        $water = Train::sum(DB::raw('CAST(volume AS DECIMAL(10,2))'));
        $waterUsage = WaterHistory::sum(DB::raw('CAST(volume AS DECIMAL(10,2))'));

        return view('pages.home.index', compact('wagon', 'train', 'water', 'waterUsage'));
    }
}
