<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Component_category;
use App\Models\Component_unit;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.inventory', [
            'treeMenu' => 'master',
            'subMenu' => 'inventory',
            'kategories' => Component_category::all(),
            'units' => Component_unit::all()
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
        $prefix = Component_category::where('id', $request->component_category_id)->first();
        $rowNumb = Inventory::where('component_category_id', $request->component_category_id)->count() + 1;

        if ($rowNumb < 10) {
            $request['barcode'] = $prefix->prefiks . '00' . $rowNumb;
        } else if ($rowNumb >= 10 && $rowNumb <= 99) {
            $request['barcode'] = $prefix->prefiks . '0' . $rowNumb;
        } else {
            $request['barcode'] = $prefix->prefiks . $rowNumb;
        }
        $request['stock'] = 0;
        $responseOut = Inventory::create($request->all());
        if ($responseOut) {
            session()->flash('success', 'Sukses Menambahkan Data');
        } else {
            session()->flash('error', 'Data Gagal ditambahkan');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        Inventory::find($inventory->id)->update($request->all());
        return redirect('inventory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return back();
    }
}
