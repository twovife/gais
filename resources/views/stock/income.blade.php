<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">
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

     @if (session()->has('success'))
     <div class="alert alert-success" role="alert">
          Berhasil Menambahkan Data
     </div>
     @elseif (session()->has('eror'))
     <div class="alert alert-danger" role="alert">
          {{ session()->get('eror') }}
     </div>
     @endif


     <div class="container-fluid">
          <div class="card mb-3">
               <div class="card-body">
                    <div class="card-title">
                         <h5 class="mb-3">Barang Masuk</h5>
                         <div class="d-flex align-items-center">
                              <div class="row w-50">
                                   <div class="col">
                                        <div class="row row-cols-lg-auto g-3 align-items-center">
                                             <div class="col-5">
                                                  <label class="visually-hidden" for="fromdate">Username</label>
                                                  <div class="input-group">
                                                       <div class="input-group-text">From</div>
                                                       <input type="date" class="form-control" id="fromdate"
                                                            name="fromdate" placeholder="Username"
                                                            value="{{ $tanggal = date('Y-m-d') }}">
                                                  </div>
                                             </div>

                                             <div class="col-5">
                                                  <label class="visually-hidden" for="enddate">Username</label>
                                                  <div class="input-group">
                                                       <div class="input-group-text">To</div>
                                                       <input type="date" class="form-control" id="enddate"
                                                            name="enddate" placeholder="Username"
                                                            value="{{ $tanggal = date('Y-m-d') }}">
                                                  </div>
                                             </div>

                                             <div class="col">
                                                  <button type="btn" class="btn btn-primary"
                                                       onclick="setDate()">Search</button>
                                             </div>
                                        </div>
                                   </div>
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
               <div class="card-body card-warpper">
                    <div id="wrapper"></div>
               </div>
          </div>
     </div>

     @section('javascript')
     <script src="{{ asset('jsgrid/gridjs.umd.js') }}"></script>
     <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
     <script>
          const url = '{{ url('api/gaisstock') }}'
          const urli = generategetUrl(url,{
               fromdate: document.getElementById('fromdate').value,
               enddate: document.getElementById('enddate').value
          })

          const loadInventorTables = (parameter) => {
               new gridjs.Grid({
                    columns: [{
                         name: "Tanggal",
                    },{
                         name: "BTB"
                    },{
                         name: "Nama Toko"
                    },{
                         name: "Kode Barang"
                    },{
                         name: "Nama Barang"
                    },{
                         name: "Jenis Barang"
                    },{
                         name: "Satuan"
                    },{
                         name: "BKK"
                    },{
                         name: "Tgl BKK"
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
                    url: parameter,
                    then: data => data.map(card => [
                         convertDate(card.income.created_at),
                         card.income.btb,
                         card.income.store?card.income.store.nama_toko:'',
                         card.inventory.barcode,
                         card.inventory.nama_barang,
                         card.inventory.component_category.kategori,
                         card.inventory.component_unit.satuan,
                         card.bkk,
                         card.tanggal_bkk,
                         card.qty_in,
                         formatRupiah(card.harga),
                         card.keterangan,
                         card.income.user_input
                    ])
               }
               }).render(document.getElementById("wrapper"));
          }

          const data = loadInventorTables(urli)

          const setDate = () => {
               const urls = generategetUrl(url,{
               fromdate: document.getElementById('fromdate').value,
               enddate: document.getElementById('enddate').value
               })

               document.getElementById("wrapper").remove()
               const elements = document.createElement('div')
               elements.setAttribute('id','wrapper')

               document.querySelector('.card-warpper').appendChild(elements)
               const data = loadInventorTables(urls)
          }
     </script>
     @endsection
</x-nosidebar>