<?php

namespace App\Http\Controllers;

use App\Models\Bkbreturn;
use App\Models\Inventory;
use Illuminate\Http\Request;

class BkbreturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stock.bkbreturn', [
            'treeMenu' => 'stock',
            'subMenu' => 'returnbkb',
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
        return view('stock.bkbreturncreate', [
            'treeMenu' => 'stock',
            'subMenu' => 'returnbkb',
            'inventories' => Inventory::all()
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Return  $bkbreturn
     * @return \Illuminate\Http\Response
     */
    public function show(Bkbreturn $bkbreturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Return  $bkbreturn
     * @return \Illuminate\Http\Response
     */
    public function edit(Bkbreturn $bkbreturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Return  $bkbreturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bkbreturn $bkbreturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Return  $bkbreturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bkbreturn $bkbreturn)
    {
        //
    }
}
