<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Outflow;
use App\Models\Train;
use App\Models\WaterLevel;

class HomeController extends Controller
{
    public function index()
    {
        $train = Train::count();
        $complaint = Complaint::count();

        return view('pages.home.index', compact('complaint', 'train'));
    }
}
