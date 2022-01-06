<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <link rel="stylesheet" href="{{ asset('mazer/vendors/choices.js/choices.min.css') }}">
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

          .required::after {
               content: '*';
               color: red;
          }


          .icon {
               width: 3rem;
          }

          .item {
               width: 100%;
          }

          .formInput {
               width: 40%;
          }

          @media (max-width: 1199.98px) {
               .formInput {
                    width: 100%;
               }
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
          <div class="card mb-3 bg-transparent">
               <div class="card-body">
                    <div class="card-title mb-3">
                         <div class="d-flex align-items-center">
                              <div class="row w-50">
                                   <h5 class="mb-3">Return Barang Masuk ( Return BTB )</h5>
                              </div>
                              <div class="extra-btn ms-auto">
                                   <a href="{{ route('inreturn.index') }}" role="button"
                                        class="btn btn-secondary btn-sm">Back
                                   </a>
                              </div>
                         </div>
                    </div>
                    <div class="formInput container">
                         <div class="card">
                              <div class="card-body mt-3">
                                   <form action="{{ route('outreturn.store') }}" method="post">
                                        @csrf
                                        <div class="row mb-5">
                                             <label for="outcome_id" class="col col-form-label">Nomor BKB</label>
                                             <div class="col-sm-10">
                                                  <select class="choices form-select choices__input" id="outcome_id"
                                                       name="outcome_id">
                                                       <option value="">Select BKB</option>
                                                       @foreach ($noBtb as $item)
                                                       <option value="{{ $item->id }}">{{ $item->bkb }}</option>
                                                       @endforeach
                                                  </select>
                                             </div>
                                        </div>
                                        <div class="row mb-5">
                                             <label for="outcome_detail_id" class="col col-form-label">Nama
                                                  Barang</label>
                                             <div class="col-sm-10" id="outcome_detail">
                                             </div>
                                             <input type="hidden" class="form-control" id="inventory_id"
                                                  name="inventory_id">
                                        </div>
                                        <div class="row mb-5">
                                             <label for="qty_in" class="col col-form-label">Jumlah Return</label>
                                             <div class="col-sm-10 mb-3">
                                                  <div class="input-group">
                                                       <input type="number" min="1" class="form-control" id="qty_in"
                                                            name="qty_in">
                                                       <span class="input-group-text" id="basic-addon2"></span>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="row mb-5">
                                             <label for="keterangan" class="col col-form-label">Keterangan</label>
                                             <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="keterangan"
                                                       name="keterangan">
                                             </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Sign in</button>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     @section('javascript')
     <script src="{{ asset('mazer/vendors/choices.js/choices.min.js') }}"></script>
     <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>


     <script>
          const choiseSelect = document.querySelectorAll('.choices')
          const itemBtb = document.querySelector('#outcome_id')
          const url = `{{ url('api/barangkeluar') }}`
          
          const coises = initialChoices(choiseSelect)

          itemBtb.onchange = async (e) => {
               const options = {
                    affectedDom : document.querySelector('#outcome_detail'),
                    id : 'outcome_detail_id',
                    data : await fetchGet(url,{outcome_id:e.target.value})
               }
               returnSelectList(options)
          }
          
          document.onchange = (e) => {
               if (e.target.id == 'outcome_detail_id') {
                    const obj = e.target
                    const inputQty = document.querySelector('#qty_in')
                    const inputInventory = document.querySelector('#inventory_id')
                    const maximal_qty = obj.options[obj.selectedIndex].getAttribute('data-max');
                    const idinv = obj.options[obj.selectedIndex].getAttribute('data-idinv');
                    inputQty.setAttribute('max',maximal_qty)
                    inputQty.nextElementSibling.innerHTML = `Max Out : ${maximal_qty}`
                    inputInventory.value = idinv
               }else{
                    e.stopPropagation()
               }
          }

     </script>
     @endsection

</x-nosidebar>