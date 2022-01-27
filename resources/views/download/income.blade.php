<table>
     <thead>
          <tr>
               <th>No</th>
               <th>Tanggal</th>
               <th>BTB</th>
               <th>Nama Toko</th>
               <th>Nama Barang</th>
               <th>Jenis</th>
               <th>Satuan</th>
               <th>BKK</th>
               <th>Tanggal BKK</th>
               <th>QTY</th>
               <th>Harga</th>
               <th>Total</th>
               <th>Keterangan</th>
          </tr>
     </thead>
     <tbody>
          @php($i=1)
          @foreach ($datas as $card)
          <tr>
               <td>{{ $i }}</td>
               <td>{{ $card->created_at }}</td>
               <td>{{ $card->income->btb }}</td>

               {{-- store --}}
               @if ($card->income->store)
               <td>{{ $card->income->store->nama_toko }}</td>
               @else
               <td></td>
               @endif

               <td>{{ $card->inventory->nama_barang }}</td>
               <td>{{ $card->inventory->component_category->kategori }}</td>
               <td>{{ $card->inventory->component_unit->satuan }}</td>
               <td>{{ $card->bkk }}</td>
               <td>{{ $card->tanggal_bkk }}</td>
               <td>{{ $card->qty_in }}</td>
               <td>{{ $card->harga }}</td>
               <td>{{ $card->harga*$card->qty_in }}</td>
               <td>{{ $card->keterangan }}</td>
          </tr>
          @php($i++)
          @endforeach
     </tbody>
</table>