<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //for AEO Login

    //for Teacher Login
    public function login(Request $request)
    {
        // Validate the request
        $validate = Validator::make($request->all(), [
            'emis_code' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 422); // Changed to 422 Unprocessable Entity
        }

        // Check if the user exists and is active
        $user = User::where('emis_code', $request->emis_code)
            ->where('isActive', 1)
            ->first();

        // Check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'false',
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Retrieve additional user-related data
        $school = DB::table('schools')
            ->where('s_emis_code', $request->emis_code)
            ->first([
                's_emis_code',
                'school_name',
                'level',
                'gender',
                DB::raw('CAST(s_district_idFk AS CHAR) as s_district_idFk'),
                DB::raw('CAST(s_tehsil_idFk AS CHAR) as s_tehsil_idFk')
            ]);

        $district = DB::table('districts')
            ->where('d_id', $school->s_district_idFk)
            ->value('d_name');

        $tehsil = DB::table('tehsils')
            ->where('t_id', $school->s_tehsil_idFk)
            ->value('t_name');

        // Prepare the response data
        $response = [
            'status' => 'success',
            'message' => 'User is logged in successfully.',
            'data' => [
                'token' => $user->createToken($request->emis_code)->plainTextToken,
                'user' => [
                    'emis_code' => $user->emis_code,
                    'change_password' => $user->change_password,
                    'school' => $school,
                    'district' => $district,
                    'tehsil' => $tehsil,
                ],
            ],
        ];

        return response()->json($response, 200);
    }


public function changePassword(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed', // Ensure the new password meets the minimum length and is confirmed
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'false',
            'message' => 'Validation Error!',
            'data' => $validator->errors(),
        ], 422);  // Unprocessable Entity
    }

    // Retrieve the authenticated user
    $user = Auth::user();

    // Check if the current password matches
    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
            'status' => 'false',
            'message' => 'Current password is incorrect.',
        ], 401);  // Unauthorized
    }

    // Update the password
    $user->password = Hash::make($request->new_password);
    $user->change_password = '1';
    $user->save();

    // Return success response
    return response()->json([
        'status' => 'success',
        'message' => 'Password changed successfully.',
    ], 200);  // OK
}
}
