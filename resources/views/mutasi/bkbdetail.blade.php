<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <style>
          table tr th,
          td {
               text-align: center;
          }
     </style>
     @endsection
     <div class="container-fluid">
          <div class="card mb-3">
               <div class="card-body">
                    <div class="card-title">
                         <h5 class="mb-3">Master Barang</h5>
                         <div class="d-flex align-items-center">

                              <div class="extra-btn ms-auto">
                                   <a role="button" href="{{ route('outcome.print',$outcomes->id) }}" target="_blank"
                                        class="btn btn-outline-info btn-sm">Print</a>
                                   <a role="button" href="{{ route('bkb.index') }}"
                                        class="btn btn-outline-info btn-sm">Back</a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="card mb-3">
               <div class="card-body card-warpper">
                    <div id="wrapper">
                         <table class="table">
                              <thead>
                                   <tr>
                                        <th>Tanggal</th>
                                        <th>Nomor BKB</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Unit</th>
                                        <th>Divisi</th>
                                        <th>Nama Request</th>
                                        <th>Keterangan</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   @foreach ($outcomes->outcome_detail as $data)
                                   <tr>
                                        <td>{{ $outcomes->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $outcomes->bkb }}</td>
                                        <td>{{ $data->inventory->nama_barang }}</td>
                                        <td>{{ $data->qty_out }}</td>
                                        <td>{{ $outcomes->hc_rank_ga_structure->hc_unit->unit }}</td>
                                        <td>{{ $outcomes->hc_rank_ga_structure->hc_sub_unit->sub_unit }}</td>
                                        <td>{{ $outcomes->nama_request }}</td>
                                        <td>{{ $outcomes->keterangan }}</td>
                                   </tr>
                                   @endforeach
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</x-nosidebar>