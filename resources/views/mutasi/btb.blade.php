<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">

     <style>
          table tr td,
          th {
               text-align: center;
          }

          table tr td,
          th:nth-child(1) {
               max-width: 100px;
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
                                   <div class="col">
                                        <div class="row row-cols-lg-auto g-3 align-items-center">
                                             <div class="col-5">
                                                  <label class="visually-hidden" for="fromdate">Username</label>
                                                  <div class="input-group">
                                                       <div class="input-group-text">From</div>
                                                       <input type="date" class="form-control" id="fromdate"
                                                            name="fromdate" placeholder="Username"
                                                            value="{{ $tanggal = date('Y-m-d', strtotime('Last Sunday')) }}">
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
          const urls = generategetUrl('{{ url('api/btb') }}', {
               fromdate: document.getElementById('fromdate').value,
               enddate: document.getElementById('enddate').value
          })
          // const urls = '{{ url('api/btb') }}'

          const loadtables = (url) =>{
               new gridjs.Grid({
                    columns: [{
                         name: "Action",
                         formatter: (cell) => {
                              const id = cell
                              return gridjs.html(`<a role="button" href="btb/${cell}" class="btn btn-sm btn-primary">Show</a>`)
                         }
                    },{
                         name: "Tanggal"
                    },{
                         name: "Store"
                    },{
                         name: "BTB"
                    },{
                         name: "User Input"
                    },],
                    search: true,
                    className: {
                         table: "table table-sm table-striped"
                    },
                    pagination: {
                         limit: 20
                    },
                    server:{
                         url: url,
                         then: data => data.map(card=>[
                              card.id,
                              card.tanggal,
                              card.store,
                              card.btb,
                              card.user_input
                         ])
                    }
               }).render(document.getElementById("wrapper"));
          }

          const setDate = () => {
               const url = generategetUrl('{{ url('api/btb') }}', {
                    fromdate: document.getElementById('fromdate').value,
                    enddate: document.getElementById('enddate').value
               })
          
               document.getElementById("wrapper").remove()
               const elements = document.createElement('div')
               elements.setAttribute('id', 'wrapper')
          
               document.querySelector('.card-warpper').appendChild(elements)
               const data = loadtables(url)
          }

          const onloadtables = loadtables(urls)

          
     </script>

     @endsection


</x-nosidebar>