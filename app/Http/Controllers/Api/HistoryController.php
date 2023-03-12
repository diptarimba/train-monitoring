<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Outflow;
use App\Models\Waterways;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function outflow(Request $request)
    {
        $request->validate([
            'water_way_id' => 'required|exists:waterways,id',
            'value' => 'required',
        ]);

        $wagonId = Waterways::whereid($request->water_way_id)->first()->id;

        $outflow = Outflow::create(array_merge(['wagon_id' => $wagonId],$request->all()));

        return response()->json([
            'message' => 'Outflow Received'
        ], 200);
    }
}
