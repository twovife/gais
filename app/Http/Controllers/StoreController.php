<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.store', [
            'treeMenu' => 'master',
            'subMenu' => 'store',
            'stores' => Store::withTrashed()->OrderBy('id', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        Store::create($request->all());
        return back();
    }

    public function update(Request $request, Store $store)
    {
        Store::find($store->id)->update($request->all());
        return redirect('store');
    }

    public function destroy(Store $Store)
    {
        $Store->delete();
        return redirect('store');
    }

    public function restore(Request $request, $store)
    {
        Store::withTrashed()->find($store)->restore();
        return redirect('store');
        // $store = Store::withTrashed()->find($request->id)->first();
    }
}
