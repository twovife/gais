<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Outcome;
use App\Models\Outcomereturn;
use Illuminate\Http\Request;

class OutcomereturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('return.outcome', [
            'treeMenu' => 'Transaction',
            'subMenu' => 'Return Outcome'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('return.outcomereturn', [
            'treeMenu' => 'Transaction',
            'subMenu' => 'Return Outcome',
            'noBtb' => Outcome::all()
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
        // dd(Outcomereturn::count() + 1);
        $masterInventory = Inventory::find($request->inventory_id);
        if ($masterInventory->stock < $request->qty_in) {
            session()->flash('eror', 'barang yang diretun mengalami perubahan stock');
            return redirect('/outreturn');
            exit;
        } else {
            $request['saldo'] = $masterInventory->stock + $request->qty_in;
            $request['nomor_return'] = 'RTO-' . $request->outcome_id . '-' . $request->outcome_detail_id . '-' . (Outcomereturn::count() + 1);
            $response_out = Outcomereturn::create($request->all());
            if ($response_out) {
                $masterInventory->stock = $masterInventory->stock + $request->qty_in;
                $masterInventory->save();
                session()->flash('success', $response_out->id);
                return redirect('/outreturn');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outcomereturn  $outcomereturn
     * @return \Illuminate\Http\Response
     */
    public function show(Outcomereturn $outcomereturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outcomereturn  $outcomereturn
     * @return \Illuminate\Http\Response
     */
    public function edit(Outcomereturn $outcomereturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outcomereturn  $outcomereturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outcomereturn $outcomereturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outcomereturn  $outcomereturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outcomereturn $outcomereturn)
    {
        //
    }
}
