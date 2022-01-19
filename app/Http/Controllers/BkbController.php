<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use Illuminate\Http\Request;

class BKbController extends Controller
{
    public function index()
    {
        return view('mutasi.bkb', [
            'treeMenu' => 'mutasi',
            'subMenu' => 'Data BKB'
        ]);
    }

    public function show($outcome)
    {
        // return json_encode(Outcome::with('hc_rank_ga_structure.hc_unit', 'hc_rank_ga_structure.hc_sub_unit')->whereId($outcome)->first());
        return view('mutasi.bkbdetail', [
            'treeMenu' => 'mutasi',
            'subMenu' => 'Data BTB',
            'outcomes' => Outcome::with('hc_rank_ga_structure.hc_unit', 'hc_rank_ga_structure.hc_sub_unit', 'outcome_detail')->whereId($outcome)->first()
        ]);
    }
}
