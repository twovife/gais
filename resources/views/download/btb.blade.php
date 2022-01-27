<table>
     <thead>
          <tr>
               <th>No</th>
               <th>Tanggal</th>
               <th>Store</th>
               <th>BTB</th>
               <th>User Input</th>
          </tr>
     </thead>
     <tbody>
          @php($i=1)
          @foreach ($datas as $key)
          <tr>
               <td>{{ $i }}</td>
               <td>{{ $key->created_at->format('d-m-Y') }}</td>
               <td>{{ $key->store->nama_toko }}</td>
               <td>{{ $key->btb }}</td>
               <td>{{ $key->user_input }}</td>
          </tr>
          @php($i++)
          @endforeach
     </tbody>
</table>