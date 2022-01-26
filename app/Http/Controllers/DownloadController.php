<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\KartustockDownload;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Vmutation;

class DownloadController extends Controller
{
    public function index()
    {
        dd('apa yang ingin anda download');
    }

    public function KartuStock(Request $request)
    {
        // dd($request->dfrom);
        $query = Vmutation::query();

        if ($request->dfrom) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '>=', $request->dfrom);
        }
        if ($request->dtrue) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $request->dtrue);
        }

        $data = $query->where('inventory_id', $request->id)->get();
        // dd($data);
        return (new KartustockDownload)->setter($data)->download('text.xlsx');
    }
}
