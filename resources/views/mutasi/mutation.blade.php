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

    tr td:nth-child(1),
    tr td:nth-child(6) {
      text-align: left;
    }

    tr td:nth-child(9) {
      text-align: right;
    }
  </style>
  @endsection


  <div class="container-fluid">
    <div class="card mb-3">
      <div class="card-body">
        <div class="card-title">
          <h5 class="mb-3">Mutasi Barang</h5>

          <div class="d-flex flex-column flex-lg-row align-items-center">
            <div>
              <div class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-12 col-lg-5">
                  <label class="visually-hidden" for="fromdate">Date From</label>
                  <div class="input-group">
                    <div class="input-group-text">From</div>
                    <input type="date" class="form-control" id="fromdate" name="fromdate" placeholder="date"
                      value="{{ $tanggal = date('Y-m-d') }}">
                  </div>
                </div>
                <div class="col-12 col-lg-5">
                  <label class="visually-hidden" for="enddate">Date Thru</label>
                  <div class="input-group">
                    <div class="input-group-text">To</div>
                    <input type="date" class="form-control" id="enddate" name="enddate" placeholder="date"
                      value="{{ $tanggal = date('Y-m-d') }}">
                  </div>
                </div>
                <div class="col">
                  <button type="btn" class="btn btn-primary" onclick="setDate()">Search</button>
                </div>
              </div>
            </div>
            <div class="ms-auto">
              <div class="d-flex justify-content-end align-items-center">
                <a href="{{ route('income.create') }}" role="button" class="btn btn-secondary btn-sm">Create</a>
                <form action="{{ route('download.mutasi') }}" method="POST" class="ms-2">
                  @csrf
                  <input type="hidden" id="dfrom" name="dfrom">
                  <input type="hidden" id="dtrue" name="dtrue">
                  <button onclick="formExportSubmiter(event)" class="btn btn-outline-info btn-sm">Export</button>
                </form>
              </div>
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

  @section('javascript')
  <script src="{{ asset('jsgrid/gridjs.umd.js') }}"></script>
  <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

  <script>
    const url = generategetUrl('{{ url('api/mutasi') }}', {
        fromdate: document.getElementById('fromdate').value,
        enddate: document.getElementById('enddate').value
    })

    const showSaldo = (income, outcome, inreturn, outreturn) => {
          if (income !== null) {
            return income.saldo
          } else if (outcome) {
            return outcome.saldo
          } else if (inreturn) {
            return inreturn.saldo
          } else if (outreturn) {
            return outreturn.saldo
          }
    }
    
    const showKeterangan = (income, outcome, inreturn, outreturn) => {
          if (income !== null) {
            return income.keterangan
          } else if (outcome) {
            return outcome.keterangan
          } else if (inreturn) {
            return inreturn.keterangan
          } else if (outreturn) {
            return outreturn.keterangan
          }
    }

    const loadInventorTables = (url) => {
        new gridjs.Grid({
              columns: [{
                  name: "Tanggal"
              }, {
                  name: "tag",
                  formatter: (cell) => {
                        if (cell == 'income') {
                            return gridjs.html(`<button type="button" class="btn btn-success btn-sm disabled" style="user-select: auto;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                            </svg></button>`)
                        } else if (cell == 'outcome') {
                            return gridjs.html(`<button type="button" class="btn btn-danger btn-sm disabled" style="user-select: auto;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                            </svg></button>`)
                        } else if (cell == 'returnincome') {
                            return gridjs.html(`<button type="button" class="btn btn-warning btn-sm disabled" style="user-select: auto;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                            </svg></button>`)
                        } else if (cell == 'returnoutcome') {
                            return gridjs.html(`<button type="button" class="btn btn-info btn-sm disabled" style="user-select: auto;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="user-select: auto;">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                            </svg></button>`)
                        }
                  }
              }, {
                  name: "Nomor Transaksi"
              }, {
                  name: "Kategory"
              }, {
                  name: "Satuan"
              },  {
                  name: "Nama Barang"
              }, {
                  name: "Masuk"
              }, {
                  name: "Keluar"
              },{
                  name: "Saldo"
              }, {
                  name: "Harga"
              }, {
                  name: "Pic Req"
              }, {
                  name: "Divisi"
              }, {
                  name: "Unit"
              }, {
                  name: "Keterangan"
              }],
              search: true,
              className: {
                  table: "table table-sm table-striped"
              },
              pagination: {
                  limit: 20
              },
              server: {
                  url: url,
                  then: data => data.map(card => [
                        convertDate(card.created_at),
                        inOrOut(card.vincome, card.voutcome, card.incomereturn, card.outcomereturn),
                        showFlexyData(card.vincome, card.voutcome, card.incomereturn, card.outcomereturn),
                        card.inventory.component_category.kategori,
                        card.inventory.component_unit.satuan,
                        card.inventory.nama_barang,
                        isFalse(card.vincome ?? card.outcomereturn, 'qty_in'),
                        isFalse(card.voutcome ?? card.incomereturn, 'qty_out'),
                        showSaldo(card.voutcome, card.vincome, card.incomereturn, card.outcomereturn),
                        formatRupiah(isFalse(card.vincome ?? (card.incomereturn ? card.incomereturn.income_detail : null), 'harga')),
                        isFalse(card.voutcome, 'nama_request'),
                        isFalse(card.voutcome ? card.voutcome.hc_rank_ga_structure.hc_sub_unit : 'null', 'sub_unit'),
                        isFalse(card.voutcome ? card.voutcome.hc_rank_ga_structure.hc_unit : 'null', 'unit'),
                        showKeterangan(card.voutcome, card.vincome, card.incomereturn, card.outcomereturn),
                  ])
              }
        }).render(document.getElementById("wrapper"));
    }

    const loadJsGrid = loadInventorTables(url)

    
    const setDate = () => {
      const urls = generategetUrl('{{ url('api/mutasi') }}', {
            fromdate: document.getElementById('fromdate').value,
            enddate: document.getElementById('enddate').value
      })

      document.getElementById("wrapper").remove()
      const elements = document.createElement('div')
      elements.setAttribute('id', 'wrapper')

      document.querySelector('.card-warpper').appendChild(elements)
      const data = loadInventorTables(urls)
    }


    const formExportSubmiter = (event) => {
        event.preventDefault();
        const dfrom = document.getElementById('dfrom');
        const dtrue = document.getElementById('dtrue');
        dfrom.value = document.getElementById('fromdate').value;
        dtrue.value = document.getElementById('enddate').value;
        event.target.parentNode.submit();
    }

  </script>
  @endsection


</x-nosidebar>