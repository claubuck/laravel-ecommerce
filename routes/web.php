<?php

use App\Http\Controllers\CashFlowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('sales',SaleController::class)->names('sales');
    Route::get("sales/charts",[SaleController::class, "chartData"])->name("sales.chartData");
    Route::get("sales-report",[SaleController::class, "report"])->name("sales-report");
    Route::get("sales/print/{sale}",[SaleController::class, "print"])->name("sale-print");
    Route::get("sales/pdf/{sale}",[SaleController::class, "generatePdf"])->name("sale-print-pdf");

    Route::resource('products',ProductController::class)->names('products');
    Route::get("get_products_by_id",[ProductController::class, "get_products_by_id"])->name("get_products_by_id");
    Route::get("get_products_by_barcode",[ProductController::class, "get_products_by_barcode"])->name("get_products_by_barcode");

    Route::resource('categories',CategoryController::class)->names('categories');

    Route::resource('cash-flow',CashFlowController::class)->names('cash-flow');
    Route::get("cash-reports",[CashFlowController::class, "reports"])->name("cash-reports.listing");
});

require __DIR__.'/auth.php';
