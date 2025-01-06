<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use Exception;

class StatController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStat(Request $request): JsonResponse
    {
        try {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'districtid' => 'integer|nullable',
                'tehsilid' => 'integer|nullable',
                'markazid' => 'integer|nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $dashboardController = app(DashboardController::class);
            $dashboardData = $dashboardController->showDashboard($request);
            $data = json_decode(json_encode($dashboardData->getData()), true); // Convert to array

            // Calculate total remaining balance
            $total_inventory_received = isset($data['total_inventory_received'][0]['total_quantity_received']) ? floatval($data['total_inventory_received'][0]['total_quantity_received']) : 0;
            $total_consumed = isset($data['total_consumed'][0]['total_consumed']) ? floatval($data['total_consumed'][0]['total_consumed']) : 0;
            $remaining_balance = $total_inventory_received - $total_consumed;
            
            $school_count_inventory_wise_chart = [
                'total_schools' => $data['total_schools'][0]['total_schools'] - $data['metro_pending_delivery_schools'][0]['metro_pending_delivery_schools'],
                'metro_pending_delivery_schools' => $data['metro_pending_delivery_schools'][0]['metro_pending_delivery_schools'] ?? null,
            ];

            $health_profile_student_chart = [
                'completed' => $data['health_profile_count'][0]['health_profile_count'] ?? null,
                'total_enrollments' => isset($data['total_enrollments'][0]['total_enrollment'], $data['health_profile_count'][0]['health_profile_count']) 
                    ? $data['total_enrollments'][0]['total_enrollment'] - $data['health_profile_count'][0]['health_profile_count'] 
                    : null,
                'percentage' => isset($data['total_enrollments'][0]['total_enrollment'], $data['health_profile_count'][0]['health_profile_count']) && $data['total_enrollments'][0]['total_enrollment'] > 0 
                    ? round(($data['health_profile_count'][0]['health_profile_count'] / $data['total_enrollments'][0]['total_enrollment']) * 100) 
                    : 0,
            ];          
            
            //dd($data);
            $response['overall'] = [
                'total_schools' => $data['total_schools'][0]['total_schools'] ?? null,
                'total_enrollments' => $data['total_enrollments'][0]['total_enrollment'] ?? null,
                'metro_delivered_inventory' => $data['metro_delivered_inventory'][0]['metro_delivered_inventory'] ?? null,
                'total_inventory_received' => $data['total_inventory_received'][0]['total_quantity_received'] ?? null,
                'total_consumed' => $data['total_consumed'][0]['total_consumed'] ?? null,
                'remaining_balance' => $remaining_balance,
                //'metro_pending_delivery_schools' => $data['metro_pending_delivery_schools'][0]['metro_pending_delivery_schools'] ?? null,
                //'health_profile_count' => $data['health_profile_count'][0]['health_profile_count'] ?? null,
            ];
            // Safely access data for today's values
            $metro_dispatch_today = isset($data['metro_dispatch_today'][0]['metro_dispatch_today'])
                ? (int) $data['metro_dispatch_today'][0]['metro_dispatch_today']
                : 0; // Default to 0 if not set

            $total_quantity_received_today = isset($data['total_quantity_received_today'][0]['total_quantity_received_today'])
                ? (int) $data['total_quantity_received_today'][0]['total_quantity_received_today']
                : 0; // Default to 0 if null

            $total_consumed_today = isset($data['total_consumed_today'][0]['total_consumed_today'])
                ? (int) $data['total_consumed_today'][0]['total_consumed_today']
                : 0; // Default to 0 if null


            // Prepare response with the daily data
            $response['daily'] = [
                'metro_dispatch_today' => $metro_dispatch_today,
                'total_quantity_received_today' => $total_quantity_received_today,
                'total_consumed_today' => $total_consumed_today,
            ];
            $response['charts'] = [
                'school_count_inventory_wise_chart' => $school_count_inventory_wise_chart,
                'health_profile_student_chart' => $health_profile_student_chart,
                'line_graph' => array_map(function ($entry) {
                return [
                'dates' => $entry['dates'],
                'total_received' => $entry['total_received'],
                'total_consumed' => $entry['total_consumed']
                ];
                 }, $data['line_graph'] ?? []),
                  'district_graph' => array_map(function ($district) {
                return [
                'd_name' => $district['d_name'],
                'total_quantity_received' => $district['total_quantity_received'],
                'total_consumed' => $district['total_consumed'],
                'balance' => $district['balance']
                ];
                }, $data['district_graph'] ?? []),
                
            ];
            return response()->json([
                'status' => 'success',
                'message' => 'Dashboard data retrieved successfully.',
                'data' => $response,
            ], 200);
        } catch (Exception $e) {
            // Log the error
            \Log::error('Error in getStat: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving the dashboard data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getDistrict(){

    }
    public function getTehsil($districtid){

    }
    public function getMarkaz($tehsilid){

    }
}