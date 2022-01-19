<?php

namespace App\Http\Controllers;

use App\Models\Hc_rank_ga_structure;
use App\Models\Income;
use App\Models\Income_detail;
use App\Models\Incomereturn;
use App\Models\Inventory;
use App\Models\Outcome;
use App\Models\Outcome_detail;
use App\Models\Outcomereturn;
use App\Models\Store;
use App\Models\Vmutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\Output;

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
            $data = $straws->withTrashed()->get();
        } else {
            $data = Store::withTrashed()->get();
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
            $dates = [];
            $filters = [];

            foreach ($query as $key => $val) {
                if ($key == 'fromdate') {
                    $dates['fromdate'] = $val;
                } else if ($key == 'enddate') {
                    $dates['enddate'] = $val;
                } else {
                    $filters[$key] = $val;
                }
            }
            // dd($dates);

            $straws = Income_detail::query();
            foreach ($dates as $key => $value) {
                if ($key == 'fromdate') {
                    $input = $value . '01:00:00';
                    $date = strtotime($input);
                    $straws->where('created_at', '>=', date('Y-m-d H:i:s', $date));
                } else {
                    $input = $value . '23:59:59';
                    $date = strtotime($input);
                    $straws->where('created_at', '<=', date('Y-m-d H:i:s', $date));
                }
            }

            foreach ($filters as $key => $vals) {
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
            $dates = [];
            $filters = [];

            foreach ($query as $key => $val) {
                if ($key == 'fromdate') {
                    $dates['fromdate'] = $val;
                } else if ($key == 'enddate') {
                    $dates['enddate'] = $val;
                } else {
                    $filters[$key] = $val;
                }
            }

            $straws = Outcome_detail::query();
            foreach ($dates as $key => $value) {
                if ($key == 'fromdate') {
                    $input = $value . ' 01:00:00';
                    $date = strtotime($input);
                    $straws->where('created_at', '>=', date('Y-m-d H:i:s', $date));
                } else {
                    $input = $value . ' 23:59:59';
                    $date = strtotime($input);
                    $straws->where('created_at', '<=', date('Y-m-d H:i:s', $date));
                }
            }

            foreach ($filters as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('outcome.hc_rank_ga_structure.hc_unit', 'outcome.hc_rank_ga_structure.hc_sub_unit', 'inventory', 'inventory.component_category', 'inventory.component_unit')->get();
        } else {
            $data = Outcome_detail::with('outcome.hc_rank_ga_structure.hc_unit', 'outcome.hc_rank_ga_structure.hc_sub_unit', 'inventory', 'inventory.component_category', 'inventory.component_unit')->get();
        }

        return response()->json($data);
    }

    public function IncomeReturn()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $dates = [];
            $filters = [];

            foreach ($query as $key => $val) {
                if ($key == 'fromdate') {
                    $dates['fromdate'] = $val;
                } else if ($key == 'enddate') {
                    $dates['enddate'] = $val;
                } else {
                    $filters[$key] = $val;
                }
            }

            $straws = Incomereturn::query();
            foreach ($dates as $key => $value) {
                if ($key == 'fromdate') {
                    $input = $value . '01:00:00';
                    $date = strtotime($input);
                    $straws->where('created_at', '>=', date('Y-m-d H-i-s', $date));
                } else {
                    $input = $value . '23:59:59';
                    $date = strtotime($input);
                    $straws->where('created_at', '<=', date('Y-m-d H-i-s', $date));
                }
            }

            foreach ($filters as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('income_detail', 'income', 'inventory.component_category', 'inventory.component_unit')->get();
        } else {
            $data = Incomereturn::with('income_detail', 'income', 'inventory.component_category', 'inventory.component_unit')->get();
        }

        return response()->json($data);
    }


    public function OutcomeReturn()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);

            $dates = [];
            $filters = [];

            foreach ($query as $key => $val) {
                if ($key == 'fromdate') {
                    $dates['fromdate'] = $val;
                } else if ($key == 'enddate') {
                    $dates['enddate'] = $val;
                } else {
                    $filters[$key] = $val;
                }
            }

            $straws = Outcomereturn::query();
            foreach ($dates as $key => $value) {
                if ($key == 'fromdate') {
                    $input = $value . '01:00:00';
                    $date = strtotime($input);
                    $straws->where('created_at', '>=', date('Y-m-d H-i-s', $date));
                } else {
                    $input = $value . '23:59:59';
                    $date = strtotime($input);
                    $straws->where('created_at', '<=', date('Y-m-d H-i-s', $date));
                }
            }

            foreach ($filters as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('outcome_detail', 'outcome', 'inventory.component_category', 'inventory.component_unit')->get();
        } else {
            $data = Outcomereturn::with('outcome_detail', 'outcome', 'inventory.component_category', 'inventory.component_unit')->get();
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
        return response()->json($data);
    }

    public function lastValBtb(Request $request)
    {
        return response()->json($request);
        // $qtyin = Income_detail::find($id);
        // $sumreturn = Incomereturn::where('income_detail_id', $id)->sum('qty_out');
        // $data = [
        //     'saldo' => $qtyin->qty_in - $sumreturn
        // ];
        // return response()->json($data);
    }

    public function lastValBkb($id)
    {
        $qtyout = Outcome_detail::find($id);
        $sumreturn = Outcomereturn::where('outcome_detail_id', $id)->sum('qty_in');
        $data = [
            'saldo' => $qtyout->qty_out - $sumreturn
        ];
        return response()->json($data);
    }

    public function vmutasi()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);

            $dates = [];
            $filters = [];

            foreach ($query as $key => $val) {
                if ($key == 'fromdate') {
                    $dates['fromdate'] = $val;
                } else if ($key == 'enddate') {
                    $dates['enddate'] = $val;
                } else {
                    $filters[$key] = $val;
                }
            }

            $straws = Vmutation::query();

            foreach ($dates as $key => $value) {
                if ($key == 'fromdate') {
                    $input = $value . '01:00:00';
                    $date = strtotime($input);
                    $straws->where('created_at', '>=', date('Y-m-d H:i:s', $date));
                } else {
                    $input = $value . '23:59:59';
                    $date = strtotime($input);
                    $straws->where('created_at', '<=', date('Y-m-d H:i:s', $date));
                }
            }

            foreach ($filters as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('inventory.component_category', 'inventory.component_unit', 'vincome', 'voutcome.hc_rank_ga_structure.hc_unit', 'voutcome.hc_rank_ga_structure.hc_sub_unit', 'incomereturn.income_detail', 'outcomereturn.outcome_detail')->get();
        } else {
            $data = Vmutation::with('inventory.component_category', 'inventory.component_unit', 'vincome', 'voutcome.hc_rank_ga_structure.hc_unit', 'voutcome.hc_rank_ga_structure.hc_sub_unit', 'incomereturn.income_detail', 'outcomereturn.outcome_detail')->get();
        }

        return response()->json($data);
    }

    public function organisationRanks()
    {
        $data = Hc_rank_ga_structure::with('hc_unit', 'hc_sub_unit')->get();
        return response()->json($data);
    }

    public function isLastMutation(Request $request)
    {
        $data = Vmutation::where('inventory_id', $request->inventory_id)->where('id', '>=', $request->id)->count();
        return response()->json([
            'status' => '200',
            'data' => $data
        ]);
    }

    public function Btb()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $dates = [];
            $filters = [];

            foreach ($query as $key => $val) {
                if ($key == 'fromdate') {
                    $dates['fromdate'] = $val;
                } else if ($key == 'enddate') {
                    $dates['enddate'] = $val;
                } else {
                    $filters[$key] = $val;
                }
            }

            $straws = Income::query();
            foreach ($dates as $key => $value) {
                if ($key == 'fromdate') {
                    $straws->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '>=', $value);
                } else {
                    $straws->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $value);
                }
            }

            foreach ($filters as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('store')->get();
        } else {
            $data = Income::with('store')->get();
        }

        $arraypush = [];
        foreach ($data as $key) {
            array_push($arraypush, [
                'id' => $key->id,
                'tanggal' => $key->created_at->format('Y-m-d'),
                'btb' => $key->btb,
                'store' => $key->store ? $key->store->nama_toko : '',
                'user_input' => $key->user_input,
            ]);
        };
        return response()->json($arraypush);
    }

    public function Bkb()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $dates = [];
            $filters = [];

            foreach ($query as $key => $val) {
                if ($key == 'fromdate') {
                    $dates['fromdate'] = $val;
                } else if ($key == 'enddate') {
                    $dates['enddate'] = $val;
                } else {
                    $filters[$key] = $val;
                }
            }

            $straws = Outcome::query();
            foreach ($dates as $key => $value) {
                if ($key == 'fromdate') {
                    $straws->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '>=', $value);
                } else {
                    $straws->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $value);
                }
            }

            foreach ($filters as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->with('hc_rank_ga_structure')->get();
        } else {
            $data = Outcome::with('hc_rank_ga_structure')->get();
        }

        $arraypush = [];
        foreach ($data as $key) {
            array_push($arraypush, [
                'id' => $key->id,
                'tanggal' => $key->created_at->format('Y-m-d'),
                'bkb' => $key->bkb,
                'unit' => $key->hc_rank_ga_structure->hc_unit->unit,
                'divisi' => $key->hc_rank_ga_structure->hc_sub_unit->sub_unit,
                'nama' => $key->nama_request,
                'user_input' => $key->user_input,
            ]);
        };
        return response()->json($arraypush);
    }
}
