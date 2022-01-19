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
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
               <div class="modal-content">
                    <form id="formCreate">

                         <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel4">Create / Edit</h4>
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
                              <div class="mb-3">
                                   <label for="min_stock" class="form-label">Min Stock</label>
                                   <input type="number" class="form-control" name="min_stock" id="min_stock" required>
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                   <i class="bi bi-x d-block d-sm-none"></i>
                                   <span class="d-none d-sm-block">Close</span>
                              </button>
                              @if (Auth::user()->role == 2 || Auth::user()->role == 99)
                              @csrf
                              <button type="submit" class="btn btn-primary ml-1">
                                   <i class=" bi bi-check d-block d-sm-none"></i>
                                   <span class="d-none d-sm-block" id="tombol-sbm">Create</span>
                              </button>
                              @endif
                         </div>
                    </form>
               </div>
          </div>
     </div>

     @section('javascript')
     <script src="./jsgrid/gridjs.umd.js"></script>
     <script src="./mazer/vendors/sweetalert2/sweetalert2.all.min.js"></script>
     <script>
          const url = `{{ url('api/inventory') }}`
          
          const formInputMasterBarang = document.getElementById('creating')
          formInputMasterBarang.addEventListener('show.bs.modal', async function (event) {
               const button = event.relatedTarget
               const receiptId = button.getAttribute('data-bs-id')
               var urlCreate = '{{ route('inventory.store') }}'
               var urlupdate = '{{ route('inventory.update',':id') }}'
               urlupdate = urlupdate.replace(':id', receiptId)
               if (receiptId) {
                    const data = await fetchMasterData(url + '?id=' + receiptId)
                    this.querySelector('#component_category_id option[value="3"]').setAttribute('selected','selected')
                    this.querySelector('#component_unit_id option[value="3"]').setAttribute('selected','selected')
                    this.querySelector('#nama_barang').value = data.nama_barang
                    this.querySelector('#min_stock').value = data.min_stock
                    this.querySelector('span#tombol-sbm').innerText = 'Update'

                    this.querySelector('.modal-body').insertAdjacentHTML('beforeend', '<input type="hidden" class="form-control" name="id" id="id" value="' + data.id + '">')
                    this.querySelector('#formCreate').insertAdjacentHTML('afterbegin', '<input type="hidden" name="_method" id="_method" value="put">')
                    this.querySelector('#formCreate').setAttribute('method', 'post')
                    this.querySelector('#formCreate').setAttribute('action', urlupdate)
               } else {
                    this.querySelector('#formCreate').setAttribute('method', 'post')
                    this.querySelector('#formCreate').setAttribute('action', urlCreate)
                    this.querySelector('span#tombol-sbm').innerText = 'Create'
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
               const roles = `{{ Auth::user()->role }}`
               new gridjs.Grid({
                    columns: [{
                         name: "Kode Barang",
                         formatter: (cell, row) => {
                              return gridjs.html(`<a href="#" class="link-primary fw-bold" data-bs-toggle="modal" data-bs-target="#creating", data-bs-id=${cell.id}>${cell.barcode}</a>`)
                              // return gridjs.h('a', {
                              //      className: 'pe-auto',
                              //      "data-bs-toggle": "modal",
                              //      "data-bs-target": "#creating",
                              //      "data-bs-id": cell,
                              //      "disabled":"disabled"
                              // }, cell);
                         }
                    }, {
                         name: "Kategori"
                    }, {
                         name: "Nama Barang"
                    }, {
                         name: "Satuan"
                    },{
                         name: "Min Stock"
                    }, {
                         name: "Keterangan",
                         formatter: (cell, row) => {
                              return !cell ? 'Aktif' : 'Non Aktif';
                         }
                    }, {
                         name: "Action",
                         formatter: (cell, row) => {
                              if (row._cells[5].data === null) {
                                   return gridjs.html(formDeleteMaster(cell,roles))
                              }else{
                                   return gridjs.html(formRestore(cell,roles))
                              }
                         }
                    }],
                    search: true,
                    pagination: {
                         limit: 10
                    },
                    server: {
                         url: url,
                         then: data => data.map(card => [
                              card,
                              card.component_category.kategori,
                              card.nama_barang, 
                              card.component_unit.satuan, 
                              card.min_stock, 
                              card.deleted_at, 
                              card])
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

          function formDeleteMaster(id,roles) {
               var urlupdate = '{{ route('inventory.destroy','theid') }}'
               // var urlupdate = routes
               urlupdate = urlupdate.replace('theid', id)
               return `<form action="${urlupdate}" method="post">@csrf @method("delete")<button onClick="validate(this)" type="button" ${roles == 100? 'disabled':''} class="btn btn-danger">Delete</button></form>`
          }

          function formRestore(id,roles){
               var urlupdate = '{{ route('inventory.restore',':id') }}'
               urlupdate = urlupdate.replace(':id',id)
               return `<form action="${urlupdate}" method="post">@csrf @method("put")<button onClick="validate(this)" type="button" ${roles == 100? 'disabled':''} class="btn btn-warning"><i class="bi bi-arrow-clockwise"></i></button></form>`
          }

          function validate(e) {
               
               const domForm = e.parentNode
               Swal.fire({
               title: 'Are you sure?',
               text: "Anda tidak bisa mengulang aksi ini",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, do it!'
          }).then((result) => {
               if (result.isConfirmed) {
                    Swal.fire(
                         'Submited!',
                         'Your file has been modified.',
                         'success').then((result)=>domForm.submit())
               }
          })
          }

          @if (Session::has('success'))
               Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
               })
          @elseif (Session::has('error'))
               Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
               })
          @endif
          
     </script>
     @endsection
</x-main>