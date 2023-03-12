<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use App\Models\Wagon;
use App\Models\Waterways;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WaterWayController extends Controller
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
            $way = Waterways::whereWagonId($wagon->id)->select();
            return datatables()->of($way)
            ->addIndexColumn()
            ->addColumn('wagon', function() use ($wagon){
                return $wagon->name;
            })
            ->addColumn('action', function($query) use ($train, $wagon){
                return $this->getActionColumn($query, $train, $wagon);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('pages.train.wagon.waterway.index', compact('train', 'wagon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Train $train, Wagon $wagon)
    {
        return view('pages.train.wagon.waterway.create-edit', compact('wagon', 'train'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Train $train, Wagon $wagon)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $way = $wagon->water_way()->create($request->all());

        return redirect()->route('train.wagon.ways.index', ['train' => $train->id, 'wagon' => $wagon->id])->with('success', 'Success Create Water Way');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Waterways  $way
     * @return \Illuminate\Http\Response
     */
    public function show(Waterways $way)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Waterways  $way
     * @return \Illuminate\Http\Response
     */
    public function edit( Train $train, Wagon $wagon, Waterways $way)
    {
        return view('pages.train.wagon.waterway.create-edit', compact('way', 'train', 'wagon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Waterways  $way
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Train $train, Wagon $wagon, Waterways $way)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $wagon->water_way()->update($request->all());

        return redirect()->route('train.wagon.ways.index', ['train' => $train->id, 'wagon' => $wagon->id])->with('success', 'Success Update Waterways');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Waterways  $way
     * @return \Illuminate\Http\Response
     */
    public function destroy(Train $train, Wagon $wagon, Waterways $way)
    {
        try {
            $way->delete();
            return redirect()->route('train.wagon.ways.index', ['train' => $train->id, 'wagon' => $wagon->id])->with('success', 'Success Delete WaterWays');
        } catch (\Throwable $th) {
            return redirect()->route('train.wagon.ways.index', ['train' => $train->id, 'wagon' => $wagon->id])->with('success', 'Failed Delete WaterWays');
        }
    }

    public function getActionColumn($data, $train, $wagon)
    {
        $editBtn = route('train.wagon.ways.edit', ['train' => $train->id, 'wagon' => $wagon->id, 'way' => $data->id]);
        $deleteBtn = route('train.wagon.ways.destroy', ['train' => $train->id, 'wagon' => $wagon->id, 'way' => $data->id]);
        $ident = Str::random(10);

        return
        '<a href="'.$editBtn.'" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>'
        . '<button type="button" onclick="delete_data(\'form'.$ident .'\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>'
        .'<form id="form'.$ident .'" action="'.$deleteBtn.'" method="post">
        <input type="hidden" name="_token" value="'.csrf_token().'" />
        <input type="hidden" name="_method" value="DELETE">
        </form>';
    }
}
