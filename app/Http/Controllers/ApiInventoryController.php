<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class ApiInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Inventory::all();
        foreach ($datas as $key) {
            $key->component_category;
            $key->component_unit;
        }
        return response()->json($datas);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Store  $Store
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Store $Store)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Store  $Store
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Store $Store)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Store  $Store
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Store $Store)
    // {
    //     //
    // }
}
