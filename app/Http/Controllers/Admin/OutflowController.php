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
}
