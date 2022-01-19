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
                                   <a role="button" href="{{ route('btb.index') }}"
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
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nomor BTB</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga Satuan</th>
                                        <th scope="col">Nama Toko</th>
                                        <th scope="col">Nomor BKK</th>
                                        <th scope="col">Tanggal BKK</th>
                                        <th scope="col">Keterangan</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   @foreach ($incomes->income_detail as $detail)
                                   <tr>
                                        <td>{{ $incomes->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $incomes->btb }}</td>
                                        <td>{{ $detail->inventory->nama_barang }}</td>
                                        <td>{{ $detail->qty_in }}</td>
                                        <td>{{ $detail->harga }}</td>
                                        <td>{{ $incomes->store?$incomes->store->nama_toko:'' }}</td>
                                        <td>{{ $detail->bkk }}</td>
                                        <td>{{ $detail->tanggal_bkk }}</td>
                                        <td>{{ $detail->keterangan }}</td>
                                   </tr>
                                   @endforeach
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</x-nosidebar>