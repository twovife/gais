<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
  @section('css')
  <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">
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

    tr td:nth-child(3) {
      text-align: left;
    }

    tr td:nth-child(11) {
      text-align: right;
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
          <h5 class="mb-3">Barang Masuk</h5>
          <div class="d-flex align-items-center">
            <div class="row w-50">
              <div class="col">
                <div class="row row-cols-lg-auto g-3 align-items-center">
                  <div class="col-5">
                    <label class="visually-hidden" for="fromdate">Username</label>
                    <div class="input-group">
                      <div class="input-group-text">From</div>
                      <input type="date" class="form-control" id="fromdate" name="fromdate" placeholder="Username"
                        value="{{ $tanggal = date('Y-m-d', strtotime('Last Sunday')) }}">
                    </div>
                  </div>

                  <div class="col-5">
                    <label class="visually-hidden" for="enddate">Username</label>
                    <div class="input-group">
                      <div class="input-group-text">To</div>
                      <input type="date" class="form-control" id="enddate" name="enddate" placeholder="Username"
                        value="{{ $tanggal = date('Y-m-d') }}">
                    </div>
                  </div>

                  <div class="col">
                    <button type="btn" class="btn btn-primary" onclick="setDate()">Search</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="extra-btn ms-auto">
              <a href="{{ route('income.create') }}" role="button" class="btn btn-secondary btn-sm">Create
              </a>
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

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Per item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="forms" method="post">
          @method('put')
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="bkk" class="form-label">Nomor BKK</label>
              <input type="text" class="form-control" name="bkk" id="bkk" aria-describedby="emailHelp"
                placeholder="ex : 0000001 ( tanpa awalan BKK: )">
            </div>
            <div class="mb-3">
              <label for="tanggal_bkk" class="form-label">Tanggal BKK</label>
              <input type="date" class="form-control" name="tanggal_bkk" id="tanggal_bkk" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="qty_in" class="form-label">QTY</label>
              <input type="number" class="form-control" name="qty_in" id="qty_in" aria-describedby="emailHelp">
              <small>hanya bisa di edit jika transaksi terakhir</small>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" class="form-control" name="harga" id="harga" aria-describedby="emailHelp"
                placeholder="Harga Satuan">
            </div>

            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5"></textarea>
            </div>

            @if (Auth::user()->role !==100)
            <button type="submit" class="btn btn-primary">Submit</button>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>


  @section('javascript')
  <script src="{{ asset('jsgrid/gridjs.umd.js') }}"></script>
  <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script>
    const url = '{{ url('api/gaisstock') }}'
            const urli = generategetUrl(url,{
                fromdate: document.getElementById('fromdate').value,
                enddate: document.getElementById('enddate').value
            })

            const loadInventorTables = (parameter) => {
                new gridjs.Grid({
                      columns: [{
                          name: 'Edit',
                          formatter:(cell)=>{
                                return gridjs.html(`
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="${cell.id}" data-inventory="${cell.inventory_id}" data-bkk="${cell.bkk}" data-bkkdate="${cell.tanggal_bkk}" data-qty="${cell.qty_in}" data-harga="${cell.harga}" data-keterangan="${cell.keterangan}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </button>
                                `)
                          }
                      },{
                          name: "Tanggal",
                      },{
                          name: "BTB"
                      },{
                          name: "Nama Toko"
                      },{
                          name: "Nama Barang"
                      },{
                          name: "Jenis"
                      },{
                          name: "BKK"
                      },{
                          name: "Tgl BKK",
                          formatter:(cell)=>{
                                return convertDate(cell)
                          }
                      },{
                          name: "Qty"
                      },{
                          name: "Satuan"
                      },{
                          name: "Harga",
                          formatter:(cell)=>{
                                return formatRupiah(cell)
                          }
                      },{
                          name: "Total",
                          formatter:(cell)=>{
                                return formatRupiah(cell)
                          }
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
                      url: parameter,
                      then: data => data.map(card => [
                          card,
                          convertDate(card.income.created_at),
                          card.income.btb,
                          card.income.store?card.income.store.nama_toko:'',
                          card.inventory.nama_barang,
                          card.inventory.component_category.kategori,
                          card.bkk,
                          card.tanggal_bkk,
                          card.qty_in,
                          card.inventory.component_unit.satuan,
                          card.harga,
                          card.harga * card.qty_in,
                          card.keterangan,
                          card.income.user_input
                      ])
                }
                }).render(document.getElementById("wrapper"));
            }

            const data = loadInventorTables(urli)

            const setDate = () => {
                const urls = generategetUrl(url,{
                fromdate: document.getElementById('fromdate').value,
                enddate: document.getElementById('enddate').value
                })

                document.getElementById("wrapper").remove()
                const elements = document.createElement('div')
                elements.setAttribute('id','wrapper')

                document.querySelector('.card-warpper').appendChild(elements)
                const data = loadInventorTables(urls)
            }


            let exampleModal = document.querySelector('#exampleModal')

            exampleModal.addEventListener('show.bs.modal',async function(event){
                const button = event.relatedTarget
                const bkk = button.getAttribute('data-bkk')
                const tanggalbkk = button.getAttribute('data-bkkdate')
                const qty = button.getAttribute('data-qty')
                const harga = button.getAttribute('data-harga')
                const id = button.getAttribute('data-id')
                const invent = button.getAttribute('data-inventory')
                const keterangan = button.getAttribute('data-keterangan')
                const data = {
                      'id': id,
                      'inventory_id': invent
                }

                const inputBkk = exampleModal.querySelector('#bkk')
                const inputTanggal = exampleModal.querySelector('#tanggal_bkk')
                const inputQty = exampleModal.querySelector('#qty_in')
                const inputHarga = exampleModal.querySelector('#harga')
                const foms = exampleModal.querySelector('#forms')
                const url = `{{ route('income.update',1) }}`
                const postUrl = url.slice(0,-1) + id
                const inputketerangan = exampleModal.querySelector('#keterangan')

                const lastValidation = await fetchPost('{{ url('api/islastmutation') }}',data)

                inputBkk.value = bkk=='null'?null:bkk
                inputTanggal.value = tanggalbkk=='null'?null:tanggalbkk
                inputQty.value = qty
                inputHarga.value = harga
                forms.setAttribute('action',`${postUrl}`)
                inputketerangan.value = keterangan==='null'?null:keterangan

                if (lastValidation !== 1) {
                      inputQty.setAttribute('disabled','disabled')
                }else{
                      inputQty.removeAttribute('disabled')
                }
            })
  </script>
  @endsection
</x-nosidebar>