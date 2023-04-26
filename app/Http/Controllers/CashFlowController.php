<?php

namespace App\Http\Controllers;

use App\Models\cashFlow;
use App\Http\Requests\StorecashFlowRequest;
use App\Http\Requests\UpdatecashFlowRequest;
use App\Models\Sale;
use Carbon\Carbon;

class CashFlowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashFlow = cashFlow::where('closed', '<>', 1)->first();
        if ($cashFlow) {
            $inicio = $cashFlow->inicio;
        $fin = $cashFlow->fin;

        $sale = Sale::whereBetween('created_at', [$inicio, $fin])->get();
        $sales = $sale->sum('total');

        $balance = $sales + $cashFlow->start;
        return view('cashflows.index', compact('cashFlow', 'sales', 'balance'));
        } else{
            $cashFlow = '';
            $sales = '';
            $balance= '';
            return view('cashflows.index', compact('cashFlow', 'sales', 'balance'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cashflows.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecashFlowRequest $request)
    {
        $validatedData = $request->validate([
            'inicio' => 'required|date',
            'fin' => 'required|date',
            'start' => 'required|numeric',
        ]);

        $cashFlow = new cashFlow();
        $cashFlow->inicio = Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['inicio'], 'UTC');
        $cashFlow->fin = Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['fin'], 'UTC');
        $cashFlow->start = $validatedData['start'];
        $cashFlow->save();

        return redirect()->route('cash-flow.index')->with('success', 'Flujo de caja iniciado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(cashFlow $cashFlow)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cashFlow $cashFlow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecashFlowRequest $request, cashFlow $cashFlow)
    {
        $validatedData = $request->validate([
            'closing_cash' => 'required|numeric',
            'sales' => 'required|numeric',
        ]); 

        $cashFlow->update([
            'closing_cash' => $validatedData['closing_cash'],
            'sales' => $validatedData['sales'],
            'closed' => 1,
        ]);
    
        return redirect()->route('cash-flow.index')
            ->with('success', 'Caja cerrada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cashFlow $cashFlow)
    {
        //
    }

    public function reports()
    {
        $cashFlow = cashFlow::where('closed', '=', 1)->get();
        return view('cashflows.reports', compact('cashFlow'));
    }
}
