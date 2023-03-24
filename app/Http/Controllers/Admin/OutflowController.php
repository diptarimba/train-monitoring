<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outflow;
use App\Models\Train;
use App\Models\Wagon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutflowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Train $train, Wagon $wagon)
    {
        if ($request->ajax()) {
            $outflow = $wagon
                ->outflow()
                ->with('water_way')
                ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                    return $query->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date);
                })
                ->when($request['search']['value'], function($query) use ($request){
                    return $query->whereHas('water_way', function($query) use ($request){
                        return $query->where('name', 'like', "%{$request['search']['value']}%");
                    });
                });
            return datatables()
                ->of($outflow)
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.train.wagon.outflow.index', compact('train', 'wagon'));
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
     * @param  \App\Models\Outflow  $outflow
     * @return \Illuminate\Http\Response
     */
    public function show(Outflow $outflow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outflow  $outflow
     * @return \Illuminate\Http\Response
     */
    public function edit(Outflow $outflow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outflow  $outflow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outflow $outflow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outflow  $outflow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outflow $outflow)
    {
        //
    }

    public function chart(Request $request, Train $train, Wagon $wagon)
    {
        $outflow = $wagon->outflow()->with('water_way')
        ->select(DB::raw('date_format(created_at, "%Y-%m-%d %H:%i:00") as hour'), 'water_way_id', DB::raw('sum(value) as value'))
        ->when($request->start_date && $request->end_date, function($query) use ($request){
            return $query->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date);
        })
        ->groupBy('hour', 'water_way_id')
        ->get(['outflows.*'])
        ->sortBy('hour');

        $hours = collect($outflow->sortBy('hour'))->pluck('hour');
        $waterWayName = collect($outflow)->pluck('water_way.name')->unique();
        $rawData = [];
        $rawData['labels'] = $hours->map(function($each){
            return $each;
        })->toArray();


        foreach($waterWayName as $eachWay){
            foreach($hours as $hour){
                $currentData = $outflow->where('water_way.name', $eachWay)->where('hour', $hour);
                $rawData['value'][$eachWay][] = count($currentData) ? $currentData->first()->value : 0;
            }
        }

        $data = json_encode($rawData);
        return view('pages.train.wagon.outflow.chart', compact('data', 'train', 'wagon'));
    }
}
