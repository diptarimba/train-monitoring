<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TrainController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $train = Train::select();
            return datatables()
                ->of($train)
                ->addIndexColumn()
                ->addColumn('action', function ($query) {
                    return $this->getActionColumn($query);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.train.index');
    }

    public function create()
    {
        return view('pages.train.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $train = Train::create($request->all());

        return redirect()
            ->route('train.index')
            ->with('success', 'Train created successfully');
    }

    public function edit(Train $train)
    {
        return view('pages.train.create-edit', compact('train'));
    }

    public function update(Request $request, Train $train)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $train->update($request->all());

        return redirect()
            ->route('train.index')
            ->with('success', 'Train updated successfully');
    }

    public function destroy(Train $train)
    {
        try {
            $train->delete();
            return redirect()
                ->route('train.index')
                ->with('success', 'Train deleted successfully');
        } catch (\Throwable $th) {
            return redirect()
                ->route('train.index')
                ->with('error', 'Train failed deleted');
        }
    }

    public function getActionColumn($data)
    {
        $editBtn = route('train.edit', $data->id);
        $deleteBtn = route('train.destroy', $data->id);
        $wagonUrl = route('train.wagon.index', $data->id);
        $ident = Str::random(10);

        $buttonAction = '';
        if (Auth::user()->status == User::$ADMIN) {
            $buttonAction .= '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>' . '<button type="button" onclick="delete_data(\'form' . $ident . '\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>';
        }
        $buttonAction .= '<a class="btn btn-info btn-sm mx-1 my-1" href="' . $wagonUrl . '">Wagon List</a>';
        if (Auth::user()->status == User::$ADMIN) {
            $buttonAction .=
                '<form id="form' .
                $ident .
                '" action="' .
                $deleteBtn .
                '" method="post">
        <input type="hidden" name="_token" value="' .
                csrf_token() .
                '" />
        <input type="hidden" name="_method" value="DELETE">
        </form>';
        }

        return $buttonAction;
    }
}
