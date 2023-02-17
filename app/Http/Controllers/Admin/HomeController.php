<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use App\Models\Wagon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $train = Train::count();
        $wagon = Wagon::count();
        $water = Train::sum('volume');

        return view('pages.home.index', compact('wagon', 'train', 'water'));
    }
}
