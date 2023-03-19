<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use App\Models\Wagon;
use App\Models\WaterLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
