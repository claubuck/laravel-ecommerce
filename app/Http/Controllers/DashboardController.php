<?php

namespace App\Http\Controllers;

use App\Models\cashFlow;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $salesByDay = Sale::select(DB::raw('DATE(sale_date) as sale_day'), DB::raw('SUM(total) as total_sales'))
                 ->groupBy('sale_day')
                 ->orderBy('sale_day')
                 ->get();

                 $salesByMonth = Sale::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as month"), DB::raw("SUM(total) as total_sales"))
                 ->groupBy('month')
                 ->get();

        /* $sales = Sale::get(); */
        $sales = Sale::select(DB::raw('SUM(total) as total'), DB::raw('MONTH(sale_date) as month'))
            ->whereYear('sale_date', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(sale_date)'))
            ->get();
        //Ventas por dia
        $cashFlow = cashFlow::where('closed', '<>', 1)->first();
        if ($cashFlow) {
            $inicio = $cashFlow->inicio;
        $fin = $cashFlow->fin;

        $sale = Sale::whereBetween('created_at', [$inicio, $fin])->get();
        $totalSalesToday = $sale->sum('total');
        $todaySalesCount = $sale->count();
    }else{
        $totalSalesToday= '---No hay un turno iniciado';
        $todaySalesCount= 'No hay un turno iniciado';
    }

        // Obtener el monto de ventas del mes actual
        $monthSalesTotal = Sale::whereMonth('sale_date', Carbon::now()->month)->sum('total');

        

        $totalStock = Product::sum('stock');

        return view('dashboard', compact('sales','totalSalesToday', 'monthSalesTotal','todaySalesCount','totalStock','salesByMonth','salesByDay'));
    }

    public function chartData()
{
    $salesByDay = Sale::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
        ->groupBy('date')
        ->get();

    return response()->json(['salesByDay' => $salesByDay]);
}
}
