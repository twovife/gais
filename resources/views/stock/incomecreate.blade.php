<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <style>
          tr>th {
               text-align: center;
          }

          tr>td:not(:first-child) {
               text-align: center;
          }

          td>input.noborder {
               border: none;
               text-align: center;
          }

          .swal2-container {
               z-index: 100000,  !important;
          }

          .required::after {
               content: '*';
               color: red;
          }
     </style>
     @endsection
     @if ($errors->all())
     <div class="alert alert-danger">
          @if ($errors->has('qty_in'))
          ada item dengan jumlah masuk kosong -
          @endif
          Data yang anda masukkan tidak valid
     </div>
     @endif
     <div class="container-fluid">
          <div class="card mb-3 bg-transparent">
               <div class="card-body">
                    <div class="card-title mb-3">
                         <div class="d-flex align-items-center">
                              <div class="row w-50">
                                   <h5 class="mb-3">Tambahkan Barang Masuk</h5>
                              </div>
                              <div class="extra-btn ms-auto">
                                   <a href="{{ route('outcome.index') }}" role="button"
                                        class="btn btn-secondary btn-sm">Back
                                   </a>
                              </div>
                         </div>
                    </div>
                    <form action="{{ route('income.store') }}" method="post">
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
                                                  <label for="btb" class="form-label required">Nomor BTB</label>
                                                  <input type="text" class="form-control" name="btb" id="btb"
                                                       placeholder="Nomor BTB">
                                                  @error('btb')
                                                  <small class="text-danger">{{ $message }}</small>
                                                  @enderror
                                             </div>
                                             <div class="mb-3">
                                                  <label for="tanggal_btb" class="form-label">Tanggal BTB</label>
                                                  <input type="date" class="form-control" name="tanggal_btb"
                                                       id="tanggal_btb" placeholder="Tanggal BTB">
                                             </div>
                                             <div class="mb-3">
                                                  <label for="store_id" class="form-label">Store</label>
                                                  <input type="text" class="form-control" name="store_id" id="store_id">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="card shadow">
                                        <div class="card-body">
                                             <div class="input-group mb-3">
                                                  <input disabled type="text" class="form-control" id="inputItem"
                                                       placeholder="Input Barcode">
                                                  <button class="btn btn-outline-secondary" type="button"
                                                       id="addons">Data Barang
                                                       (F4)
                                                  </button>
                                             </div>
                                             <div class="table-responsive">
                                                  <table class="table">
                                                       <thead>
                                                            <tr>
                                                                 <th scope="col">#</th>
                                                                 <th scope="col">Barcode</th>
                                                                 <th scope="col" class="required">Nama Barang</th>
                                                                 <th scope="col" class="required">Qty In</th>
                                                                 <th scope="col">BKK</th>
                                                                 <th scope="col">BKK Date</th>
                                                                 <th scope="col">Harga</th>
                                                                 <th scope="col">Keterangan</th>
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

     @section('javascript')
     <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
     <script>
          const modalId = document.getElementById('selectItem');
          const inputan = modalId.querySelector('#findItem');
          var myModal = new bootstrap.Modal(modalId);
          const url = '{{ url('api/inventory') }}';
          const btnModal = document.getElementById('addons');

          btnModal.addEventListener('click',function(e){
                    if (document.getElementById('btb').value!=='') {
                         myModal.toggle();
                    }else{
                         Swal.fire({
                              icon: 'error',
                              title: 'Oops...!',
                              text: 'BTB Tidak Boleh Dikosongkan'
                         })
                    }
          })


          // disabled IE help popup
          window.onhelp = function() {
               return false;
          };

          // onkeydown handler
          window.onkeydown = evt => {
               switch(evt.keyCode){
                    case 115:
                    if (document.getElementById('btb').value!=='') {
                         myModal.toggle();
                    }else{
                         Swal.fire({
                              icon: 'error',
                              title: 'Oops...!',
                              text: 'BTB Tidak Boleh Dikosongkan'
                         })
                    }
                    break;
                    default:
                         return true;
               }
               return false;
          }

          modalId.addEventListener('click',function(e){
               if (e.target.classList.contains('adding')) {
                    const dataId = e.target.getAttribute('data-id')
                    const dataBarcode = e.target.getAttribute('data-barcode')
                    const dataNama = e.target.getAttribute('data-nama')
                    const createTables = gotoTables({
                         id:dataId,
                         nama:dataNama,
                         barcode:dataBarcode
                    })
               }else{
                    e.stopPropagation();
               }
          })

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
               }else{
                    e.stopPropagation();
               }
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
                    const tr = document.createElement("tr");
                    const actionBtn = document.createElement("button")
                    const textnode = document.createTextNode("Select");
                    actionBtn.appendChild(textnode)
                    actionBtn.classList.add("btn")
                    actionBtn.classList.add("btn-danger")
                    actionBtn.classList.add("btn-sm")
                    actionBtn.classList.add("adding")
                    actionBtn.setAttribute('data-id',element.id)
                    actionBtn.setAttribute('data-barcode',element.vinventory.barcode)
                    actionBtn.setAttribute('data-nama',element.nama_barang)
                    actionBtn.setAttribute('data-max',element.vinventory.saldo_temp-element.vinventory.min_stock)
                    if (element.deleted_at !== null) {
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
                    var inputBkk = document.createElement("input");
                    var inputBkkDate = document.createElement("input");
                    var inputHarga = document.createElement("input");
                    var inputKeterangan = document.createElement("input");

                    inputId.setAttribute("name","inventory_id[]")
                    inputId.setAttribute("type","hidden")
                    inputId.classList.add("form-control")
                    inputId.value = haystack.id 

                    inputQty.setAttribute("name","qty_in[]")
                    inputQty.classList.add("form-control")
                    inputQty.setAttribute("type","number")

                    inputBarcode.setAttribute("disabled","disabled")
                    inputBarcode.classList.add("form-control")
                    inputBarcode.value = haystack.barcode   

                    inputNama.setAttribute("disabled","disabled")
                    inputNama.classList.add("form-control")
                    inputNama.value = haystack.nama

                    inputBkk.setAttribute("type","text")
                    inputBkk.classList.add("form-control")
                    inputBkk.setAttribute("name","bkk[]")  
                    
                    inputBkkDate.setAttribute("type","date")
                    inputBkkDate.classList.add("form-control")
                    inputBkkDate.setAttribute("name","tanggal_bkk[]")  
                    
                    inputHarga.setAttribute("type","number")
                    inputHarga.classList.add("form-control")
                    inputHarga.setAttribute("name","harga[]")  
                    
                    inputKeterangan.setAttribute("type","text")
                    inputKeterangan.classList.add("form-control")
                    inputKeterangan.setAttribute("name","keterangan[]")

                    tr.insertCell(0).appendChild(inputId)
                    tr.insertCell(1).appendChild(inputBarcode)
                    tr.insertCell(2).appendChild(inputNama)
                    tr.insertCell(3).appendChild(inputQty)
                    tr.insertCell(4).appendChild(inputBkk)
                    tr.insertCell(5).appendChild(inputBkkDate)
                    tr.insertCell(6).appendChild(inputHarga)
                    tr.insertCell(7).appendChild(inputKeterangan)
                    document.getElementById("daftarKeluar").insertAdjacentElement('beforeend',tr);
          }
     </script>
     @endsection

</x-nosidebar>