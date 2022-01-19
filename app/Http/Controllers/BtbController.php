<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class BtbController extends Controller
{
    public function index()
    {
        return view('mutasi.btb', [
            'treeMenu' => 'mutasi',
            'subMenu' => 'Data BTB'
        ]);
    }

    public function show($income)
    {
        // return json_encode(Income::with('income_detail.inventory')->whereId($income)->first());
        return view('mutasi.btbdetail', [
            'treeMenu' => 'mutasi',
            'subMenu' => 'Data BTB',
            'incomes' => Income::with('income_detail.inventory', 'store')->whereId($income)->first()
        ]);
    }
}
