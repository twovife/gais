<table>
     <thead>
          <tr>
               <th>No</th>
               <th>Tanggal</th>
               <th>BKB</th>
               <th>Unit</th>
               <th>Divisi</th>
               <th>PIC</th>
               <th>User Input</th>
          </tr>
     </thead>
     <tbody>
          @php($i=1)
          @foreach ($datas as $key)
          <tr>
               <td>{{ $i }}</td>
               <td>{{ $key->created_at->format('Y-m-d') }}</td>
               <td>{{ $key->bkb }}</td>
               <td>{{ $key->hc_rank_ga_structure->hc_unit->unit }}</td>
               <td>{{ $key->hc_rank_ga_structure->hc_sub_unit->sub_unit }}</td>
               <td>{{ $key->nama_request }}</td>
               <td>{{ $key->user_input }}</td>
          </tr>
          @php($i++)
          @endforeach
     </tbody>
</table>