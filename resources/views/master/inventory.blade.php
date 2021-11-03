<x-main :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">
     <style>
          .extra-btn {
               display: flex;
          }


          .extra-btn button:not(:last-child) {
               margin-right: 10px;
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
                                   {{-- <div class="col">
                                        <input type="text" class="form-control" placeholder="Nama Toko, Nomor toko"
                                             aria-label="City">
                                   </div>
                                   <div class="col">
                                        <button class="btn btn-outline-warning">Find</button>
                                   </div> --}}
                              </div>
                              <div class="extra-btn ms-auto">
                                   <button class="btn btn-secondary">Create</button>
                                   <button class="btn btn-outline-info">Export</button>
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
     <script>
          const url = `http://ihsan-virtualbox/gais/public/api/inventory`
          const tablesLoad = loadTables(url)
          function loadTables(url){
               new gridjs.Grid({
               columns: ["Barcode", "Kategory", "Nama Barang", "Satuan"],
               search: true,
               pagination: {
                    limit: 10
                    },
               server: {
                    url: url,
                    then: data => data.map(card => [card.barcode, card.component_category.kategori, card.nama_barang, card.component_unit.satuan])
               }
               }).render(document.getElementById("wrapper"));
          }
     </script>
     @endsection
</x-main>