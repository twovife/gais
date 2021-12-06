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
                         <h5 class="mb-3">Master Barang</h5>
                         <div class="d-flex align-items-center">
                              <div class="row w-50">
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
          <div class="card mb-3">
               <div class="card-body">
                    <div id="wrapper"></div>
               </div>
          </div>
     </div>
     {{-- <div class="modal fade text-left" id="creating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
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
                                   <label for="inventory_id" class="form-label">Nama Barang</label>
                                   <div class="form-group">
                                        <select id="inventory_id" name="inventory_id" placeholder="Select an item..."
                                             autocomplete="off">
                                             <option value="">Select Item</option>
                                             @foreach ($inventories as $inventory)
                                             <option value="{{ $inventory->id }}">{{ $inventory->nama_barang }}</option>
                                             @endforeach
                                        </select>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-4">
                                        <div class="mb-3">
                                             <label for="kategori" class="form-label">Kategory</label>
                                             <input readonly type="text" class="form-control" id="kategori">
                                        </div>
                                   </div>
                                   <div class="col-4">
                                        <div class="mb-3">
                                             <label for="satuan" class="form-label">Satuan</label>
                                             <input readonly type="text" class="form-control" id="satuan">
                                        </div>
                                   </div>
                                   <div class="col-4">
                                        <div class="mb-3">
                                             <label for="sisa" class="form-label">Stock Tersisa</label>
                                             <input readonly type="text" class="form-control" id="sisa">
                                        </div>
                                   </div>
                              </div>
                              <div class="mb-3">
                                   <label for="qty_in" class="form-label">QTY</label>
                                   <input type="number" class="form-control" name="qty_in" id="qty_in">
                              </div>
                              <div class="row">
                                   <div class="col-4">
                                        <div class="mb-3">
                                             <label for="btb" class="form-label">BTB</label>
                                             <input type="text" class="form-control" name="btb" id="btb">
                                        </div>
                                   </div>
                                   <div class="col-4">
                                        <div class="mb-3">
                                             <label for="bkk" class="form-label">BKK</label>
                                             <input type="text" class="form-control" name="bkk" id="bkk">
                                        </div>
                                   </div>
                                   <div class="col-4">
                                        <div class="mb-3">
                                             <label for="tanggal_bkk" class="form-label">Tanggal BKK</label>
                                             <input type="date" class="form-control" name="tanggal_bkk"
                                                  id="tanggal_bkk">
                                        </div>

                                   </div>
                              </div>
                              <div class="mb-3">
                                   <label for="keterangan" class="form-label">Keterangan</label>
                                   <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
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
     </div> --}}
     <div class="modal fade text-left" id="creating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
               <div class="modal-content">
                    <form id="formCreate" method="post" action="{{ route('income.store') }}">
                         @csrf
                         <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel4">Create</h4>
                         </div>
                         <div class="modal-body" style="height: 700px">
                              @if ($errors->all())
                              <div class="alert alert-warning" role="alert">
                                   @foreach ($errors->all() as $error)
                                   {{ $error }}<br>
                                   @endforeach
                              </div>
                              @endif
                              <div class="row">
                                   <div class="col-12 col-lg-2">
                                        <div class="card shadow">
                                             <div class="card-header">
                                                  <h4 class="card-title">Detail BTB</h4>
                                             </div>
                                             <div class="card-body">
                                                  <div class="form-group mb-3">
                                                       <label for="roundText" class="form-label">Tanggal Input</label>
                                                       <input disabled type="text" class="form-control round"
                                                            value="Hari Ini">
                                                  </div>
                                                  <div class="form-group mb-3">
                                                       <label for="roundText" class="form-label">Tanggal BTB</label>
                                                       <input type="date" name="tanggal_btb" id="tanggal_btb"
                                                            class="form-control round" required>
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="roundText" class="form-label">Nomor BTB</label>
                                                       <input type="text" name="btb" id="btb" class="form-control round"
                                                            placeholder="Nomor BTB" required>
                                                  </div>
                                                  <div class="form-group">
                                                       <label for="roundText" class="form-label">Nama Toko</label>
                                                       <input type="text" name="store_id" id="store_id"
                                                            class="form-control round" placeholder="Nomor BTB">
                                                       <input type="hidden" name="inputversion" value="2">
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col detailItem">
                                        <div class="card shadow">
                                             <div class="card-header d-flex justify-content-between align-items-center">
                                                  <h4 class="card-title">Detail Barang</h4>
                                                  <div>
                                                       <button type="button"
                                                            class="btn btn-outline-primary btn-sm added">
                                                            + Add Row
                                                       </button>
                                                  </div>
                                             </div>
                                             <div class="card-body">
                                                  <div class="table-responsive">
                                                       <table class="table table-lg">
                                                            <thead>
                                                                 <tr>
                                                                      <th nowrap style="width: 30%">Nama Barang</th>
                                                                      <th style="width: 50px">Kategori</th>
                                                                      <th style="width: 50px">Satuan</th>
                                                                      <th style="width: 50px">Saldo</th>
                                                                      <th style="width: 150px">BKK</th>
                                                                      <th>Tgl BKK</th>
                                                                      <th style="width: 150px">Qty</th>
                                                                      <th style="width: 150px">Price</th>
                                                                      <th></th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody>
                                                                 <tr class="itemTr">
                                                                      <td nowrap>
                                                                           <select nowrap class="inventory_id"
                                                                                id="inventory_id" name="inventory_id[]"
                                                                                placeholder="Tuliskan nama barang / barcode"
                                                                                autocomplete="off" required
                                                                                onchange="fillData(this);">
                                                                                <option value="">Select Item</option>
                                                                                @foreach ($inventories as $inventory)
                                                                                <option value="{{ $inventory->id }}">
                                                                                     {{$inventory->vinventory->barcode}}
                                                                                     :
                                                                                     <small>{{$inventory->nama_barang}}</small>
                                                                                </option>
                                                                                @endforeach
                                                                           </select>
                                                                      </td>
                                                                      <td class="text-bold-500 itemKategory">-</td>
                                                                      <td class="text-bold-500 itemUnit">-</td>
                                                                      <td class="text-bold-500 itemSaldo">-</td>
                                                                      <td>
                                                                           <input type="text" name="bkk[]" id="bkk"
                                                                                class="form-control round"
                                                                                placeholder="Nomor BKK">
                                                                      </td>
                                                                      <td>
                                                                           <input type="date" name="tanggal_bkk[]"
                                                                                id="tanggal_bkk"
                                                                                class="form-control round"
                                                                                placeholder="Nomor BKK">
                                                                      </td>
                                                                      <td>
                                                                           <input disabled type="number" name="qty_in[]"
                                                                                id="qty_in"
                                                                                class="form-control round qty_in"
                                                                                placeholder="Qty">
                                                                      </td>
                                                                      <td>
                                                                           <input type="number" name="harga[]"
                                                                                id="harga" class="form-control round"
                                                                                placeholder="Price">
                                                                      </td>
                                                                      <td class="action">
                                                                           <button type="button"
                                                                                class="btn text-danger removed">
                                                                                x
                                                                           </button>
                                                                      </td>
                                                                 </tr>
                                                            </tbody>
                                                       </table>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-light-secondary" onclick="location.reload();">
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
     <script src="{{ asset('jsgrid/gridjs.umd.js') }}"></script>
     <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
     <script src="{{ asset('tom-select/dist/js/tom-select.complete.js') }}"></script>
     <script>
          const url = '{{ url('api/gaisstock') }}'
          const urlInventory = '{{ url('api/inventory') }}'
          const urlIsDuplicate = '{{ url('api/isitembtbduplicate') }}'
          const cr8Tables = document.getElementById('creating')
          const myModals = new bootstrap.Modal(document.getElementById("creating"), {});
          document.onreadystatechange = function () {
               @if ($errors->all())
               myModals.show();
               @endif
          };
          let indexKe = 1
          cr8Tables.addEventListener('show.bs.modal', async function (event) {

               const itemBtb = document.getElementById('btb')
               const itemDetail = document.querySelector('.detailItem')
               if (!itemBtb.value) {
                    itemDetail.querySelectorAll('input').forEach(inputElm => {
                         inputElm.disabled = true
                    });
                    itemDetail.querySelectorAll('button').forEach(btnElm=>{
                         btnElm.disabled = true
                    })  
               }

               itemBtb.addEventListener('change',function(e){
                    if (!itemBtb.value) {
                         itemDetail.querySelectorAll('input').forEach(element => {
                              element.disabled = true
                         });
                         itemDetail.querySelectorAll('button').forEach(elm=>{
                              elm.disabled = true
                         })
                    }else{
                         itemDetail.querySelectorAll('input').forEach(element => {
                              element.disabled = false
                         });
                         itemDetail.querySelectorAll('button').forEach(elm=>{
                              elm.disabled = false
                         })
                    }
               })

               itemBtb.addEventListener('blur',function(e){
                    e.target.readOnly  = true
               })
               
               this.addEventListener('click',async function(e){
                    if (e.target.classList.contains('added')) {
                         const duplicate = await duplicateTbls(this)
                    }else if (e.target.classList.contains('removed')) {
                         removeTr(e.target)
                    }
               })

               const seleclist = tomSelect('#inventory_id')
          })

          async function duplicateTbls(params) {
                         const treath = params.querySelector('.itemTr')
                         const clonedTreath = treath.cloneNode(true)
                         clonedTreath.firstElementChild.remove()
                         clonedTreath.querySelector('#qty_in').value = ''
                         clonedTreath.querySelector('#harga').value = ''
                         clonedTreath.querySelector('.itemKategory').innerHTML = '-'
                         clonedTreath.querySelector('.itemUnit').innerHTML = '-'
                         clonedTreath.querySelector('.itemSaldo').innerHTML = '-'
                         clonedTreath.querySelector('#bkk').innerHTML = '-'
                         clonedTreath.querySelector('#tanggal_bkk').innerHTML = '-'
                         const selectlist = await defaultSelect(indexKe)
                         clonedTreath.querySelector('td').insertAdjacentHTML("beforebegin", selectlist)
                         params.querySelector('tbody').appendChild(clonedTreath)
                         tomSelect('#inventory_id' + indexKe);
                         indexKe = indexKe + 1
          }

          function removeTr(params){
                         let removeNode = params
                         while (removeNode.className != 'itemTr') {
                              removeNode = removeNode.parentNode
                         }    
                         removeNode.remove()
          }

          async function fillData(element) {
                         const valId = element.value
                         const isDuplicate = await fetchElement(urlIsDuplicate,{'inventory_id':valId,'btb':123})
                         if (isDuplicate==0) {
                              const returnData = await fetchElement(urlInventory,{'id':valId})
                              // console.log(isDuplicate);
                              let nodeParent = element
                              // console.log(nodeParent);
                              while (nodeParent.className != 'itemTr') {
                                   nodeParent = nodeParent.parentNode
                              }
                              // console.log(nodeParent.querySelector('.itemKategory'));
                              nodeParent.querySelector('.itemKategory').innerHTML = returnData[0].component_category.kategori
                              nodeParent.querySelector('.itemUnit').innerHTML = returnData[0].component_unit.satuan
                              nodeParent.querySelector('.itemSaldo').innerHTML = returnData[0].vinventory.saldo_temp
                         }else{
                              Swal.fire('item ini sudah di input').then((response)=>{
                                   removeTr(element)
                              })
                         }
                         
          }



          const data = loadInventorTables(url)
          
          function loadInventorTables(url) {
               new gridjs.Grid({
                    columns: [{
                         name: "BTB",
                    },{
                         name: "Tanggal"
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
                    url: url,
                    then: data => data.map(card => [card.btb, convertDate(card.created_at), card.store.nama_toko, card.inventory.vinventory.barcode, card.inventory.nama_barang, card.inventory.component_category.kategori, card.inventory.component_unit.satuan, card.bkk, convertDate(card.tanggal_bkk), card.qty_in, card.harga, card.keterangan, card.user_input])
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
          
          function tomSelect(id){
               return new TomSelect(id,{
                    create: false,
                    sortField: {
                         field: "text",
                         direction: "asc"
                    }
               });
          }

          function defaultSelect(id) {
               let jsx = '<td>';
               jsx += '<select class="inventory_id" id="inventory_id'+id+'" name="inventory_id[]"';
               jsx += 'placeholder="Select an item..." autocomplete="off" required onchange="fillData(this);">';
               jsx += '<option value="">Select Item</option>';
               @foreach ($inventories as $inventory)
               jsx += '<option value="{{ $inventory->id }}">{{ $inventory->nama_barang}}</option>';
               @endforeach
               jsx += '</select>';
               jsx += '</td>';
               return jsx
          }


          function fetchElement(url,params) {
               return fetch(url+'?'+new URLSearchParams(params), {
                    headers: {
                         'Accept': 'application/json'
                    },
                    method: 'GET',
               })
                    .then(response => response.json())
                    .then(data => data)
          }
     </script>
     @endsection
</x-nosidebar>