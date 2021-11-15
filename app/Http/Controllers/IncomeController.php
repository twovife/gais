<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Inventory;
use App\Models\Vinventory;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stock.income', [
            'treeMenu' => 'stock',
            'subMenu' => 'income',
            'inventories' => Inventory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->inputversion == '2') {
            $inventory_id = $request->inventory_id;
            for ($i = 0; $i < count($inventory_id); $i++) {
                $lastSaldo = Vinventory::find($request->inventory_id[$i])->saldo_temp;
                $request->validate([
                    'btb' => ['required'],
                    'inventory_id.*' => ['required', 'numeric'],
                    'qty_in.*' => ['required', 'numeric'],
                    'harga.*' => ['required', 'numeric'],
                ]);
                $data = [
                    'btb' => $request->btb,
                    'tanggal_btb' => $request->tanggal_btb,
                    'store_id' => $request->store_id,
                    'inventory_id' => $request->inventory_id[$i],
                    'qty_in' => $request->qty_in[$i],
                    'harga' => $request->harga[$i],
                    'saldo' => $lastSaldo + $request->qty_in[$i],
                    'bkk' => $request->bkk[$i],
                    'tanggal_bkk' => $request->tanggal_bkk[$i],
                    'user_input' => 'abang ganteng',
                ];
                Income::create($data);
            };
        }

        return back();

        // $lastSaldo = Vinventory::find($request->inventory_id)->saldo_temp;
        // $data = [
        //     'inventory_id' => $request->inventory_id,
        //     'qty_in' => $request->qty_in,
        //     'saldo' => $lastSaldo + $request->qty_in,
        //     'btb' => $request->btb,
        //     'bkk' => $request->bkk,
        //     'keterangan' => $request->keterangan,
        //     'user_input' => 'admin'
        // ];
        // $dataSaldo = Income::create($data);
        // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }
}
