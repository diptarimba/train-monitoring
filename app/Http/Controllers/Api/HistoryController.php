<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Outflow;
use App\Models\WaterLevel;
use App\Models\Waterways;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function water_outflow(Request $request)
    {
        $request->validate([
            'water_way_id' => 'required|exists:waterways,id',
            'value' => 'required',
            'open_date' => 'required|date_format:Y-m-d H:i:s',
            'close_date' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $wagonId = Waterways::whereid($request->water_way_id)->first()->id;

        $outflow = Outflow::create(array_merge(['wagon_id' => $wagonId],$request->all()));

        return response()->json([
            'message' => 'Outflow Received'
        ], 200);
    }

    public function water_level(Request $request)
    {
        $request->validate([
            'wagon_id' => 'required|exists:wagons,id',
            'value' => 'required'
        ]);

        $waterLevel = WaterLevel::create($request->all());

        return response()->json([
            'message' => 'Water Level Received'
        ], 200);
    }
}
