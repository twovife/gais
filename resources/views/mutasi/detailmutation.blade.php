<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">
     <style>
          .gridjs-tr *:nth-child(10),
          .gridjs-tr *:nth-child(9),
          .gridjs-tr *:nth-child(8) {
               background: rgba(255, 211, 211, 0.53);
               color: black;
               font-weight: 800;
          }

          tr th {
               text-align: center;
          }

          tr td {
               text-align: center;
          }




          tr td:nth-child(1),
          tr td:nth-child(7) {
               text-align: left;
          }

          tr td:nth-child(11) {
               text-align: right;
          }
     </style>
     @endsection


     <div class="container-fluid">
          <div class="card mb-3">
               <div class="card-body">
                    <div class="card-title">
                         <h5 class="mb-3">Master Barang</h5>
                         <div class="d-flex align-items-center">
                              <div class="row w-50">
                              </div>
                              <div class="extra-btn ms-auto">
                                   <button class="btn btn-outline-info btn-sm">Export</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="card mb-3">
               <div class="card-body">
                    <div id="wrapper"></div>
               </div>
          </div>
     </div>

     @section('javascript')
     <script src="{{ asset('jsgrid/gridjs.umd.js') }}"></script>
     <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

     <script>
          const url = '{{ url('api/mutasi') }}?inventory_id={{ $trow_id }}'
          const loadJsGrid = loadInventorTables(url)
          function loadInventorTables(url) {
               new gridjs.Grid({
                    columns: [{
                         name: "Tanggal",
                    },{
                         name: "tag",
                         formatter: (cell) => {
                              if (cell == 'income') {
                                   return gridjs.html(`<i class="bi bi-caret-down-fill" style="color:green;"></i>`)
                              }else if (cell == 'outcome') {
                                   return gridjs.html(`<i class="bi bi-caret-up-fill" style="color:red;"></i>`)
                              }else if (cell == 'return') {
                                   return gridjs.html(`<i class="bi bi-caret-down-square-fill" style="color:red;"></i>`)
                              }
                         }
                    },{
                         name: "Nomor Transaksi"
                    },{
                         name: "Kategory"
                    },{
                         name: "Satuan"
                    },{
                         name: "Barcode"
                    },{
                         name: "Nama Barang"
                    },{
                         name: "Masuk"
                    },{
                         name: "Keluar"
                    },{
                         name: "Saldo",
                    },{
                         name: "Harga"
                    },{
                         name: "Pic Req"
                    },{
                         name: "Divisi"
                    },{
                         name: "Unit"
                    }],
                    search: true,
                    className: {
                         table: "table table-sm table-striped"
                    },
                    pagination: {
                    limit: 10
               },
                    server: {
                    url: url,
                    then: data => data.map(card => [
                         convertDate(card.created_at),
                         inOrOut(card.vincome,card.voutcome,card.bkbreturn),
                         showFlexyData(card.vincome,card.voutcome,card.bkbreturn),
                         // isFalse(card.vincome,'btb'),
                         card.inventory.component_category.kategori,
                         card.inventory.component_unit.satuan,
                         card.inventory.vinventory.barcode,
                         card.inventory.nama_barang,
                         isFalse(card.vincome,'qty_in'),
                         isFalse(card.voutcome,'qty_out'),
                         showSaldo(card.voutcome??card.vincome),
                         formatRupiah(isFalse(card.vincome,'harga')),
                         isFalse(card.voutcome,'nama_request'),
                         isFalse(card.voutcome,'divisi'),
                         isFalse(card.voutcome,'unit')
                         ])
               }
               }).render(document.getElementById("wrapper"));
          }

          function showSaldo(data){
               return data.saldo
          }


     </script>
     @endsection


</x-nosidebar>