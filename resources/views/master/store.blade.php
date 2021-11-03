<x-main :treeMenu="$treeMenu" :subMenu="$subMenu">

     @section('css')
     <link rel="stylesheet" href="./jsgrid/theme/mermaid.min.css">
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
          <div class="card">
               <div class="card-body">
                    <div class="card-title">
                         <h5 class="mb-3">Stores</h5>
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
                                   <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        data-bs-backdrop="false" data-bs-target="#creating">
                                        Create
                                   </button>
                                   <button class="btn btn-outline-info btn-sm">Export</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="card">
               <div class="card-body">
                    <div id="wrapper"></div>
               </div>
          </div>
     </div>


     <div class="modal fade text-left" id="creating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
               <div class="modal-content">
                    <form action="{{ route('store.store') }}" method="post">
                         @csrf
                         <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel4">Create</h4>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                   x
                              </button>
                         </div>
                         <div class="modal-body">
                              <div class="mb-3">
                                   <label for="nama_toko" class="form-label">Nama Toko</label>
                                   <input type="text" class="form-control" name="nama_toko" id="nama_toko">
                              </div>
                              <div class="mb-3">
                                   <label for="no_toko" class="form-label">Nomor Telp</label>
                                   <input type="text" class="form-control" name="no_toko" id="no_toko">
                              </div>
                              <div class="mb-3">
                                   <label for="alamat_toko" class="form-label">Alamat</label>
                                   <input type="text" class="form-control" name="alamat_toko" id="alamat_toko">
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                   <i class="bi bi-x d-block d-sm-none"></i>
                                   <span class="d-none d-sm-block">Close</span>
                              </button>
                              <button type="submit" class="btn btn-primary ml-1">
                                   <i class="bi bi-check d-block d-sm-none"></i>
                                   <span class="d-none d-sm-block">Accept</span>
                              </button>
                         </div>
                    </form>
               </div>
          </div>
     </div>


     @section('javascript')
     <script src="./jsgrid/gridjs.umd.js"></script>
     <script>
          const url = `http://ihsan-virtualbox/gais/public/api/tbstore`
          const tablesLoad = loadTables(url)
          function loadTables(url){
               new gridjs.Grid({
               columns: [{
                    name: "Nama Toko"
               }, {
                    name: "Kode Toko"
               },{
                    name: "No. Telp"
               },{
                    name: "Alamat"
               },{
                    name: "Action",
                    formatter: (cell, row) => {
                         return gridjs.h('button', {
                              className: 'btn btn-warning btn-sm',
                              onClick: () => alert(`Editing "${row.cells[0].data}" "${row.cells[1].data}"`)
                         }, 'Edit');
                    }
               }],
               search: true,
               pagination: {
                    limit: 10
                    },
               server: {
                    url: url,
                    then: data => data.map(card => [card.nama_toko, card.vstore.kode_toko, card.no_toko, card.alamat_toko,card.alamat_toko])
               }
               }).render(document.getElementById("wrapper"));
          }

          function huttons(){
               return `<button>asdasd</button>`
          }
     </script>
     @endsection
</x-main>