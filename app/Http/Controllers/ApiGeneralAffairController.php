<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Income_detail;
use App\Models\Incomereturn;
use App\Models\Inventory;
use App\Models\Outcome;
use App\Models\Outcome_detail;
use App\Models\Store;
use App\Models\Vmutation;
use Illuminate\Http\Request;

class ApiGeneralAffairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json('Kamu telah terkoneksi dengan API');
    }

    // GENERATE API FRO STORE TABLE
    public function store()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Store::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->get();
        } else {
            $data = Store::all();
        }
        foreach ($data as $key) {
            $key->vstore;
        }
        return response()->json($data);
    }

    // GENERATE API FOR INVENTORY TABLE
    public function Inventory()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Inventory::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, 'LIKE', "%{$vals}%");
            }
            $data = $straws->withTrashed()->with('component_category', 'component_unit')->get();
        } else {
            $data = Inventory::withTrashed()->with('component_category', 'component_unit')->get();
        }

        return response()->json($data);
    }

    public function inventoryForSelect()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Inventory::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, 'LIKE', "%{$vals}%");
            }
            $data = $straws->with('component_category', 'component_unit', 'vinventory')->get();
        } else {
            $data = Inventory::with('component_category', 'component_unit', 'vinventory')->get();
        }

        return response()->json($data);
    }


    // Generate API for income ( with relationalship )
    public function BarangMasuk()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Income_detail::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('income.store', 'inventory.component_category', 'inventory.component_unit')->get();
        } else {
            $data = Income_detail::with('income.store', 'inventory.component_category', 'inventory.component_unit')->get();
        }

        return response()->json($data);
    }


    public function BarangKeluar()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Outcome_detail::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('outcome', 'inventory', 'inventory.component_category', 'inventory.component_unit')->get();
        } else {
            $data = Outcome_detail::with('outcome', 'inventory', 'inventory.component_category', 'inventory.component_unit')->get();
        }

        return response()->json($data);
    }

    public function IncomeReturn()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Incomereturn::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('income_detail.income', 'income_detail.inventory')->get();
        } else {
            $data = Incomereturn::with('income_detail', 'income', 'inventory.component_category', 'inventory.component_unit')->get();
        }

        return response()->json($data);
    }



    public function isExistItem()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Income::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->count();
        } else {
            $data = Income::count();
        }

        return response()->json($data);
    }

    public function lastStock()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Inventory::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('vinventory')->get();
        } else {
            $data = Inventory::with('vinventory')->all();
        }
        // foreach ($data as $key) {
        //     $key->vinventory;
        // }

        return response()->json($data);
    }

    public function vmutasi()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Vmutation::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('inventory.component_category', 'inventory.component_unit', 'inventory.vinventory', 'vincome', 'voutcome', 'incomereturn.income_detail')->get();
        } else {
            $data = Vmutation::with('inventory.component_category', 'inventory.component_unit', 'inventory.vinventory', 'vincome', 'voutcome', 'incomereturn.income_detail')->get();
        }

        return response()->json($data);
    }
}
