<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $statusAccount = strtolower($request->status);
        if($request->ajax()){
            $user = User::when($request->status, function($query) use ($request){
                $query->where('status', '=', $request->status);
            })->select();
            return datatables()->of($user)
                ->addIndexColumn()
                ->addColumn('action', function($query){
                    return $this->getActionColumn($query);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.user.index', compact('statusAccount'));
    }

    public function create()
    {
        return view('pages.user.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'status' => 'required',
            'avatar' => 'required|mimes:png,jpg,jpeg|max:1024',
        ]);

        $user = User::create(array_merge($request->all(),
            [
                'avatar' => '/storage/'. $request->file('avatar')->storePublicly('avatar'),
                'password' => bcrypt($request->password)
            ]
        ));

        return redirect()->route('user.index', ['status' => $request->status])->with('success', 'User Created Successfully');
    }

    public function edit(User $user)
    {
        return view('pages.user.create-edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'sometimes',
            'avatar' => 'sometimes|mimes:png,jpg,jpeg|max:1024',
        ]);

        $user->update(array_merge($request->all(), [
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'avatar' => $request->hasFile('avatar') ? '/storage/'. $request->file('avatar')->storePublicly('avatar') : $user->avatar
        ]));

        // return redirect()->route('user.index', ['status' => $user->status])->with('success', 'User Updated Successfully');
        return redirect()->back()->with('success', 'User Updated Successfully');
    }

    public function destroy(User $user)
    {
        try {
            $userStatus = $user->status;
            $user->delete();
            return redirect()->route('user.index', ['status' => $userStatus])->with('success', 'User Deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()->route('user.index', ['status' => $userStatus])->with('error', 'User Failed Deleted');
        }
    }

    public function getActionColumn($data)
    {
        $editBtn = route('user.edit', $data->id);
        $dataReturn = '<a href="'.$editBtn.'" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>';

        if(Auth::user()->id !== $data->id){
            $deleteBtn = route('user.destroy', $data->id);
            $ident = Str::random(10);

            $dataReturn .= '<button type="button" onclick="delete_data(\'form'.$ident .'\')"class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>'
            .'<form id="form'.$ident .'" action="'.$deleteBtn.'" method="post">
            <input type="hidden" name="_token" value="'.csrf_token().'" />
            <input type="hidden" name="_method" value="DELETE">
            </form>';
        }

        return $dataReturn;

    }
}

