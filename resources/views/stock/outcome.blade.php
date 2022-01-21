<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
  @section('css')
  <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">
  <style>
    .table-responsive {
      height: 50vh;
    }

    tr th {
      text-align: center;
    }

    tr td {
      text-align: center;
    }

    tr td:nth-child(4) {
      text-align: left;
    }

    tr td:last-child {
      text-align: left;
    }


    /* tr td:nth-child(11) {
      text-align: right;
    } */
  </style>
  @endsection

  @if (session()->has('success'))
  <div class="alert alert-success" role="alert">
    Berhasil Menambahkan Data
  </div>
  <script>
    window.open('outcome/print/{{ session()->get('success') }}','_blank');
    // newTab.location
  </script>
  @elseif (session()->has('eror'))

  <div class="alert alert-danger" role="alert">
    {{ session()->get('eror') }}
  </div>
  @elseif (session()->has('berhasil'))

  <div class="alert alert-success" role="alert">
    {{ session()->get('berhasil') }}
  </div>
  @endif



  {{-- <a href="http://google.com" target="__blank">test</a> --}}
  <div class="container-fluid">
    <div class="card mb-3">
      <div class="card-body">
        <div class="card-title">
          <h5 class="mb-3">Data Barang Keluar ( Outcome )</h5>
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
              <a href="{{ route('outcome.create') }}" role="button" class="btn btn-secondary btn-sm">Create
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
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="forms" method="POST">
            @csrf
            @method('put')

            <div class="row g-3">
              <div class="col">
                <label for="BKB" class="form-label">Nomor BKB</label>
                <input readonly type="text" class="form-control" id="bkb">
              </div>
            </div>

            <div class="row g-3">
              <div class="col">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input readonly type="text" class="form-control" id="nama_barang">
              </div>
            </div>

            <div class="row g-3">
              <div class="col">
                <label for="qty" class="form-label">Jumlah</label>
                <input readonly type="number" class="form-control" id="qty">
              </div>
              <div class="col">
                <label for="satuan" class="form-label">Satuan</label>
                <input readonly type="text" class="form-control" id="satuan">
              </div>
            </div>

            <div class="row g-3">
              <div class="col">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5"></textarea>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button onclick="submitForm()" type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>


  @section('javascript')
  <script src="{{ asset('jsgrid/gridjs.umd.js') }}"></script>
  <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script>
    const url = generategetUrl('{{ url('api/barangkeluar') }}', {
        fromdate: document.getElementById('fromdate').value,
        enddate: document.getElementById('enddate').value
    })
    const urlInventory = '{{ url('api/inventory') }}'
    const urlIsDuplicate = '{{ url('api/isitembtbduplicate') }}'

    const loadInventorTables = (url) => {
        new gridjs.Grid({
              columns: [{
                  name: "Edit",
                  formatter:(cell)=>{
                    console.log(cell);
                              return gridjs.html(`
                              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="${cell.id}" data-bkb="${cell.outcome.bkb}" data-nama="${cell.inventory.nama_barang}" data-satuan="${cell.inventory.component_unit.satuan}" data-qty="${cell.qty_out}" data-keterangan="${cell.keterangan}">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                  </svg>
                              </button>
                              `)
                        }
              }, {
                  name: "Tanggal"
              }, {
                  name: "BKB"
              }, {
                  name: "Nama Barang"
              }, {
                  name: "Jenis Barang"
              }, {
                  name: "Qty"
              }, {
                  name: "Satuan"
              }, {
                  name: "Unit"
              }, {
                  name: "Divisi"
              }, {
                  name: "Request"
              }, {
                  name: "User"
              },{
                  name: "Keterangan"
              },],
              search: true,
              className: {
                  table: "table table-sm"
              },
              pagination: {
                  limit: 10
              },
              server: {
                  url: url,
                  then: data => data.map(card => [
                        card,
                        convertDate(card.outcome.created_at),
                        card.outcome.bkb,
                        card.inventory.nama_barang,
                        card.inventory.component_category.kategori,
                        card.qty_out,
                        card.inventory.component_unit.satuan,
                        card.outcome.hc_rank_ga_structure.hc_unit.unit,
                        card.outcome.hc_rank_ga_structure.hc_sub_unit.sub_unit,
                        card.outcome.nama_request,
                        card.outcome.user_input,
                        card.keterangan])
              }
        }).render(document.getElementById("wrapper"));
    }

    const data = loadInventorTables(url)

    const setDate = () => {
        const urls = generategetUrl('{{ url('api/barangkeluar') }}', {
              fromdate: document.getElementById('fromdate').value,
              enddate: document.getElementById('enddate').value
        })

        document.getElementById("wrapper").remove()
        const elements = document.createElement('div')
        elements.setAttribute('id', 'wrapper')

        document.querySelector('.card-warpper').appendChild(elements)
        const data = loadInventorTables(urls)
    }


    const exampleModal = document.getElementById('exampleModal')

    exampleModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget
      const bkb = button.getAttribute('data-bkb')
      const nama_barang = button.getAttribute('data-nama')
      const qty = button.getAttribute('data-qty')
      const satuan = button.getAttribute('data-satuan')
      const keterangan = button.getAttribute('data-keterangan')
      const id = button.getAttribute('data-id')
      const url = `outcome/${id}`


      const modalTitle = exampleModal.querySelector('.modal-title')
      const inputbkb = exampleModal.querySelector('#bkb')
      const inputnama_barang = exampleModal.querySelector('#nama_barang')
      const inputqty = exampleModal.querySelector('#qty')
      const inputsatuan = exampleModal.querySelector('#satuan')
      const inputketerangan = exampleModal.querySelector('#keterangan')
      


      inputbkb.value = bkb
      inputnama_barang.value = nama_barang
      inputqty.value = qty
      inputsatuan.value = satuan
      inputketerangan.value = keterangan==='null'?null:keterangan



      const form = exampleModal.querySelector("#forms")
      
      modalTitle.textContent = `Edit Transaksi`
      form.setAttribute('action',`${url}`)

    })

    function submitForm(){
      const form = document.getElementById("forms")
      form.submit()
    }
  </script>
  @endsection
</x-nosidebar>