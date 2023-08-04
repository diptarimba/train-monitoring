<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = request()->query('perPage', 10); // Mengambil jumlah item per halaman dari query parameter, defaultnya 10
            $complaints = Complaint::when($request->kereta_id !== null, function($query) use ($request){
                return $query->whereHas('wagon', function($query) use ($request){
                    return $query->where('train_id', $request->kereta_id);
                });
            })->orderBy('id')->paginate($perPage);

            return response()->json([
                'message' => 'Retrieve List Complaint',
                'data' => $complaints
                // 'data' => $complaints->makeHidden(['created_at', 'updated_at'])
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 400);
        }
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'wagon_id' => 'required',
                'category_id' => 'required',
                'name' => 'required',
                'content' => 'required'
            ]);

            $complaint = Complaint::create($request->all());

            return response()->json([
                'message' => 'Complaint Received',
                'data' => $complaint
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        try {
            $request->validate([
                'status' => 'required'
            ]);

            $complaint->update($request->all());

            return response()->json([
                'message' => 'Complaint Updated'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
