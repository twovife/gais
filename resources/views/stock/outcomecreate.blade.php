<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <style>
          tr>th {
               text-align: center;
          }

          tr>td:not(:first-child) {
               text-align: center;
          }

          td>input {
               border: none;
               text-align: center;
          }

          .swal2-container {
               z-index: 100000,  !important;
          }
     </style>
     @endsection
     <div class="container-fluid">
          <div class="card mb-3 bg-transparent">
               <div class="card-body">
                    <div class="card-title mb-3">
                         <div class="d-flex align-items-center">
                              <div class="row w-50">
                                   <h5 class="mb-3">Master Barang</h5>
                              </div>
                              <div class="extra-btn ms-auto">
                                   <a href="{{ route('outcome.index') }}" role="button"
                                        class="btn btn-secondary btn-sm">Back
                                   </a>
                              </div>
                         </div>
                    </div>
                    <form action="{{ route('outcome.store') }}" method="post">
                         @csrf
                         <div class="row">
                              <div class="col-3">
                                   <div class="card shadow">
                                        <div class="card-body">
                                             <div class="mb-3">
                                                  <label for="roundText" class="form-label">Tanggal Input</label>
                                                  <input disabled type="text" class="form-control round"
                                                       value="Hari Ini">
                                             </div>
                                             <div class="mb-3">
                                                  <label for="bkb" class="form-label">Nomor BKB</label>
                                                  <input type="text" class="form-control" name="bkb" id="bkb"
                                                       placeholder="Nomor BKK">
                                             </div>
                                             <div class="mb-3">
                                                  <label for="unit" class="form-label">Unit</label>
                                                  <input type="text" class="form-control" name="unit" id="unit"
                                                       placeholder="Nomor BKK">
                                             </div>
                                             <div class="mb-3">
                                                  <label for="divisi" class="form-label">Divisi</label>
                                                  <input type="text" class="form-control" name="divisi" id="divisi"
                                                       placeholder="Nomor BKK">
                                             </div>
                                             <div class="mb-3">
                                                  <label for="nama_request" class="form-label">PIC Request</label>
                                                  <input type="text" class="form-control" name="nama_request"
                                                       id="nama_request" placeholder="Nomor BKK">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="card shadow">
                                        <div class="card-body">
                                             <div class="input-group mb-3">
                                                  <input type="text" class="form-control" id="inputItem"
                                                       placeholder="Input Barcode">
                                                  <span class="input-group-text" id="basic-addon2">F4</span>
                                             </div>
                                             <div class="table-responsive">
                                                  <table class="table">
                                                       <thead>
                                                            <tr>
                                                                 <th scope="col">#</th>
                                                                 <th scope="col">Barcode</th>
                                                                 <th scope="col">Nama Barang</th>
                                                                 <th scope="col">Qty Out</th>
                                                            </tr>
                                                       </thead>
                                                       <tbody id="daftarKeluar">
                                                       </tbody>
                                                  </table>
                                             </div>
                                        </div>
                                        <div class="card-footer">
                                             <button class="btn btn-danger" type="submit">submit</button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>

     <div class="modal fade" id="selectItem" data-bs-backdrop="static" data-bs-keyboard="false"
          aria-labelledby="selectItemLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="selectItemLabel">Pilih Barang</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <div class="input-group input-group-lg mb-3">
                              <span class="input-group-text" id="inputGroup-sizing-lg">Cari Nama Barang</span>
                              <input type="text" class="form-control" aria-label="Sizing example input" id="findItem"
                                   aria-describedby="inputGroup-sizing-lg">
                         </div>
                         <div class="table-responsive" style="height: 400px">
                              <table class="table table-sm">
                                   <thead>
                                        <tr>
                                             <th scope="col">Nama Barang</th>
                                             <th scope="col">Min Stock</th>
                                             <th scope="col">Last Stock</th>
                                             <th scope="col" style="width: 30px">Action</th>
                                        </tr>
                                   </thead>
                                   <tbody id="resultSearch">
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="modal fade" id="selectCount" aria-labelledby="selectCountLabel" aria-hidden="true" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="selectItemLabel">Pilih Barang</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
               </div>
          </div>
     </div>

     @section('javascript')
     <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
     <script>
          const modalId = document.getElementById('selectItem');
          const myModal = new bootstrap.Modal(modalId);


          // disabled IE help popup
          window.onhelp = function() {
               return false;
          };

          // onkeydown handler
          window.onkeydown = evt => {
               switch(evt.keyCode){
                    case 115:
                         myModal.show();
                         break;
                    default:
                         return true;
               }
               return false;
          }

          modalId.addEventListener('shown.bs.modal',function(e){
               const url = '{{ url('api/inventory') }}'
               // const url = '{{ url('api/inventory') }}'
               // const dataLoad = new Creating(url)
               // const inputan = this.querySelector('#findItem')
               // inputan.addEventListener('keydown',function(e){
               //      let valuesThis = this.value
               //      document.getElementById('resultSearch').innerHTML = ''
               //      if (valuesThis.length >= 3) {
               //           dataLoad.buildingTbl('kabel','nama_barang')
               //      }
               // })
               this.addEventListener('click',function(e){
                    if (e.target.classList.contains('adding')) {
                         (async () => {
                              const dataId = e.target.getAttribute('data-id')
                              const dataBarcode = e.target.getAttribute('data-barcode')
                              const dataNama = e.target.getAttribute('data-nama')
                              const dataMax = parseInt(e.target.getAttribute('data-max'))
                              const { value: tambahJumlah } = await Swal.fire({
                                   title: 'Enter your IP address',
                                   input: 'number',
                                   inputLabel: `Jumlah Maksimal = ${dataMax}`,
                                   // inputValue: inputValue,
                                   showCancelButton: true,
                                   inputValidator: (value) => {
                                        if (value>dataMax) {
                                             return 'Jumlah Terlalu Banyak'
                                        }else if (!value) {
                                             return 'Masukkan Jumlah Keluar'
                                        }else if (value < 1) {
                                             return 'Kok aneh aneh'
                                        }
                                   }
                              })
                              if (tambahJumlah) {
                                   gotoTables({
                                        id:dataId,
                                        nama:dataNama,
                                        barcode:dataBarcode,
                                        qty:tambahJumlah
                                   })
                                   Swal.fire(`Berhasil Ditambah`)
                              }
                         })()
                    }else{
                         e.stopPropagation();
                    }
               })
               const inputan = this.querySelector('#findItem')
               inputan.focus()
               inputan.addEventListener('keydown',async function(e){
                    if (e.which == 13) {
                         let valuesThis = this.value
                         document.getElementById('resultSearch').innerHTML = ''
                         if (valuesThis.length >= 3) {
                              const loadData = await fetchingData(url,{
                                   nama_barang:valuesThis
                              })
                              const tables = createTables(loadData)
                         }
                    }
               })
          })


          function fetchingData(url,params) {
               return fetch(url+'?'+new URLSearchParams(params), {
                    headers: {
                         'Accept': 'application/json'
                    },
                    method: 'GET',
               })
                    .then(response => response.json())
                    .then(data => data)
          }

          function createTables(haystack){
               haystack.forEach(element => {
                    let tr = document.createElement("tr");
                    let actionBtn = document.createElement("button")
                    var textnode = document.createTextNode("Select");
                    actionBtn.appendChild(textnode)
                    actionBtn.classList.add("btn")
                    actionBtn.classList.add("btn-danger")
                    actionBtn.classList.add("btn-sm")
                    actionBtn.classList.add("adding")
                    actionBtn.setAttribute('data-id',element.id)
                    actionBtn.setAttribute('data-barcode',element.vinventory.barcode)
                    actionBtn.setAttribute('data-nama',element.nama_barang)
                    actionBtn.setAttribute('data-max',element.vinventory.saldo_temp-element.vinventory.min_stock)
                    if (element.vinventory.saldo_temp <= element.vinventory.min_stock) {
                         actionBtn.setAttribute('disabled','disabled')
                    }
                    tr.insertCell(0).innerHTML = element.nama_barang
                    tr.insertCell(1).innerHTML = element.vinventory.min_stock
                    tr.insertCell(2).innerHTML = element.vinventory.saldo_temp
                    tr.insertCell(3).appendChild(actionBtn)
                    document.getElementById("resultSearch").insertAdjacentElement('beforeend',tr);
               });
          }

          function gotoTables(haystack){
                    let tr = document.createElement("tr");
                    let inputId = document.createElement("input")
                    var inputBarcode = document.createElement("input");
                    var inputNama = document.createElement("input");
                    var inputQty = document.createElement("input");
                    inputId.setAttribute("name","id[]")
                    inputId.setAttribute("type","hidden")
                    inputId.value = haystack.id 

                    inputQty.setAttribute("name","qty_out[]")
                    inputQty.setAttribute("type","number")
                    inputQty.setAttribute("readonly","true")
                    inputQty.value = haystack.qty 

                    inputBarcode.setAttribute("disabled","disabled")
                    inputBarcode.value = haystack.barcode   

                    inputNama.setAttribute("disabled","disabled")
                    inputNama.value = haystack.nama

                    tr.insertCell(0).appendChild(inputId)
                    tr.insertCell(1).appendChild(inputBarcode)
                    tr.insertCell(2).appendChild(inputNama)
                    tr.insertCell(3).appendChild(inputQty)
                    document.getElementById("daftarKeluar").insertAdjacentElement('beforeend',tr);
          }


     </script>
     @endsection

</x-nosidebar>