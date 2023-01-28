<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use App\Models\Wagon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WagonController extends Controller
{
    public function index(Request $request, Train $train)
    {
        if($request->ajax())
        {
            $wagon = Wagon::whereTrainId($train->id)->select();
            return datatables()->of($wagon)
                ->addIndexColumn()
                ->addColumn('action', function($query){
                    return $this->getActionColumn($query);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.train.wagon.index', compact('train'));
    }

    public function create(Train $train)
    {
        return view('pages.train.wagon.create-edit', compact('train'));
    }

    public function store(Request $request, Train $train)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $train->wagon()->create($request->all());

        return redirect()->route('train.wagon.index', $train->id)->with('success', 'Wagon Created Successfully');
    }

    public function edit(Train $train, Wagon $wagon)
    {
        return view('pages.train.wagon.create-edit', compact('wagon', 'train'));
    }

    public function update(Request $request, Train $train, Wagon $wagon)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $wagon->update($request->all());

        return redirect()->route('train.wagon.index', $train->id)->with('success', 'Wagon Updated Successfully');
    }

    public function destroy(Train $train, Wagon $wagon)
    {
        try {
            $wagon->delete();
            return redirect()->route('train.wagon.index', $train->id)->with('success', 'Wagon Deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()->route('train.wagon.index', $train->id)->with('error', 'Wagon Failed Deleted');
        }
    }

    public function getActionColumn($data)
    {
        $editBtn = route('train.wagon.edit', ['train' => $data->train_id, 'wagon' => $data->id]);
        $deleteBtn = route('train.wagon.destroy', ['train' => $data->train_id, 'wagon' => $data->id]);
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
