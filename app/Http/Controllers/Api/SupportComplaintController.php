<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportComplaintController extends Controller
{
    public function saveComplaint(Request $request)
    {
        // Validate request data
        $request->validate([
            'user_id' => 'required|integer',
            'contact_no' => 'required|string|max:20',
            'page_name' => 'required|string|max:50',
        ]);

        // Extract data from request
        $userId = $request->input('user_id');
        $contactNo = $request->input('contact_no');
        $pageName = $request->input('page_name');

        // Call stored procedure to save complaint
        DB::statement('EXEC SaveSupportComplaint ?, ?, ?', [$userId, $contactNo, $pageName]);

        // Return response
        return response()->json(['message' => 'Complaint saved successfully. Our Team will contact you in a while'], 200);
    }
}
