<?php

namespace App\Http\Controllers;

use App\Models\Vmutation;
use Illuminate\Http\Request;

class VmutationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mutasi.mutation', [
            'treeMenu' => 'mutasi',
            'subMenu' => 'mutasi'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mutasi.kartustock', [
            'treeMenu' => 'mutasi',
            'subMenu' => 'kartu'
        ]);
    }


    public function show($id)
    {
        return view('mutasi.detailmutation', [
            'treeMenu' => 'mutasi',
            'subMenu' => 'kartu',
            'trow_id' => $id
        ]);
    }
}
