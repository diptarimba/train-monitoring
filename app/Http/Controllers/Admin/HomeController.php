<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outflow;
use App\Models\Train;
use App\Models\Wagon;
use App\Models\WaterLevel;

class HomeController extends Controller
{
    public function index()
    {
        $train = Train::count();
        $wagon = Wagon::count();
        $waterAvailable = WaterLevel::orderByDesc('created_at')->get()->groupBy('wagon_id')->sum(function($each){
            return $each[0]->sum('value');
        });
        $waterUsage = Outflow::orderByDesc('created_at')->get()->groupBy('wagon_id')->sum(function($each){
            return $each[0]->sum('value');
        });

        return view('pages.home.index', compact('wagon', 'train', 'waterAvailable', 'waterUsage'));
    }
}
