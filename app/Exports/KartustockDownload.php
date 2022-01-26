<?php

namespace App\Exports;

use App\Models\Vmutation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class KartustockDownload implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;


    public function setter($data)
    {
        $this->data = $data;
        return $this;
    }
    public function view(): View
    {
        return view('download.mutasi', [
            'datas' => $this->data
        ]);
    }

    // public function query()
    // {
    //     $query = Vmutation::query();
    //     $data = $query->with('inventory.component_category', 'inventory.component_unit', 'vincome', 'voutcome.hc_rank_ga_structure.hc_unit', 'voutcome.hc_rank_ga_structure.hc_sub_unit', 'incomereturn.income_detail', 'outcomereturn.outcome_detail');
    //     return $data->select('created_at',,)->whereInventory_id($this->id);
    // }
}
