<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RemainingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route to show the login page
Route::get('/', [LoginController::class, 'showLogin'])->name('login');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Route for handling login
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
// routes/web.php
Route::middleware('auth')->match(['get', 'post'], '/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::middleware('auth')->match(['get', 'post'], '/dashboard2', [DashboardController::class, 'showDashboard2'])->name('dashboard2');
Route::middleware('auth')->post('/school-gallery', [DashboardController::class, 'showImages'])->name('school-gallery');
Route::middleware('auth')->get('/get-school-gallery', [DashboardController::class, 'getImages'])->name('get-school-gallery');

Route::middleware('auth')->get('/detail-report', [ReportController::class, 'showStat'])->name('stat');

Route::middleware('auth')->get('/consumption-report', [ReportController::class, 'consumptionReport'])->name('report.comsumption');
Route::middleware('auth')->get('/export-consumption', [ReportController::class, 'exportConsumption']);

Route::middleware('auth')->get('/inventory-report', [ReportController::class, 'inventoryReport'])->name('report.inventory');
Route::middleware('auth')->get('/export-inventory', [ReportController::class, 'exportInventory']);

Route::middleware('auth')->get('/get-tehsils/{district_id}', [ReportController::class, 'getTehsils'])->name('getTehsils');

Route::middleware('auth')->get('/school-detail/{emis_code?}', [ReportController::class, 'schoolDetail'])->name('schoolData');

Route::middleware('auth')->get('/get-markaz/{tehsil_id}', [ReportController::class, 'getMarkaz'])->name('getMarkaz');

Route::middleware('auth')->get('/get-schools/{markaz_id}', [ReportController::class, 'getSchools'])->name('getSchools');

Route::middleware('auth')->post('/detail-report/', [ReportController::class, 'showStatDetail'])->name('showStatDetail');

Route::middleware('auth')->get('/stock-status', [RemainingController::class, 'index']);

Route::middleware('auth')->post('/stock-report/', [RemainingController::class, 'showStatDetail'])->name('show.stock.report');

Route::middleware('auth')->get('/students-list', [StudentController::class, 'studentsList']);

Route::middleware('auth')->get('/student/{id}', [StudentController::class, 'studentDetail'])->name('student.details');

Route::middleware('auth')->get('/get-tehsils-remain/{district_id}', [RemainingController::class, 'getTehsils'])->name('remain.getTehsils');

Route::middleware('auth')->get('/school-detail-remain/{emis_code?}', [RemainingController::class, 'schoolDetail'])->name('remain.schoolData');

Route::middleware('auth')->get('/get-markaz-remain/{tehsil_id}', [RemainingController::class, 'getMarkaz'])->name('remain.getMarkaz');

Route::middleware('auth')->get('/get-schools-remain/{markaz_id}', [RemainingController::class, 'getSchools'])->name('remain.getSchools');

Route::middleware('auth')->post('/export-stock-status/', [RemainingController::class, 'exportStock'])->name('export.stock');
