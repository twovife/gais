<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Outcome;
use App\Models\Outcome_detail;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class OutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stock.outcome', [
            'treeMenu' => 'Transaction',
            'subMenu' => 'Outcome',
            'inventories' => Inventory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock.outcomecreate', [
            'treeMenu' => 'Transaction',
            'subMenu' => 'Outcome',
            'inventories' => Inventory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //     // ddd($request->all());

        // Backend Validasi
        $detail = $request->inventory_id;
        if (!$detail) {
            session()->flash('eror', 'Mohon isi item yang dikeluarkan terlebih dahulu');
            return redirect('/outcome');
        }
        for ($i = 0; $i < count($detail); $i++) {
            $lastSaldo = Inventory::find($request->inventory_id[$i]);
            // if ($lastSaldo <= Inventory::find($request->inventory_id[$i])->min_stock || !$lastSaldo) {
            if (!$lastSaldo) {
                session()->flash('eror', 'barang yang anda masukkan dinonaktifkan, cek ketersediaan dulu ya');
                return redirect('/outcome');
            } elseif ($lastSaldo->stock - $request->qty_out[$i] <= Inventory::find($request->inventory_id[$i])->min_stock) {
                session()->flash('eror', 'Stock yang anda masukkan < minimum stock, mohon periksa kembali stock nya sapa tau habis');
                return redirect('/outcome');
            }
        }

        $request->validate([
            'bkb' => ['required', 'unique:outcomes'],
            'inventory_id.*' => ['required', 'numeric'],
            'qty_out.*' => ['required', 'numeric']
        ]);


        $dataOutcome = [
            'bkb' => $request->bkb,
            'unit' => $request->unit,
            'divisi' => $request->divisi,
            'nama_request' => $request->nama_request,
            'user_input' => $request->user_input
        ];
        $response_out = Outcome::create($dataOutcome);

        if ($response_out) {
            $detail = $request->inventory_id;
            for ($i = 0; $i < count($detail); $i++) {
                $lastSaldo = Inventory::find($request->inventory_id[$i]);
                $data = [
                    'inventory_id' => $request->inventory_id[$i],
                    'outcome_id' => $response_out->id,
                    'qty_out' => $request->qty_out[$i],
                    'saldo' => $lastSaldo->stock - $request->qty_out[$i]
                ];
                Outcome_detail::create($data);
                $lastSaldo->stock = $lastSaldo->stock - $request->qty_out[$i];
                $lastSaldo->save();
            }
        }
        session()->flash('success', $response_out->id);
        return redirect('/outcome');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function show(Outcome $outcome)
    {

        // $data = Outcome::find(12);
        // $user = $data->outcome_detail;
        // dd($data, $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function edit(Outcome $outcome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outcome $outcome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outcome $outcome)
    {
        //
    }

    public function print(Outcome $outcome)
    {

        $html = view('stock.print', [
            'data' => $outcome,
            'countdata' => ceil(count($outcome->all()) / 6)
        ]);
        $paper = array(0, -10, 595, 311);
        $filename = 'Cetak';
        $stream = TRUE;

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($paper, $orientation = "portrait");

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }
}