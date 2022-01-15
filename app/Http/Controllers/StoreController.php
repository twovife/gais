<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        if (Store::create($request->all())) {
            return back()->with('success', 'Sukses Menambahkan Data');
        } else {
            return back()->with('error', 'Data Gagal ditambahkan');
        };
    }

    public function update(Request $request, Store $store)
    {
        if ($store->update($request->all())) {
            return back()->with('success', 'Sukses Menambahkan Data');
        } else {
            return back()->with('error', 'Data Gagal ditambahkan');
        };
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
