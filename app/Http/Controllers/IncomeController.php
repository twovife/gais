<?php

namespace App\Http\Controllers;

use App\Models\Hc_rank_ga_structure;
use App\Models\Income;
use App\Models\Income_detail;
use App\Models\Inventory;
use App\Models\Store;
use App\Models\Vinventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'treeMenu' => 'Transaction',
            'subMenu' => 'Income',
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
        return view('stock.incomecreate', [
            'treeMenu' => 'Transaction',
            'subMenu' => 'Income',
            'inventories' => Inventory::all(),
            'stores' => Store::all(),
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
        $detail = $request->inventory_id;
        if (!$detail) {
            session()->flash('eror', 'Mohon isi item yang dikeluarkan terlebih dahulu');
            return redirect('/income');
        }

        $request->validate([
            'btb' => ['required', 'unique:incomes'],
            'inventory_id.*' => ['required', 'numeric'],
            'qty_in.*' => ['required', 'numeric']
        ]);

        $dataIncome = [
            'store_id' => $request->store_id,
            'btb' => 'BTB-' . $request->btb,
            'tanggal_btb' => $request->tanggal_btb,
            'user_input' =>  Auth::user()->username
        ];
        $response_out = Income::create($dataIncome);
        if ($response_out) {
            $detail = $request->inventory_id;
            for ($i = 0; $i < count($detail); $i++) {
                $lastSaldo = Inventory::find($request->inventory_id[$i]);
                $data = [
                    'inventory_id' => $request->inventory_id[$i],
                    'income_id' => $response_out->id,
                    'bkk' => $request->bkk[$i] ? 'BKK-' . $request->bkk[$i] : null,
                    'tanggal_bkk' => $request->tanggal_bkk[$i],
                    'qty_in' => $request->qty_in[$i],
                    'harga' => $request->harga[$i],
                    'saldo' => $lastSaldo->stock + $request->qty_in[$i],
                    'keterangan' => $request->keterangan[$i]
                ];
                Income_detail::create($data);
                $lastSaldo->stock = $lastSaldo->stock + $request->qty_in[$i];
                $lastSaldo->save();
            }
        }

        session()->flash('success', $response_out->id);
        return redirect('/income');
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
    public function update(Request $request, Income_detail $income)
    {
        // dd($income->qty_in);
        if ($request->qty_in && $request->qty_in != $income->qty_in) {
            $data = Inventory::whereId($income->inventory_id)->first();
            $saldo = $data->stock - $income->qty_in + $request->qty_in;

            $mainresponse = $data->update(['stock' => $saldo]);

            if (!$mainresponse) {
                session()->flash('eror', 'Item telah terupdate !');
                return back();
            }
            $request['saldo'] = $saldo;
        }

        $request['bkk'] = $request->bkk ? 'BKK-' . $request->bkk : null;
        $response = $income->update($request->all());

        if (!$response) {
            session()->flash('eror', 'Item telah terupdate !');
        }
        session()->flash('success', 'Item telah terupdate !');
        return back();
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
