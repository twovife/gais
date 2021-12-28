<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Incomereturn;
use App\Models\Inventory;
use App\Models\Store;
use Illuminate\Http\Request;

class IncomereturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('return.income', [
            'treeMenu' => 'Transaction',
            'subMenu' => 'Return Income',

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('return.incomereturn', [
            'treeMenu' => 'Transaction',
            'subMenu' => 'Return Income',
            'noBtb' => Income::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $masterInventory = Inventory::find($request->inventory_id);
        if ($masterInventory->stock < $request->qty_out) {
            session()->flash('eror', 'barang yang diretun mengalami perubahan stock');
            return redirect('/inreturn');
            exit;
        } else {
            $request['saldo'] = $masterInventory->stock - $request->qty_out;
            $request['nomor_return'] = 'RTI-' . $request->income_id . '-' . $request->income_detail_id . '-' . Incomereturn::count() + 1;
            $response_out = Incomereturn::create($request->all());
            if ($response_out) {
                $masterInventory->stock = $masterInventory->stock - $request->qty_out;
                $masterInventory->save();
                session()->flash('success', $response_out->id);
                return redirect('/inreturn');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incomereturn  $incomereturn
     * @return \Illuminate\Http\Response
     */
    public function show(Incomereturn $incomereturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incomereturn  $incomereturn
     * @return \Illuminate\Http\Response
     */
    public function edit(Incomereturn $incomereturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incomereturn  $incomereturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incomereturn $incomereturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incomereturn  $incomereturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incomereturn $incomereturn)
    {
        //
    }
}
