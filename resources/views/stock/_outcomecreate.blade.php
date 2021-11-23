<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <style>
          tr>th {
               text-align: center;
          }

          tr>td:not(:first-child) {
               text-align: center;
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
                    <div class="row">
                         <div class="col-3">
                              <div class="card shadow">
                                   <div class="card-body">
                                        <div class="mb-3">
                                             <label for="roundText" class="form-label">Tanggal Input</label>
                                             <input disabled type="text" class="form-control round" value="Hari Ini">
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
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="modal fade" id="selectItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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


     <div class="modal fade" id="selectCount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
          aria-labelledby="selectItemLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm">
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

          modalId.addEventListener('shown.bs.modal',async function(e){
               // const url = '{{ url('api/inventory') }}'
               // const dataLoad = new Creating(url)
               // const inputan = this.querySelector('#findItem')
               // inputan.focus()
               // inputan.addEventListener('keydown',function(e){
               //      let valuesThis = this.value
               //      document.getElementById('resultSearch').innerHTML = ''
               //      if (valuesThis.length >= 3) {
               //           dataLoad.buildingTbl('kabel','nama_barang')
               //      }
               // })
               // this.addEventListener('click',function(e){
               //      if (e.target.classList.contains('adding')) {
               //           console.log(e.target.getAttribute('data-id'));
               //      }else{
               //           e.stopPropagation();
               //      }
               // })

               const url = '{{ url('api/inventory') }}'
               const loadData = 

          })


          function fetchingData(url){
               return fetch(url).then(response=>response.json()).then(data=>data)
          }

          class Stockitem{
               constructor(url){
                    this.entriesPromise = fetch(url)
                    .then(response=>response.json())
               }

               find(params,key){
                    let myQuery = []
                    this.entriesPromise
                    .then(haystack=> {
                         const arrayData = Object.assign([], haystack);
                         const filteredArrayData = arrayData.filter(list => list[key].toLowerCase().includes(`${params}`));
                         const result = Object.assign([], filteredArrayData)
                         result.forEach(elemn=>myQuery.push(elemn))
                         // return myQuery
                    })
                    return myQuery
                    // if (params) {
                    //      return this.entriesPromise.then(haystack=>{
                    //           createTables(haystack,params)
                    // })
                    // }
               }
          }


          class Creating extends Stockitem{
               constructor(url){
                    super(url);
               }

               buildingTbl(params,key){
                    const asu = this.find(params,key)
                    console.log(asu);
               }
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
     </script>
     @endsection

</x-nosidebar>