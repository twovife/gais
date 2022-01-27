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
                         <h5 class="mb-3">Kartu Stock</h5>

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
                                   <form id="exportXls" action="{{ route('download.kartustock') }}" method="post">
                                        @csrf
                                        <input type="hidden" id="dfrom" name="dfrom">
                                        <input type="hidden" id="dtrue" name="dtrue">
                                        <input type="hidden" id="id" name="id" value="{{ $trow_id }}">
                                        <button onclick="submitForm(event)"
                                             class="btn btn-outline-info btn-sm">Export</button>
                                   </form>
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
          const url = generategetUrl('{{ url('api/mutasi') }}', {
          fromdate: document.getElementById('fromdate').value,
          enddate: document.getElementById('enddate').value,
          inventory_id: `{{ $trow_id }}`
          })
          
     const showSaldo = (income, outcome, inreturn, outreturn) => {
          if (income !== null) {
               return income.saldo
          } else if (outcome) {
               return outcome.saldo
          } else if (inreturn) {
               return inreturn.saldo
          } else if (outreturn) {
               return outreturn.saldo
          }
     }

     const showKeterangan = (income, outcome, inreturn, outreturn) => {
          if (income !== null) {
               return income.keterangan
          } else if (outcome) {
               return outcome.keterangan
          } else if (inreturn) {
               return inreturn.keterangan
          } else if (outreturn) {
               return outreturn.keterangan
          }
     }

     const loadInventorTables = (url) => {
          new gridjs.Grid({
               columns: [{
                    name: "Tanggal",
               }, {
                    name: "tag",
                    formatter: (cell) => {
                         if (cell == 'income') {
                              return gridjs.html(`<button type="button" class="btn btn-success btn-sm disabled" style="user-select: auto;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                        </svg></button>`)
                         } else if (cell == 'outcome') {
                              return gridjs.html(`<button type="button" class="btn btn-danger btn-sm disabled" style="user-select: auto;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                                        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                                        </svg></button>`)
                         } else if (cell == 'returnincome') {
                              return gridjs.html(`<button type="button" class="btn btn-warning btn-sm disabled" style="user-select: auto;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                                        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                                        </svg></button>`)
                         } else if (cell == 'returnoutcome') {
                              return gridjs.html(`<button type="button" class="btn btn-info btn-sm disabled" style="user-select: auto;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                        </svg></button>`)
                         }
                    }
               }, {
                    name: "Nomor Transaksi"
               }, {
                    name: "Kategory"
               }, {
                    name: "Satuan"
               }, {
                    name: "Barcode"
               }, {
                    name: "Nama Barang"
               }, {
                    name: "Masuk"
               }, {
                    name: "Keluar"
               }, {
                    name: "Saldo",
               }, {
                    name: "Harga"
               }, {
                    name: "Pic Req"
               }, {
                    name: "Divisi"
               }, {
                    name: "Unit"
               },{
                    name: "Keterangan"
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
                         inOrOut(card.vincome, card.voutcome, card.incomereturn, card.outcomereturn),
                         showFlexyData(card.vincome, card.voutcome, card.incomereturn, card.outcomereturn),
                         card.inventory.component_category.kategori,
                         card.inventory.component_unit.satuan,
                         card.inventory.barcode,
                         card.inventory.nama_barang,
                         // isFalse(card.vincome,'qty_in'),
                         // isFalse(card.voutcome??card.incomereturn,'qty_out'),
                         isFalse(card.vincome ?? card.outcomereturn, 'qty_in'),
                         isFalse(card.voutcome ?? card.incomereturn, 'qty_out'),
                         showSaldo(card.voutcome, card.vincome, card.incomereturn, card.outcomereturn),
                         formatRupiah(isFalse(card.vincome ?? (card.incomereturn ? card.incomereturn.income_detail : null), 'harga')),
                         isFalse(card.voutcome, 'nama_request'),
                         isFalse(card.voutcome ? card.voutcome.hc_rank_ga_structure.hc_sub_unit : 'null', 'sub_unit'),
                         isFalse(card.voutcome ? card.voutcome.hc_rank_ga_structure.hc_unit : 'null', 'unit'),
                         showKeterangan(card.voutcome, card.vincome, card.incomereturn, card.outcomereturn),
                    ])
               }
          }).render(document.getElementById("wrapper"));
     }

     const loadJsGrid = loadInventorTables(url)

     const setDate = () => {
          const urls = generategetUrl('{{ url('api/mutasi') }}', {
               fromdate: document.getElementById('fromdate').value,
               enddate: document.getElementById('enddate').value,
               inventory_id: `{{ $trow_id }}`
          })

          document.getElementById("wrapper").remove()
          const elements = document.createElement('div')
          elements.setAttribute('id', 'wrapper')

          document.querySelector('.card-warpper').appendChild(elements)
          const data = loadInventorTables(urls)
     }
     
     const submitForm = (event) => {
          event.preventDefault();
          const dfrom = document.getElementById('dfrom');
          const dtrue = document.getElementById('dtrue');
          dfrom.value = document.getElementById('fromdate').value;
          dtrue.value = document.getElementById('enddate').value;
          event.target.parentNode.submit();
     }
     </script>
     @endsection


</x-nosidebar>