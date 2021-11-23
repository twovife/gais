<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Outcome;
use App\Models\Vinventory;
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
            'treeMenu' => 'stock',
            'subMenu' => 'outcome',
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
            'treeMenu' => 'stock',
            'subMenu' => 'outcome',
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
        ddd($request->all());
        // $inventory_id = $request->inventory_id;
        // for ($i = 0; $i < count($inventory_id); $i++) {
        //     $lastSaldo = Vinventory::find($request->inventory_id[$i])->saldo_temp;
        //     $request->validate([
        //         'bkb' => ['required'],
        //         'inventory_id.*' => ['required', 'numeric'],
        //         'qty_out.*' => ['required', 'numeric']
        //     ]);
        //     $data = [
        //         'inventory_id' => $request->inventory_id[$i],
        //         'qty_out' => $request->qty_out[$i],
        //         'saldo' => $lastSaldo - $request->qty_out[$i],
        //         'bkb' => $request->bkb,
        //         'unit' => $request->unit,
        //         'divisi' => $request->divisi,
        //         'nama_request' => $request->nama_request,
        //         'user_input' => 'abang ganteng',
        //     ];
        //     Outcome::create($data);
        // }
        // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function show(Outcome $outcome)
    {
        //
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

    public function print()
    {
        $html = view('stock.print');
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
