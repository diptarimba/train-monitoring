<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use App\Models\WaterHistory;
use Illuminate\Http\Request;

class WaterHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Train $train)
    {
        if($request->ajax())
        {
            $waterHistory = WaterHistory::with('water_way.wagon.train')->whereHas('water_way.wagon', function($query) use ($train){
                $query->whereTrainId($train->id);
            })->get();
            return datatables()->of($waterHistory)
            ->addIndexColumn()
            ->addColumn('name', function($query){
                return $query->water_way->wagon->name;
            })
            ->addColumn('created_at', function($query){
                return date_format($query->created_at, "d m Y H:i:s");
            })
            ->make(true);
        }

        return view('pages.train.history.index', compact('train'));
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
     * @param  \App\Models\WaterHistory  $waterHistory
     * @return \Illuminate\Http\Response
     */
    public function show(WaterHistory $waterHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaterHistory  $waterHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterHistory $waterHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WaterHistory  $waterHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaterHistory $waterHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaterHistory  $waterHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterHistory $waterHistory)
    {
        //
    }

    public function outflow(Request $request)
    {
        $request->validate([
            'water_way_id' => 'required|exists:waterways,id',
            'volume' => 'required'
        ]);

        $waterHistory = WaterHistory::create($request->all());

        return response()->json([
            'message' => 'Outflow Received'
        ], 200);
    }
}
