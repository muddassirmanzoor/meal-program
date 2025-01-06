<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class InventoryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function inventoryReceived(Request $request): JsonResponse
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'head_teacher_name' => 'required',
            'head_teacher_mobile' => 'required',
            'head_teacher_cnic' => 'required',
            'inventory_received_on' => 'required',
            'received_quantity' => 'required',
            'delivery_challan_no' => 'required',
            'challan_image' => 'required',
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

        // Check if the record exists
        $challanExists = DB::table('inventory_received')
            ->where('emis_code', $emis_code)
            ->where('delivery_challan_no', $request['delivery_challan_no'])
            ->first();

        if ($challanExists) {
            // Handle image upload
            if ($request->hasFile('challan_image')) {
                $imagePath = $request->file('challan_image')->store('uploads/challan', 'public');
            } else {
                $imagePath = $challanExists->image_path; // Keep the existing image if no new image is uploaded
            }

            // Update the existing record
            DB::table('inventory_received')
                ->where('inventory_received_id', $challanExists->inventory_received_id)
                ->update([
                    'head_teacher_name' => $request['head_teacher_name'],
                    'head_teacher_mobile' => $request['head_teacher_mobile'],
                    'head_teacher_cnic' => $request['head_teacher_cnic'],
                    'inventory_received_on' => $request['inventory_received_on'],
                    'received_quantity' => $request['received_quantity'],
                    'image_path' => $imagePath
                ]);

            // Log the update operation
            DB::table('inventory_logs')->insert([
                'inventory_received_id' => $challanExists->inventory_received_id,
                'emis_code' => $emis_code,
                'operation_type' => 'update',
                'old_received_quantity' => $challanExists->received_quantity,
                'new_received_quantity' => $request['received_quantity'],
                'old_delivery_challan_no' => $challanExists->delivery_challan_no,
                'new_delivery_challan_no' => $request['delivery_challan_no'],
                'old_image_path' => $challanExists->image_path,
                'new_image_path' => $imagePath,
                'updated_at' => now(),
            ]);

            // Update stock in hand
            $school_meal_consumption = DB::table('meal_consumption')
                ->where('emis_code', $emis_code)
                ->sum('class_consumption');

            $school_inventory_total = DB::table('inventory_received')
                ->where('emis_code', $emis_code)
                ->sum('received_quantity');

            $stock_in_hand = $school_inventory_total - $school_meal_consumption;

            // Update stock in hand for the school
            DB::table('schools')->where('s_emis_code', $emis_code)->update(['stock_in_hand' => $stock_in_hand]);

            // Prepare the response for update
            return response()->json([
                'status' => 'success',
                'message' => 'Challan No already exists. Record has been updated successfully.',
            ], 200);
        }

        // Handle image upload
        if ($request->hasFile('challan_image')) {
            $imagePath = $request->file('challan_image')->store('uploads/challan', 'public');
        } else {
            $imagePath = null;
        }

        // Insert the record if it doesn't exist
        DB::table('inventory_received')->insert([
            'emis_code' => $emis_code,
            'head_teacher_name' => $request['head_teacher_name'],
            'head_teacher_mobile' => $request['head_teacher_mobile'],
            'head_teacher_cnic' => $request['head_teacher_cnic'],
            'inventory_received_on' => $request['inventory_received_on'],
            'received_quantity' => $request['received_quantity'],
            'delivery_challan_no' => $request['delivery_challan_no'],
            'image_path' => $imagePath
        ]);

        $school_meal_consumption = DB::table('meal_consumption')
            ->where('emis_code', $emis_code)
            ->sum('class_consumption');

        $school_inventory_total = DB::table('inventory_received')
            ->where('emis_code', $emis_code)
            ->sum('received_quantity');

        $stock_in_hand = $school_inventory_total - $school_meal_consumption;
        $stock = $stock_in_hand + $request['received_quantity'];
        // Check if record exists and update
        DB::table('schools')->where('s_emis_code', $emis_code)->update(['stock_in_hand' => $stock]);

        // Prepare the response
        return response()->json([
            'status' => 'success',
            'message' => 'Inventory received successfully.',
        ], 200);

    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInventory(Request $request): JsonResponse
    {
        // Authenticate the user
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'message' => 'Unauthorized. Please log in.'
            ], 401);
        }
        $emis_code = $user->emis_code;

        $inventory = DB::table('inventory_received')
            ->where('emis_code', $emis_code)
            ->select('emis_code', 'received_quantity', 'inventory_received_on', 'delivery_challan_no')
            ->get();

        // Check if inventory is empty
        if ($inventory->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No inventory data found for the provided EMIS code.',
                'data' => [],
            ], 200);
        }

        // Add serial numbers to the result
        $inventory_with_serial = $inventory->map(function ($item, $index) {
            return [
                'serial_number' => $index + 1,
                'emis_code' => $item->emis_code,
                'quantity' => $item->received_quantity,
                'received_on' => $item->inventory_received_on,
                'challan_no' => $item->delivery_challan_no,
            ];
        });

        // Prepare the response
        return response()->json([
            'status' => 'success',
            'message' => 'Inventory received successfully.',
            'data' => $inventory_with_serial
        ], 200);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function mealConsumption(Request $request): JsonResponse
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'classes' => 'required|array',
            'classes.*.class' => 'required|string',
            'classes.*.present' => 'required|integer',
            'classes.*.consumption' => 'required|integer',
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

        $school_inventory = DB::table('inventory_received')
            ->where('emis_code', $emis_code)
            ->first();

        if(!$school_inventory){
            return response()->json([
                'status' => 'false',
                'message' => "The school doesn't have inventory.",
            ], 200);
        }
        $classes = $request->input('classes');
        $date = $request->input('date_value');
        $consumption_date = $date['date'] ?? Carbon::today()->toDateString();

        // Sum of all consumptions
        $totalConsumption = array_sum(array_column($classes, 'consumption'));
        $school_meal_consumption = DB::table('meal_consumption')
            ->where('emis_code', $emis_code)
            ->whereDate('consumption_date', '!=', $consumption_date)
            ->sum('class_consumption');

        $school_inventory_total = DB::table('inventory_received')
            ->where('emis_code', $emis_code)
            ->sum('received_quantity');

        $stock_in_hand = $school_inventory_total - $school_meal_consumption;

        if ($stock_in_hand >= $totalConsumption) {
            // Process each class
            foreach ($classes as $class) {
                $className = $class['class'];
                $present = $class['present'];
                $alergic = $class['alergic'] ?? 0;
                $consumption = $class['consumption'];

                $existingRecord = DB::table('meal_consumption')
                    ->where('emis_code', $emis_code)
                    ->where('class', $className)
                    ->whereDate('consumption_date', $consumption_date) // Only check the date part
                    ->first();

                if ($existingRecord) {
                    // Update the existing record
                    DB::table('meal_consumption')
                        ->where('emis_code', $emis_code)
                        ->where('class', $className)
                        ->whereDate('consumption_date', $consumption_date) // Ensure it checks only the date
                        ->update([
                            'class_present' => $present,
                            'class' => $className,
                            'alergic' => $alergic,
                            'class_consumption' => $consumption,
                            'updated_at' => now(),
                        ]);
                } else {
                    // Insert a new record with full datetime
                    DB::table('meal_consumption')->insert([
                        'emis_code' => $emis_code,
                        'class_present' => $present,
                        'class' => $className,
                        'alergic' => $alergic,
                        'class_consumption' => $consumption,
                        'consumption_date' => $consumption_date, // Insert with full datetime
                        'updated_at' => now(),
                    ]);
                }
            }
            $stock = $stock_in_hand - $totalConsumption;
            // Check if record exists and update
            DB::table('schools')->where('s_emis_code', $emis_code)->update(['stock_in_hand' => $stock]);
            // Prepare the response
            return response()->json([
                'status' => 'success',
                'message' => 'Consumption data submitted successfully.',
            ], 200);
        }else{
            // Prepare the response
            return response()->json([
                'status' => 'false',
                'message' => "The school doesn't have enough stock available.  Please add more stock.",
            ], 200);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function mealEnrollmentData(Request $request): JsonResponse
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

        $date = $request['date_value'] ?? Carbon::today()->toDateString();

        // Prepare the base query for enrollment and meal consumption data
        $query = DB::table('new_enrollments_2024')
            ->select(
                'new_enrollments_2024.class as class_current',
                'new_enrollments_2024.boys as boys_current',
                'new_enrollments_2024.girls as girls_current',
                'new_enrollments_2024.total as total_current',
                DB::raw('COALESCE(meal_consumption.class_present, 0) as present'),
                DB::raw('COALESCE(meal_consumption.class_consumption, 0) as issued'),
                DB::raw('COALESCE(meal_consumption.alergic, 0) as alergic'),
                'new_enrollments_2024.updated_at as enrollment_date'
            )
            ->leftJoin('meal_consumption', function($join) use ($emis_code, $date) {
                $join->on('new_enrollments_2024.class', '=', 'meal_consumption.class')
                    ->where('meal_consumption.emis_code', '=', $emis_code)
                    ->whereDate('meal_consumption.consumption_date', '=', $date);
            })
            ->where('new_enrollments_2024.emis_code', $emis_code);

        // Check if the enrollment exists for today's date
//        if ($date == Carbon::today()->toDateString()) {
//            $checkEnrollment = $query->whereDate('new_enrollments_2024.updated_at', $date)->exists();
//
//            if (!$checkEnrollment) {
//                return response()->json([
//                    'status' => 'false',
//                    'message' => 'Please add today\'s enrollment',
//                    'data' => [
//                        'enrollmentCurrent' => [],
//                        'missing_consumption_dates' => [],
//                    ],
//                ], 200);
//            }
//        } else {
            // If not today, order the results by the latest records
            $query->orderByDesc('new_enrollments_2024.updated_at');
//        }

        // Execute the query and get results, keyed by 'class_current'
        $enrollmentData = $query->get()->keyBy('class_current');

        // Retrieve all class names
        $allClasses = DB::table('classes')
            ->select('c_name')
            ->take(7)
            ->get()
            ->pluck('c_name')
            ->toArray();

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
        $startDate = Carbon::createFromDate(2024, 9, 4);
        $endDate = Carbon::today();

        // Generate the date range as an array
        $dateRange = [];
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dateRange[] = $date->format('Y-m-d');
        }

        // Convert date range array to a string for SQL IN clause
        $dateRangeString = implode("','", $dateRange);

        // Query to get distinct existing dates from meal_consumption
        $existingDates = DB::table('meal_consumption')
            ->select(DB::raw('DISTINCT DATE(consumption_date) as date_value'))
            ->whereIn(DB::raw('DATE(consumption_date)'), $dateRange)
            ->where('emis_code', $emis_code)
            ->pluck('date_value')
            ->toArray();

        // Get missing dates by comparing the generated date range with existing dates
        $missingDates = array_diff($dateRange, $existingDates);
        $missingDates = array_values($missingDates);
        $response['data']['missing_consumption_dates'] = $missingDates;

        return response()->json($response, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function classImages(Request $request): JsonResponse
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
        $class = $request->input('class');

        // Handle file upload and store images
        if($class != 'roznamcha') {
            foreach ($request->file() as $key => $data) {
                if (is_array($data)) {
                    foreach ($data as $index => $file) {

                        $directory = 'uploads/class/' . $emis_code . '/' . $emis_code . '_' . date('Y-m-d'); // Example directory path
                        $fileName = $emis_code . '_' . date('Y-m-d') . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); // Get the original file name
                        $file->storeAs('public/' . $directory, $fileName); // Store the file

                        // Check if record exists and update or insert
                        DB::table('class_images')->insert([
                            'emis_code' => $user->emis_code,
                            'image_date' => date('Y-m-d'),
                            'class' => $class,
                            'image_path' => $directory . '/' . $fileName
                        ]);
                    }
                }
            }
        }else{
            foreach ($request->file() as $key => $data) {
                if (is_array($data)) {
                    foreach ($data as $index => $file) {

                        $directory = 'uploads/roznamcha/' . $emis_code . '/' . $emis_code . '_' . date('Y-m-d'); // Example directory path
                        $fileName = $emis_code . '_' . date('Y-m-d') . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); // Get the original file name
                        $file->storeAs('public/' . $directory, $fileName); // Store the file

                        // Check if record exists and update or insert
                        DB::table('roznamcha_images')->insert([
                            'emis_code' => $user->emis_code,
                            'roznamcha_date' => date('Y-m-d'),
                            'image_path' => $directory . '/' . $fileName
                        ]);
                    }
                }
            }
        }

        // Prepare the response
        return response()->json([
            'status' => 'success',
            'message' => 'Class images submitted successfully.',
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkClassImages(Request $request) : JsonResponse{
        // Authenticate the user
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'message' => 'Unauthorized. Please log in.'
            ], 401);
        }

        $emis_code = $user->emis_code;

        $today = date('Y-m-d');

        // List of all classes to check
        $classes = ["ECE", "Katchi", "Class 1", "Class 2", "Class 3", "Class 4", "Class 5"];

        // Retrieve all submitted classes for today from the database
        $submittedClasses = DB::table('class_images')
            ->where('image_date', $today)
            ->where('emis_code', $emis_code) // Check for specific emis_code
            ->pluck('class') // Get the class names that have entries for today
            ->toArray(); // Convert the result to an array

        // Check if 'roznamcha' has an entry in the roznamcha_images table for today
        $roznamchaSubmitted = DB::table('roznamcha_images')
            ->where('roznamcha_date', $today)
            ->where('emis_code', $emis_code) // Check for specific emis_code
            ->exists(); // Returns true if an entry exists
        // Prepare the response data
        $response = [
            'status' => 'success',
            'message' => 'Classes images status retrieved successfully.',
        ];

        // Loop through each class and determine if it has been submitted
        foreach ($classes as $class) {
            $isSubmitted = in_array($class, $submittedClasses) ? 1 : 0;
            $response['data'][] = [
                'class_name' => $class,
                'is_submitted' => $isSubmitted,
            ];
        }
        // Add the 'roznamcha' class to the response
        $response['data'][] = [
            'class_name' => 'roznamcha',
            'is_submitted' => $roznamchaSubmitted ? 1 : 0,
        ];

        // Example: Return response in a JSON format (adjust according to your needs)
        return response()->json($response, 200);
    }

}
