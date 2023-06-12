<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplaintCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComplainCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $complaintCategories = ComplaintCategory::select();
            return datatables()->of($complaintCategories)
                ->addIndexColumn()
                ->addColumn('action', function ($query) {
                    $editBtn = route('complaint-category.edit', $query->id);
                    $deleteBtn = route('complaint-category.destroy', $query->id);
                    $ident = Str::random(10);

                    return
                        '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>' .
                        '<button type="button" onclick="delete_data(\'form' . $ident . '\')" class="mx-1 my-1 btn btn-sm btn-danger">Delete</button>' .
                        '<form id="form' . $ident . '" action="' . $deleteBtn . '" method="post">' .
                        '<input type="hidden" name="_token" value="' . csrf_token() . '" />' .
                        '<input type="hidden" name="_method" value="DELETE">' .
                        '</form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.complaint-category.index');
    }

    public function create()
    {
        return view('pages.complaint-category.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $complaintCategory = ComplaintCategory::create($request->all());

        return redirect()->route('complaint-category.index')->with('success', 'Complaint category created successfully');
    }

    public function edit(ComplaintCategory $complaintCategory)
    {
        return view('pages.complaint-category.create-edit', compact('complaintCategory'));
    }

    public function update(Request $request, ComplaintCategory $complaintCategory)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $complaintCategory->update($request->all());

        return redirect()->route('complaint-category.index')->with('success', 'Complaint category updated successfully');
    }

    public function destroy(ComplaintCategory $complaintCategory)
    {
        try {
            $complaintCategory->delete();
            return redirect()->route('complaint-category.index')->with('success', 'Complaint category deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('complaint-category.index')->with('error', 'Complaint category failed to delete');
        }
    }
}
