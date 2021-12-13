<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">
     <link rel="stylesheet" href="{{ asset('tom-select/dist/css/tom-select.default.css') }}">
     <style>
          .table-responsive {
               height: 50vh;
          }

          tr th:not(:first-child) {
               text-align: center;
          }

          tr td:not(:first-child) {
               text-align: center;
          }

          tr td:nth-child(3) {
               text-align: left;
          }

          tr td:nth-child(11) {
               text-align: right;
          }

          .harus::after {
               content: '*';
               padding-left: .6rem;
               color: red;
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
                                   <a href="{{ route('income.create') }}" role="button"
                                        class="btn btn-secondary btn-sm">Create
                                   </a>
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
          const url = '{{ url('api/inreturn') }}'
          const data = loadInventorTables(url)
          
          function loadInventorTables(url) {
               new gridjs.Grid({
                    columns: [{
                         name: "Tanggal",
                    },{
                         name: "Nomor Return"
                    },{
                         name: "Nomor BTB"
                    },{
                         name: "Kode Barang"
                    },{
                         name: "Nama Barang"
                    },{
                         name: "Jenis Barang"
                    },{
                         name: "Satuan"
                    },{
                         name: "Qty"
                    },{
                         name: "Harga"
                    },{
                         name: "Keterangan"
                    },{
                         name: "User"
                    }],
                    search: true,
                    className: {
                         table: "table table-sm"
                    },
                    pagination: {
                    limit: 10
               },
                    server: {
                    url: url,
                    then: data => data.map(card => [
                         convertDate(card.created_at),
                         card.nomor_return,
                         card.income_detail.income.btb,
                         card.income_detail.inventory.nama_barang,
                         card.income_detail.inventory.nama_barang,
                         card.income_detail.inventory.nama_barang
                    ])
               }
               }).render(document.getElementById("wrapper"));
          }
     </script>
     @endsection
</x-nosidebar>