<x-main :treeMenu="$treeMenu" :subMenu="$subMenu">

     @section('css')
     <link rel="stylesheet" href="./jsgrid/theme/mermaid.min.css">
     <link rel="stylesheet" href="./mazer/vendors/sweetalert2/sweetalert2.min.css">
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
                                        data-bs-backdrop="false" data-bs-target="#creating">Create
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
          const url = `http://ihsan-virtualbox/gais/public/api/store`

          const cr8Tables = document.getElementById('creating')
          cr8Tables.addEventListener('show.bs.modal', async function (event) {
               const button = event.relatedTarget
               const receiptId = button.getAttribute('data-bs-id')
               var urlCreate = '{{ route('store.store') }}'
               var urlupdate = '{{ route('store.update',':id') }}'
               urlupdate = urlupdate.replace(':id',receiptId)
               if (receiptId) {
                    const data = await fetchData(url+'?id='+receiptId)
                    this.querySelector('#nama_toko').value = data.nama_toko
                    this.querySelector('#no_toko').value = data.no_toko
                    this.querySelector('#alamat_toko').value = data.alamat_toko
                    this.querySelector('.modal-body').insertAdjacentHTML('beforeend','<input type="hidden" class="form-control" name="id" id="id" value="'+data.id+'">')
                    this.querySelector('#formCreate').insertAdjacentHTML('afterbegin','<input type="hidden" name="_method" id="_method" value="put">')
                    this.querySelector('#formCreate').setAttribute('method','post')
                    this.querySelector('#formCreate').setAttribute('action',urlupdate)
               }else{
                    this.querySelector('#formCreate').setAttribute('method','post')
                    this.querySelector('#formCreate').setAttribute('action',urlCreate)
               }
          })

          cr8Tables.addEventListener('hidden.bs.modal', function (event) {
               const domId = this.querySelector('#id')
               if (domId) {
                    this.querySelector('#id').remove()
                    this.querySelector('#_method').remove()
               }
               this.querySelectorAll('.form-control').forEach(elems=>elems.value=null)
          })
          
          function fetchData(url,id){
               return fetch(url,{
                    headers: {
                         'Accept':'application/json'
                    },
                    method: 'GET'
               })
               .then(response=>response.json())
               .then(data=>data[0])
          }

          const tablesLoad = loadTables(url)
          function loadTables(url){
               new gridjs.Grid({
               columns: [{
                    name: "Nama Toko",
                    formatter: (cell, row) => {
                         return gridjs.html(`<a href="#" class="link-primary fw-bold" data-bs-toggle="modal" data-bs-target="#creating", data-bs-id=${row._cells[4].data}>${cell}</a>`)
                         return gridjs.h('a', {
                              className: 'pe-auto',
                              "data-bs-toggle" : "modal",
                              "data-bs-target" : "#creating",
                              "data-bs-id" : cell,
                         }, cell);
                    }
               }, {
                    name: "Kode Toko"
               },{
                    name: "No. Telp"
               },{
                    name: "Alamat"
               },{
                    name: "Delete",
                    formatter: (cell, row) => {
                         return gridjs.html(formDelete(cell))
                    }
               }],
               search: true,
               pagination: {
                    limit: 10
                    },
               server: {
                    url: url,
                    then: data => data.map(card => [card.nama_toko, card.vstore.kode_toko, card.no_toko, card.alamat_toko,card.id])
               }
               }).render(document.getElementById("wrapper"));
          }
          

          function formDelete(id){
               var urlupdate = '{{ route('store.destroy',':id') }}'
               urlupdate = urlupdate.replace(':id',id)
               return `<form action="${urlupdate}" method="post">@csrf @method("delete")<button onClick="validate(this)" type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></form>`
          }

          function validate(e) {
               
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