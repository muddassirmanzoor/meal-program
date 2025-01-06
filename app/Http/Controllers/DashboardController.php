<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\District;
use App\Models\Tehsil;
//use App\Models\Markaz;

class DashboardController extends Controller
{
    

    public function showDashboard(Request $request)
    {
        $emiscode = $request->input('schoolemis') ?: null;
        if($emiscode){
            return view('dashboard.redirect-form', ['emiscode' => $emiscode]);
        }
        // Retrieve the districts
        $districts = District::where('d_status', 1)->get();

        // Retrieve filter values from the request or set to NULL if not provided
        $district_id = $request->input('districtid') ?: null;
        $tehsil_id = $request->input('tehsilid') ?: null;
        $markaz_id = $request->input('markazid') ?: null;
        //dd($district_id,$tehsil_id,$markaz_id);
        // Initialize variables for the result sets
        $total_schools = [];
        $total_enrollments = [];
        $total_inventory_received = [];
        $total_consumed = [];
        $district_graph = [];

        $tehsils = collect([]);
        $markazes = collect([]);
        if($district_id){
            $tehsils = Tehsil::where('t_district_idFk', $district_id)
            ->where('t_status', 1)
            ->get(['t_id', 't_name']);    
        }
        if($tehsil_id){
            $markazes = DB::table('markazes')
            ->where('m_tehsil_idFk', $tehsil_id)
            ->where('m_status', 1)
            ->get(['m_id', 'm_name']);
        }

        // Prepare the procedure call with parameters
        $procedureCall = 'CALL p_get_dashboard(?,?,?,?,?,?,?,?)';

        $pdo = DB::connection('mysql')->getPdo();
        $statement = $pdo->prepare($procedureCall);

        // Bind parameters for the stored procedure
        $statement->bindValue(1, $district_id, $district_id === null ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
        $statement->bindValue(2, $tehsil_id, $tehsil_id === null ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
        $statement->bindValue(3, $markaz_id, $markaz_id === null ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
        // Bind other parameters as needed (fill with default values or NULL if not used)
        for ($i = 4; $i <= 8; $i++) {
            $statement->bindValue($i, null, \PDO::PARAM_NULL);
        }

        $statement->execute();

        // Fetch results from each result set
        $total_schools = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $total_enrollments = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();

        $metro_delivered_inventory = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        
        $total_inventory_received = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $total_consumed = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $district_graph = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $no_consumption_schools = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $metro_pending_delivery_schools = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $metro_dispatch_today = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $total_quantity_received_today = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $total_consumed_today = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $no_consumption_schools_today = $statement->fetchAll(\PDO::FETCH_OBJ);
        
        

        


        return view('dashboard.dashboard_pd', [
            'total_schools' => $total_schools,
            'total_enrollments' => $total_enrollments,
            'metro_delivered_inventory' => $metro_delivered_inventory,
            'total_inventory_received' => $total_inventory_received,
            'total_consumed' => $total_consumed,
            'district_graph' => $district_graph,
            'no_consumption_schools' => $no_consumption_schools,
            'metro_pending_delivery_schools' => $metro_pending_delivery_schools,
            'metro_dispatch_today' => $metro_dispatch_today,
            'total_quantity_received_today' => $total_quantity_received_today,
            'total_consumed_today' => $total_consumed_today,
            'no_consumption_schools_today' => $no_consumption_schools_today,
            'districts' => $districts,
            'tehsils' => $tehsils,
            'markazes' => $markazes,
            'district_id' => $district_id,
            'tehsil_id' => $tehsil_id,
            'markaz_id' => $markaz_id
        ]);
    }
    public function showDashboard2(Request $request)
    {
        $emiscode = $request->input('schoolemis') ?: null;
        if($emiscode){
            preg_match('/\d+/', $emiscode, $matches);
            $emiscode = $matches[0] ?? null;
            return redirect()->route('schoolData', ['emis_code' => $emiscode]);
        }
        // Retrieve the districts
        $districts = District::where('d_status', 1)->get();

        // Retrieve filter values from the request or set to NULL if not provided
        $district_id = $request->input('districtid') ?: null;
        $tehsil_id = $request->input('tehsilid') ?: null;
        $markaz_id = $request->input('markazid') ?: null;
        //dd($district_id,$tehsil_id,$markaz_id);
        // Initialize variables for the result sets
        $total_schools = [];
        $total_enrollments = [];
        $total_inventory_received = [];
        $total_consumed = [];
        $district_graph = [];

        $tehsils = collect([]);
        $markazes = collect([]);
        if($district_id){
            $tehsils = Tehsil::where('t_district_idFk', $district_id)
            ->where('t_status', 1)
            ->get(['t_id', 't_name']);    
        }
        if($tehsil_id){
            $markazes = DB::table('markazes')
            ->where('m_tehsil_idFk', $tehsil_id)
            ->where('m_status', 1)
            ->get(['m_id', 'm_name']);
        }

        // Prepare the procedure call with parameters
        $procedureCall = 'CALL p_get_dashboard(?,?,?,?,?,?,?,?)';

        $pdo = DB::connection('mysql')->getPdo();
        $statement = $pdo->prepare($procedureCall);

        // Bind parameters for the stored procedure
        $statement->bindValue(1, $district_id, $district_id === null ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
        $statement->bindValue(2, $tehsil_id, $tehsil_id === null ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
        $statement->bindValue(3, $markaz_id, $markaz_id === null ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
        // Bind other parameters as needed (fill with default values or NULL if not used)
        for ($i = 4; $i <= 8; $i++) {
            $statement->bindValue($i, null, \PDO::PARAM_NULL);
        }

        $statement->execute();

        // Fetch results from each result set
        $total_schools = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $total_enrollments = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();

        $metro_delivered_inventory = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        
        $total_inventory_received = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $total_consumed = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $district_graph = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $no_consumption_schools = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $metro_pending_delivery_schools = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $metro_dispatch_today = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $total_quantity_received_today = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $total_consumed_today = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $no_consumption_schools_today = $statement->fetchAll(\PDO::FETCH_OBJ);
        $statement->nextRowset();
        $line_graph = $statement->fetchAll(\PDO::FETCH_OBJ);
        
        
        //dd($line_graph);
        


        return view('dashboard.dashboard_pd2', [
            'total_schools' => $total_schools,
            'total_enrollments' => $total_enrollments,
            'metro_delivered_inventory' => $metro_delivered_inventory,
            'total_inventory_received' => $total_inventory_received,
            'total_consumed' => $total_consumed,
            'district_graph' => $district_graph,
            'no_consumption_schools' => $no_consumption_schools,
            'metro_pending_delivery_schools' => $metro_pending_delivery_schools,
            'metro_dispatch_today' => $metro_dispatch_today,
            'total_quantity_received_today' => $total_quantity_received_today,
            'total_consumed_today' => $total_consumed_today,
            'no_consumption_schools_today' => $no_consumption_schools_today,
            'line_graph' => $line_graph,
            'districts' => $districts,
            'tehsils' => $tehsils,
            'markazes' => $markazes,
            'district_id' => $district_id,
            'tehsil_id' => $tehsil_id,
            'markaz_id' => $markaz_id
        ]);
    }



    
    public function getImages(Request $request)
    {
        // Get the query parameters
        $selectedSchool = $request->query('school');
        $selectedDate = $request->query('date');

        // Start the query builder for schools
        $query = \DB::table('schools')
            ->select('s_emis_code', 'school_name')
            ->whereIn('s_district_idFk', [7, 23, 29])
            ->where('level', 'Primary');

        // Apply filters if they are provided
        // if ($selectedSchool) {
        //     $query->where('s_emis_code', $selectedSchool);
        // }

        // Execute the query
        $schools = $query->get();

        // Fetch images based on selected school and date
        $images = collect(); // Initialize an empty collection for images

        if ($selectedSchool || $selectedDate) {
            // Only query images if filters are set
            $images = \DB::table('class_images')
                ->select('class', 'emis_code', 'image_path', 'image_date')
                ->when($selectedSchool, function ($query, $selectedSchool) {
                    return $query->where('emis_code', $selectedSchool);
                })
                ->when($selectedDate, function ($query, $selectedDate) {
                    return $query->where('image_date', $selectedDate);
                })
                ->get();
        }

        // Pass the data to the view
        return view('dashboard.gallery', compact('schools', 'selectedSchool', 'selectedDate', 'images'));
    }

    public function getTehsils(Request $request)
    {   
        // Fetch tehsils based on the selected district
        $districtId = $request->input('district_id');
        $tehsils = DB::table('tehsils')
            ->select('tehsil_id as s_tehsil_idFk', 'tehsil_name as t_name')
            ->where('s_district_idFk', $districtId)
            ->get();
        

        // Return tehsils as JSON response
        return response()->json($tehsils);
    }
    public function getMarkazes(Request $request)
    {
        // Fetch markazes based on the selected tehsil
        $tehsilId = $request->input('tehsil_id');
        $markazes = DB::table('markazes')
        ->select('m_id as s_markaz_idFk', 'm_name')
        ->where('m_tehsil_idFk', $tehsilId)->where('m_status', 1)
       ->get();

        // Return markazes as JSON response
        return response()->json($markazes);
    }

    public function studentsList(Request $request)
    {
        // Fetch markazes based on the selected tehsil
        $emis_code = $request->input('emis_code');

        
        

       
    }




    

    
}
