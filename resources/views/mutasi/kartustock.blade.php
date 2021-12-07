<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">

     <style>
          tr th {
               text-align: center;
          }

          /* tr td {
               text-align: center;
          } */

          tr td:not(:nth-child(2)) {
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
          const url = '{{ url('api/inventory') }}'
          const loadJsGrid = loadInventorTables(url)
          function loadInventorTables(url) {
               new gridjs.Grid({
                    columns: [{
                         name: "Barcode",
                    },{
                         name: "Nama Barang"
                    },{
                         name: "Kategori"
                    },{
                         name: "Satuan"
                    },{
                         name: "Min Stock"
                    },{
                         name: "Last Stock"
                    },{
                         name: "Show Detail",
                         width: "100px",
                         formatter: (cell, row) => {
                              const routes = '{{ route('inventory.destroy','theid') }}'
                              return gridjs.html(formDeleteMaster(cell, routes))
                         },
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
                         card.vinventory.barcode,
                         card.nama_barang,
                         card.component_category.kategori,
                         card.component_unit.satuan,
                         card.vinventory.qty_in,
                         card.vinventory.saldo_temp,
                         card.id,
                         ])
               }
               }).render(document.getElementById("wrapper"));
          }

          function formDeleteMaster(id, routes) {
               var urlupdate = routes
               urlupdate = urlupdate.replace('theid', id)
               return `<a class="btn btn-primary btn-sm" href="{{ url('mutasi/${id}') }}" role="button">Show</a>`
          }

     </script>
     @endsection


</x-nosidebar>