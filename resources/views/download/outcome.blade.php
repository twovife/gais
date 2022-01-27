<table>
     <thead>
          <tr>
               <th>No</th>
               <th>Tanggal</th>
               <th>BKB</th>
               <th>Nama Barang</th>
               <th>Jenis Barang</th>
               <th>Qty</th>
               <th>Satuan</th>
               <th>Unit</th>
               <th>Divisi</th>
               <th>PIC</th>
               <th>Keterangan</th>
          </tr>
     </thead>
     <tbody>
          @php($i=1)
          @foreach ($datas as $card)
          <tr>
               <td>{{ $i }}</td>
               <td>{{ $card->created_at->format('d-m-Y') }}</td>
               <td>{{ $card->outcome->bkb }}</td>
               <td>{{ $card->inventory->nama_barang }}</td>
               <td>{{ $card->inventory->component_category->kategori }}</td>
               <td>{{ $card->qty_out }}</td>
               <td>{{ $card->inventory->component_unit->satuan }}</td>
               <td>{{ $card->outcome->hc_rank_ga_structure->hc_unit->unit }}</td>
               <td>{{ $card->outcome->hc_rank_ga_structure->hc_sub_unit->sub_unit }}</td>
               <td>{{ $card->outcome->nama_request }}</td>
               <td>{{ $card->keterangan }}</td>
          </tr>
          @php($i++)
          @endforeach
     </tbody>
</table>


{{-- card,
convertDate(card->outcome.created_at),
card.outcome.bkb,
card.inventory.nama_barang,
card.inventory.component_category.kategori,
card.qty_out,
card.inventory.component_unit.satuan,
card.outcome.hc_rank_ga_structure.hc_unit.unit,
card.outcome.hc_rank_ga_structure.hc_sub_unit.sub_unit,
card.outcome.nama_request,
card.outcome.user_input,
card.keterangan --}}