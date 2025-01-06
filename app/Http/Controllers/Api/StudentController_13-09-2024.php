<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class StudentController_13 extends Controller
{
    public function enrollmentData(Request $request)
    {
        // Check if the request has an Authorization header
        if (!$request->bearerToken()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Authorization token is missing.'
            ], 401);
        }

        // Authenticate the user using the token
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'message' => 'Invalid or expired token.'
            ], 401);
        }

        // Retrieve the user's emis_code
        $emis_code = $user->emis_code;

        // Retrieve all class names
        $allClasses = DB::table('classes')
            ->select('c_name')
            ->get()
            ->pluck('c_name')
            ->toArray();

        // Retrieve the enrollment data
        $enrollmentData = DB::table('new_enrollments_2024')
            ->select(
                'class as class_current',
                'boys as boys_current',
                'girls as girls_current',
                'total as total_current'
            )
            ->where('emis_code', $emis_code)
            ->get()
            ->keyBy('class_current'); // Use keyBy to make lookup easier

        // Prepare the response data
        $response = [
            'status' => 'success',
            'message' => 'Enrollment data retrieved successfully.',
            'data' => [
                'enrollmentCurrent' => [],
            ],
        ];

        // Combine all classes with enrollment data
        foreach ($allClasses as $class_name) {
            if (isset($enrollmentData[$class_name])) {
                $enrollmentCurrent = $enrollmentData[$class_name];
            } else {
                $enrollmentCurrent = (object)[
                    'class_current' => $class_name,
                    'boys_current' => 0,
                    'girls_current' => 0,
                    'total_current' => 0
                ];
            }

            $response['data']['enrollmentCurrent'][] = $enrollmentCurrent;
        }

        return response()->json($response, 200);
    }

    public function classStudents(Request $request)
    {
        // Check if the request has an Authorization header
        if (!$request->bearerToken()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Authorization token is missing.'
            ], 401);
        }

        // Authenticate the user using the token
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'message' => 'Invalid or expired token.'
            ], 401);
        }

        // Retrieve the user's emis_code
        $emis_code = $user->emis_code;
        $class = $request->get('class');

        // Retrieve all class students
        $class_students = DB::table('students')
            ->select(
                'student_name',
                'gender',
                'father_name',
                'form_b',
                'enrollment_no',
                'c_name',
                'student_sis_id',
                'status',
                'is_submitted',
            )
            ->where('s_emis_code', $emis_code)
            ->where('c_name', $class)
            ->get()
            ->toArray();

        // Prepare the response data
        $response = [
            'status' => 'success',
            'message' => 'Students list retrieved successfully.',
            'data' => [
                'classStudents' => $class_students,
            ],
        ];

        return response()->json($response, 200);
    }

    public function studentDetail(Request $request)
    {
        // Check if the request has an Authorization header
        if (!$request->bearerToken()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Authorization token is missing.'
            ], 401);
        }

        // Authenticate the user using the token
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'message' => 'Invalid or expired token.'
            ], 401);
        }

        // Retrieve the user's emis_code
        $emis_code = $user->emis_code;
        $student_sis_id = $request->get('student_sis_id');

        // Retrieve student detail
        $student_detail = DB::table('students')
            ->select(
                'student_name',
                'gender',
                'father_name',
                'form_b',
                'enrollment_no',
                'c_name',
                'student_sis_id'
            )
            ->where('s_emis_code', $emis_code)
            ->where('student_sis_id', $student_sis_id)
            ->get()
            ->toArray();
        // Prepare the response data
        $response = [
            'status' => 'success',
            'message' => 'Students detail retrieved successfully.',
            'data' => [
                'studentDetail' => $student_detail,
            ],
        ];

        return response()->json($response, 200);
    }


    public function submitEnrollment(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'classes' => 'required|array',
            'classes.*.class' => 'required|string',
            'classes.*.boys' => 'required|integer',
            'classes.*.girls' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation Error!',
                'data' => $validator->errors(),
            ], 422); // Unprocessable Entity
        }

        // Authenticate the user
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'message' => 'Unauthorized. Please log in.'
            ], 401);
        }

        $emis_code = $user->emis_code;

        // Prepare data for insertion
        $classes = $request->input('classes');

        // Process each class
        foreach ($classes as $class) {
            $className = $class['class'];
            $boys = $class['boys'];
            $girls = $class['girls'];
            $total = $boys + $girls;

            // Check if record exists and update or insert
            DB::table('new_enrollments_2024')->updateOrInsert(
                ['emis_code' => $emis_code, 'class' => $className],
                [
                    'boys' => $boys,
                    'girls' => $girls,
                    'total' => $total,
                    'updated_at' => now()
                ]
            );
        }

        // Prepare the response
        return response()->json([
            'status' => 'success',
            'message' => 'Enrollment data submitted successfully.',
        ], 200);
    }

    public function submitStudentProfile(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'height_ft' => 'required',
            'height_inches' => 'required',
            'weight' => 'required',
            'student_sis_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation Error!',
                'data' => $validator->errors(),
            ], 422); // Unprocessable Entity
        }

        // Authenticate the user
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'message' => 'Unauthorized. Please log in.'
            ], 401);
        }

        $emis_code = $user->emis_code;

        // Prepare data for insertion
        $student_sis_id = $request->input('student_sis_id');

        DB::table('students')
            ->where('s_emis_code', $emis_code)
            ->where('student_sis_id', $student_sis_id)
            ->update(['is_submitted'=>1]);

        // Calculate BMI
        $heightInMeters = ($request['height_ft'] * 0.3048) + ($request['height_inches'] * 0.0254);
        $bmi = $request['weight'] / ($heightInMeters ** 2);

            // Check if record exists and update or insert
            DB::table('health_profile')->updateOrInsert(
                ['student_sis_idfk' => $student_sis_id],
                [
                    'weight' => $request['weight'],
                    'height_ft' => $request['height_ft'],
                    'height_inches' => $request['height_inches'],
                    'BMI' => $bmi
                ]
            );

            // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        } else {
            $imagePath = null;
        }
            // Check if record exists and update or insert
            DB::table('meal_info')->updateOrInsert(
                ['student_sis_id' => $student_sis_id],
                [
                    'milk' => $request['milk'],
                    'milk_quantity' => $request['milk_quantity'],
                    'milk_time' => $request['milk_time'],
                    'milk_type' => $request['milk_type'],
                    'milk_allergy' => $request['milk_allergy'],
                    'milk_taste' => $request['milk_taste'],
                    'dairy_product' => $request['dairy_product'],
                    'milk_source' => $request['milk_source'],
                    'image' => $imagePath,
                ]
            );

            // Check if record exists and update or insert
            DB::table('academic_profile')->updateOrInsert(
                ['student_sis_id' => $student_sis_id],
                [
                    'b_eng_march24' => $request['b_eng_march24'],
                    'b_urdu_march24' => $request['b_urdu_march24'],
                    'b_math_march24' => $request['b_math_march24'],
                    'b_sci_march24' => $request['b_sci_march24'],
                    'ob_eng_oct24' => $request['ob_eng_oct24'],
                    'ob_urdu_oct24' => $request['ob_urdu_oct24'],
                    'ob_math_oct24' => $request['ob_math_oct24'],
                    'ob_sci_oct24' => $request['ob_sci_oct24'],
                    'ob_eng_march25' => $request['ob_eng_march25'],
                    'ob_urdu_march25' => $request['ob_urdu_march25'],
                    'ob_math_march25' => $request['ob_math_march25'],
                    'ob_sci_march25' => $request['ob_sci_march25'],
                    'ob_eng_may25' => $request['ob_eng_may25'],
                    'ob_urdu_may25' => $request['ob_urdu_may25'],
                    'ob_math_may25' => $request['ob_math_may25'],
                    'ob_sci_may25' => $request['ob_sci_may25'],
                ]
            );

        // Prepare the response
        return response()->json([
            'status' => 'success',
            'message' => 'Enrollment data submitted successfully.',
        ], 200);
    }

    public function updateStudentStatus(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'student_sis_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation Error!',
                'data' => $validator->errors(),
            ], 422); // Unprocessable Entity
        }

        // Authenticate the user
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'message' => 'Unauthorized. Please log in.'
            ], 401);
        }

        $emis_code = $user->emis_code;

        // Prepare data for update
        $student_sis_id = $request->input('student_sis_id');
        $status = $request->input('status');

         DB::table('students')
            ->where('s_emis_code', $emis_code)
            ->where('student_sis_id', $student_sis_id)
            ->update(['status'=>$status]);

        // Prepare the response
        return response()->json([
            'status' => 'success',
            'message' => 'Student status updated successfully.',
        ], 200);
    }

}
