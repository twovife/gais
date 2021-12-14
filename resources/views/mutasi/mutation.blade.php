<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">
     <style>
          .table-responsive {
               height: 50vh;
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

          tr td:nth-child(9) {
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
          const url = '{{ url('api/mutasi') }}'
          const loadJsGrid = loadInventorTables(url)
          function loadInventorTables(url) {
               new gridjs.Grid({
                    columns: [{
                         name: "Tanggal"
                    },{
                         name: "tag",
                         formatter: (cell) => {
                              if (cell == 'income') {
                                   return gridjs.html(`<button type="button" class="btn btn-success btn-sm disabled" style="user-select: auto;">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                                   <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                   </svg></button>`)
                              }else if (cell == 'outcome') {
                                   return gridjs.html(`<button type="button" class="btn btn-danger btn-sm disabled" style="user-select: auto;">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                                   <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                                   </svg></button>`)
                              }else if (cell == 'returnincome') {
                                   return gridjs.html(`<button type="button" class="btn btn-warning btn-sm disabled" style="user-select: auto;">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                                   <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                                   </svg></button>`)
                              }else if (cell == 'returnoutcome') {
                                   return gridjs.html(`<button type="button" class="btn btn-info btn-sm disabled" style="user-select: auto;">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                                   <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                   </svg></button>`)
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
                         inOrOut(card.vincome,card.voutcome,card.incomereturn,card.outcomereturn),
                         showFlexyData(card.vincome,card.voutcome,card.incomereturn,card.outcomereturn),
                         card.inventory.component_category.kategori,
                         card.inventory.component_unit.satuan,
                         card.inventory.barcode,
                         card.inventory.nama_barang,
                         // isFalse(card.vincome,'qty_in'),
                         isFalse(card.vincome??card.outcomereturn,'qty_in'),
                         isFalse(card.voutcome??card.incomereturn,'qty_out'),
                         formatRupiah(isFalse(card.vincome??(card.incomereturn?card.incomereturn.income_detail:null),'harga')),
                         isFalse(card.voutcome,'nama_request'),
                         isFalse(card.voutcome,'divisi'),
                         isFalse(card.voutcome,'unit')
                         ])
               }
               }).render(document.getElementById("wrapper"));
          }

     </script>
     @endsection


</x-nosidebar>