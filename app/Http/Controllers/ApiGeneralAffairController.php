<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Inventory;
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

    public function BarangMasuk()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Income::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->get();
        } else {
            $data = Income::all();
        }

        foreach ($data as $key) {
            $key->inventory->component_category;
            $key->inventory->component_unit;
            $key->inventory->vinventory;
        }

        return response()->json($data);
    }

    public function Inventory()
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'] ? $url_components['query'] : null, $query);
            $straws = Inventory::query();
            foreach ($query as $key => $vals) {
                $straws->where($key, $vals);
            }
            $data = $straws->get();
        } else {
            $data = Inventory::all();
        }
        foreach ($data as $key) {
            $key->component_category;
            $key->component_unit;
            $key->vinventory;
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
}
