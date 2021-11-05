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
                                   <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        data-bs-backdrop="false" data-bs-target="#creating">Create
                                   </button>
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

     <div class="modal fade text-left" id="creating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
               <div class="modal-content">
                    <form id="formCreate">
                         @csrf
                         <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel4">Create</h4>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                   x
                              </button>
                         </div>
                         <div class="modal-body">
                              <div class="mb-3">
                                   <label for="component_category_id" class="form-label">Kategori</label>
                                   <select class="form-select" aria-label="Default select example"
                                        name="component_category_id" id="component_category_id">
                                        @foreach ($kategories as $kategory)
                                        <option value="{{ $kategory->id }}">{{ $kategory->kategori }}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <div class="mb-3">
                                   <label for="component_unit_id" class="form-label">Satuan</label>
                                   <select class="form-select" aria-label="Default select example"
                                        name="component_unit_id" id="component_unit_id">
                                        @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->satuan }}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <div class="mb-3">
                                   <label for="nama_barang" class="form-label">Nama Barang</label>
                                   <input type="text" class="form-control" name="nama_barang" id="nama_barang" required>
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                   <i class="bi bi-x d-block d-sm-none"></i>
                                   <span class="d-none d-sm-block">Close</span>
                              </button>
                              <button type="submit" class="btn btn-primary ml-1">
                                   <i class=" bi bi-check d-block d-sm-none"></i>
                                   <span class="d-none d-sm-block">Accept</span>
                              </button>
                         </div>
                    </form>
               </div>
          </div>
     </div>

     @section('javascript')
     <script src="./jsgrid/gridjs.umd.js"></script>
     <script src="./mazer/vendors/sweetalert2/sweetalert2.all.min.js"></script>
     <script>
          const url = `http://ihsan-virtualbox/gais/public/api/inventory`
          
          const formInputMasterBarang = document.getElementById('creating')
          formInputMasterBarang.addEventListener('show.bs.modal', async function (event) {
               const button = event.relatedTarget
               const receiptId = button.getAttribute('data-bs-id')
               var urlCreate = '{{ route('inventory.store') }}'
               var urlupdate = '{{ route('inventory.update',':id') }}'
               urlupdate = urlupdate.replace(':id', receiptId)
               if (receiptId) {
                    const data = await fetchMasterData(url + '?id=' + receiptId)
                    console.log(data);
                    this.querySelector('#component_category_id option[value="3"]').setAttribute('selected','selected')
                    this.querySelector('#component_unit_id option[value="3"]').setAttribute('selected','selected')
                    this.querySelector('#nama_barang').value = data.nama_barang
                    this.querySelector('.modal-body').insertAdjacentHTML('beforeend', '<input type="hidden" class="form-control" name="id" id="id" value="' + data.id + '">')
                    this.querySelector('#formCreate').insertAdjacentHTML('afterbegin', '<input type="hidden" name="_method" id="_method" value="put">')
                    this.querySelector('#formCreate').setAttribute('method', 'post')
                    this.querySelector('#formCreate').setAttribute('action', urlupdate)
               } else {
                    this.querySelector('#formCreate').setAttribute('method', 'post')
                    this.querySelector('#formCreate').setAttribute('action', urlCreate)
               }
          })

          formInputMasterBarang.addEventListener('hidden.bs.modal', function (event) {
               const domId = this.querySelector('#id')
               if (domId) {
                    this.querySelector('#id').remove()
                    this.querySelector('#_method').remove()
               }
               this.querySelectorAll('.form-control').forEach(elems => elems.value = null)
          })

          const tablesLoad = loadInventorTables(url)
          function loadInventorTables(url) {
               new gridjs.Grid({
                    columns: [{
                         name: "Kode Barang",
                         formatter: (cell, row) => {
                              return gridjs.html(`<a href="#" class="link-primary fw-bold" data-bs-toggle="modal" data-bs-target="#creating", data-bs-id=${row._cells[4].data}>${cell}</a>`)
                              return gridjs.h('a', {
                                   className: 'pe-auto',
                                   "data-bs-toggle": "modal",
                                   "data-bs-target": "#creating",
                                   "data-bs-id": cell,
                              }, cell);
                         }
                    }, {
                         name: "Kategori"
                    }, {
                         name: "Nama Barang"
                    }, {
                         name: "Satuan"
                    }, {
                         name: "Delete",
                         formatter: (cell, row) => {
                              const routes = '{{ route('inventory.destroy','theid') }}'
                              return gridjs.html(formDeleteMaster(cell, routes))
                    }
                    }],
                    search: true,
                    pagination: {
                    limit: 10
               },
                    server: {
                    url: url,
                    then: data => data.map(card => [card.vinventory.barcode, card.component_category.kategori, card.nama_barang, card.component_unit.satuan, card.id])
               }
               }).render(document.getElementById("wrapper"));
          }
          
          function fetchMasterData(url, id) {
               return fetch(url, {
                    headers: {
                         'Accept': 'application/json'
                    },
                    method: 'GET'
               })
                    .then(response => response.json())
                    .then(data => data[0])
          }

          function formDeleteMaster(id, routes) {
               var urlupdate = routes
               urlupdate = urlupdate.replace('theid', id)
               return `<form action="${urlupdate}" method="post">@csrf @method("delete")<button onClick="validateDeleteMaster(this)" type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></form>`
          }

          function validateDeleteMaster(e) {

               const domForm = e.parentNode
               Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
               }).then((result) => {
                    if (result.isConfirmed) {
                         Swal.fire(
                              'Deleted!',
                              'Your file has been deleted.',
                              'success').then((result) => domForm.submit())
                    }
               })
          }
     </script>
     @endsection
</x-main>