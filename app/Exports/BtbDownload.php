<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;


class BtbDownload implements FromView
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
          return view('download.btb', [
               'datas' => $this->data
          ]);
     }
}
