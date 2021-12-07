<?php

namespace App\Http\Controllers;

use App\Models\Incomereturn;
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
            'subMenu' => 'Return Income'
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
        //
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
