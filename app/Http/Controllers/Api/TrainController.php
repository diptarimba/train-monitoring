<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Train;
use Illuminate\Http\Request;

class TrainController extends Controller
{
    public function index()
    {
        $train = Train::select('id', 'name')->get();
        return response()->json([
            'message' => 'Retrieve Train List',
            'data' => $train
        ], 200);
    }

    public function wagon(Train $train)
    {
        return response()->json([
            'message' => 'Retrieve Train ' . $train->name. ' Wagon List',
            'data' => $train->wagon()->select('id', 'name')->get()
        ], 200);
    }
}
