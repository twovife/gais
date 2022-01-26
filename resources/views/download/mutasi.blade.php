<table>
     <thead>
          <tr>
               <th>No</th>
               <th>Tanggal</th>
               <th>Type</th>
               <th>Nomor Transaksi</th>
               <th>Kategory</th>
               <th>Satuan</th>
               <th>Barcode</th>
               <th>Nama Barang</th>
               <th>Masuk</th>
               <th>Keluar</th>
               <th>Saldo</th>
               <th>Harga</th>
               <th>Pic Req</th>
               <th>Unit</th>
               <th>Divisi</th>
               <th>Keterangan</th>
          </tr>
     </thead>
     <tbody>
          @php($i=1)
          @foreach($datas as $data)
          <tr>
               <td>{{ $i }}</td>
               <td>{{ $data->created_at->format('d-m-Y') }}</td>

               {{-- nomor transaksi --}}
               @if ($data->voutcome_id)
               <td>OUT</td>
               @elseif ($data->vincome_id)
               <td>IN</td>
               @elseif ($data->incomereturn_id)
               <td>RTI</td>
               @elseif ($data->outcomereturn_id)
               <td>RTO</td>
               @endif

               {{-- nomor transaksi --}}
               @if ($data->voutcome_id)
               <td>{{ $data->voutcome->bkb }}</td>
               @elseif ($data->vincome_id)
               <td>{{ $data->vincome->btb }}</td>
               @elseif ($data->incomereturn_id)
               <td>{{ $data->incomereturn->nomor_return }}</td>
               @elseif ($data->outcomereturn_id)
               <td>{{ $data->outcomereturn->nomor_return }}</td>
               @endif


               <td>{{ $data->inventory->component_category->kategori }}</td>
               <td>{{ $data->inventory->component_unit->satuan }}</td>
               <td>{{ $data->inventory->barcode }}</td>
               <td>{{ $data->inventory->nama_barang }}</td>

               {{-- is masuk?--}}
               @if ($data->vincome)
               <td>{{ $data->vincome->qty_in }}</td>
               @elseif ($data->outcomereturn)
               <td>{{ $data->outcomereturn->qty_in }}</td>
               @else
               <td></td>
               @endif


               {{-- is keluar?--}}
               @if ($data->voutcome)
               <td>{{ $data->voutcome->qty_out }}</td>
               @elseif ($data->incomereturn)
               <td>{{ $data->incomereturn->qty_out }}</td>
               @else
               <td></td>
               @endif


               {{-- saldo --}}
               @if ($data->voutcome)
               <td>{{ $data->voutcome->saldo }}</td>
               @elseif ($data->vincome)
               <td>{{ $data->vincome->saldo }}</td>
               @elseif ($data->incomereturn)
               <td>{{ $data->incomereturn->saldo }}</td>
               @elseif ($data->outcomereturn)
               <td>{{ $data->outcomereturn->saldo }}</td>
               @endif


               {{-- is format Rp?--}}
               @if ($data->vincome)
               <td>{{ $data->vincome->harga }}</td>
               @elseif ($data->outcomereturn)
               <td>{{ $data->outcomereturn->harga }}</td>
               @elseif ($data->voutcome)
               <td>{{ $data->voutcome->harga }}</td>
               @elseif ($data->incomereturn)
               <td>-{{ $data->incomereturn->harga }}</td>
               @else
               <td></td>
               @endif


               {{-- pic request unit divisi --}}
               @if ($data->voutcome)
               <td>{{ $data->voutcome->nama_request }}</td>
               <td>{{ $data->voutcome->hc_rank_ga_structure->hc_unit->unit }}</td>
               <td>{{ $data->voutcome->hc_rank_ga_structure->hc_sub_unit->sub_unit }}</td>
               @else
               <td></td>
               <td></td>
               <td></td>
               @endif

               {{-- is format Rp?--}}
               @if ($data->vincome)
               <td>{{ $data->vincome->keterangan }}</td>
               @elseif ($data->outcomereturn)
               <td>{{ $data->outcomereturn->keterangan }}</td>
               @elseif ($data->voutcome)
               <td>{{ $data->voutcome->keterangan }}</td>
               @elseif ($data->incomereturn)
               <td>-{{ $data->incomereturn->keterangan }}</td>
               @else
               <td></td>
               @endif
          </tr>

          @php($i++)
          @endforeach
     </tbody>
</table>


{{-- id, voutcome_id, vincome_id, incomereturn_id, outcomereturn_id, inventory_id, created_at --}}