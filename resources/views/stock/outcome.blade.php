<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">
     <link rel="stylesheet" href="{{ asset('tom-select/dist/css/tom-select.default.css') }}">
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
                                   <a href="{{ route('outcome.create') }}" role="button"
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
     <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}">
     </script>
     <script src="{{ asset('tom-select/dist/cjs/tom-select.complete.js') }}"></script>
     <script>
          const url = '{{ url('api/barangkeluar') }}'
          const urlInventory = '{{ url('api/inventory') }}'
          const urlIsDuplicate = '{{ url('api/isitembtbduplicate') }}'

          const data = loadInventorTables(url)
          
          function loadInventorTables(url) {
               new gridjs.Grid({
                    columns: [{
                         name: "Tanggal",
                    }, {
                         name: "BKB"
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
                         name: "Unit"
                    },{
                         name: "Divisi"
                    },{
                         name: "Request"
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
                    then: data => data.map(card => [convertDate(card.created_at), card.bkb, card.inventory.vinventory.barcode, card.inventory.nama_barang, card.inventory.component_category.kategori, card.inventory.component_unit.satuan, card.qty_out, card.unit, card.divisi, card.nama_request, card.user_input])
               }
               }).render(document.getElementById("wrapper"));
          }

          function convertDate(params) {
               const month = new Array();
               month[0] = "01";
               month[1] = "02";
               month[2] = "03";
               month[3] = "04";
               month[4] = "05";
               month[5] = "06";
               month[6] = "07";
               month[7] = "08";
               month[8] = "09";
               month[9] = "10";
               month[10] = "11";
               month[11] = "12";

               let d = new Date(params)
               let hari = d.getDate()
               let bulan = month[d.getMonth()]
               let tahun = d.getFullYear()
               let margeTanggal = `${hari}/${bulan}/${tahun}`

               return margeTanggal
          }
     </script>
     @endsection
</x-nosidebar>