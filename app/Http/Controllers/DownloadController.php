<?php

namespace App\Http\Controllers;

use App\Exports\BkbDownload;
use App\Exports\BtbDownload;
use App\Exports\IncomeDownload;
use Illuminate\Http\Request;
use App\Exports\KartustockDownload;
use App\Exports\MutasiDownload;
use App\Exports\OutcomeDownload;
use App\Exports\RincomeDownload;
use App\Exports\RoutcomeDownload;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Income_detail;
use App\Models\Incomereturn;
use App\Models\Inventory;
use App\Models\Outcome;
use App\Models\Outcome_detail;
use App\Models\Outcomereturn;
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

        $query = Inventory::whereId($request->id)->first('nama_barang');
        $nama_barang = strtolower(str_replace(' ', '_', $query->nama_barang));
        $name = 'data_mutasi_' . $nama_barang . '.xlsx';

        return (new KartustockDownload)->setter($data)->download($name);
    }

    public function mutasi(Request $request)
    {
        $query = Vmutation::query();

        if ($request->dfrom) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '>=', $request->dfrom);
        }
        if ($request->dtrue) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $request->dtrue);
        }

        $data = $query->get();

        return (new MutasiDownload)->setter($data)->download('data_mutasi.xlsx');
    }

    public function income(Request $request)
    {
        $query = Income_detail::query();

        if ($request->dfrom) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '>=', $request->dfrom);
        }
        if ($request->dtrue) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $request->dtrue);
        }

        $data = $query->get();
        // dd($data);
        return (new IncomeDownload)->setter($data)->download('data_barang_masuk.xlsx');
    }

    public function outcome(Request $request)
    {
        $query = Outcome_detail::query();

        if ($request->dfrom) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '>=', $request->dfrom);
        }
        if ($request->dtrue) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $request->dtrue);
        }

        $data = $query->get();
        // dd($data);
        return (new OutcomeDownload)->setter($data)->download('data_barang_keluar.xlsx');
    }

    public function rincome(Request $request)
    {
        $query = Incomereturn::query();

        if ($request->dfrom) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '>=', $request->dfrom);
        }
        if ($request->dtrue) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $request->dtrue);
        }

        $data = $query->get();
        // dd($data);
        return (new RincomeDownload)->setter($data)->download('data_return_barang_masuk.xlsx');
    }

    public function routcome(Request $request)
    {
        $query = Outcomereturn::query();

        if ($request->dfrom) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '>=', $request->dfrom);
        }
        if ($request->dtrue) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $request->dtrue);
        }

        $data = $query->get();
        // dd($data);
        return (new RoutcomeDownload)->setter($data)->download('data_return_barang_keluar.xlsx');
    }

    public function btb(Request $request)
    {
        $query = Income::query();

        if ($request->dfrom) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '>=', $request->dfrom);
        }
        if ($request->dtrue) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $request->dtrue);
        }

        $data = $query->get();
        // dd($data);
        return (new BtbDownload)->setter($data)->download('data_btb.xlsx');
    }

    public function bkb(Request $request)
    {
        $query = Outcome::query();

        if ($request->dfrom) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '>=', $request->dfrom);
        }
        if ($request->dtrue) {
            $query->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $request->dtrue);
        }

        $data = $query->get();
        // dd($data);
        return (new BkbDownload)->setter($data)->download('data_bkb.xlsx');
    }
}
