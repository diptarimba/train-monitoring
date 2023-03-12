<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outflow;
use App\Models\Train;
use App\Models\Wagon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OutflowController extends Controller
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
            $outflow = $wagon->outflow()->with('water_way')->select();
            return datatables()->of($outflow)
            ->addIndexColumn()
            ->addColumn('way', function($query){
                return $query->water_way->name;
            })
            ->addColumn('created_at', function($query){
                return Carbon::parse($query->created_at)->format("H:i:s d-m-Y");
            })
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
}
