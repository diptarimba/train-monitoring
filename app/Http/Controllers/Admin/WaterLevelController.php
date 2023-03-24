<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use App\Models\Wagon;
use App\Models\WaterLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaterLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Train $train, Wagon $wagon)
    {
        if($request->ajax())
        {
            $waterLevel = $wagon->water_level()
            ->when($request->start_date && $request->end_date, function($query) use ($request){
                return $query->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date);
            })
            ->select();
            return datatables()->of($waterLevel)
            ->addIndexColumn()
            ->make(true);
        }

        return view('pages.train.wagon.waterlevel.index', compact('train', 'wagon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaterLevel  $waterLevel
     * @return \Illuminate\Http\Response
     */
    public function show(WaterLevel $waterLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaterLevel  $waterLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterLevel $waterLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WaterLevel  $waterLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaterLevel $waterLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaterLevel  $waterLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterLevel $waterLevel)
    {
        //
    }

    public function chart(Request $request, Train $train, Wagon $wagon)
    {
        $waterLevel = $wagon->water_level()
        ->select(DB::raw('date_format(created_at, "%Y-%m-%d %H:00:00") as hour'), DB::raw('sum(value) as value'))
        ->when($request->start_date && $request->end_date, function($query) use ($request){
            return $query->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date);
        })
        ->groupBy('hour')
        ->get(['water_levels.*'])
        ->sortBy('hour');

        // $previous_value = null;
        // $hours = [];
        // $startHour = Carbon::parse($waterLevel->first()->hour);
        // $endHour = Carbon::parse($waterLevel->last()->hour);
        // $currentHour = $startHour->copy();

        // while($currentHour <= $endHour){

        //     $hour = $currentHour->format('Y-m-d H:00:00');
        //     $wagonName = $wagon->name;
        //     $hourData = $waterLevel->firstWhere('hour', $hour);
        //     if($hourData){
        //         $value = $hourData->value;
        //         $previous_value = $hourData->value;
        //     }else{
        //         $value = $previous_value ?: 0;
        //     }

        //     $hours[] = [
        //         'hour' => $hour,
        //         'wagon' => $wagonName,
        //         'value' => $value
        //     ];

        //     $currentHour->addHour();
        // }

        // $data = json_encode([
        //     'labels' => collect($hours)->pluck('hour')->map(function($hour){
        //         return date("Y-m-d H:i:s", strtotime($hour));
        //     }),
        //     'value' => collect($hours)->pluck('value')
        // ]);

        $data = json_encode([
            'labels' => collect($waterLevel)->pluck('hour')->map(function($hour){
                return date("Y-m-d H:i:s", strtotime($hour));
            }),
            'value' => collect($waterLevel)->pluck('value')
        ]);

        return view('pages.train.wagon.waterlevel.chart', compact('train', 'wagon', 'data'));

    }
}
