<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComplaintCategory;
use Illuminate\Http\Request;

class ComplaintCategoryController extends Controller
{
    public function index()
    {
        $complaintCategory = ComplaintCategory::select('id', 'name')->get();
        return response()->json([
            'message' => 'Retrieve List Complaint Category',
            'data' => $complaintCategory
        ], 200);
    }
}
