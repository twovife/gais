<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
  @section('css')
  <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tom-select/dist/css/tom-select.default.css') }}">
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

    td:nth-child(9) {
      text-align: left;
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
              <div class="col">
                <div class="row row-cols-lg-auto g-3 align-items-center">
                  <div class="col-5">
                    <label class="visually-hidden" for="fromdate">Username</label>
                    <div class="input-group">
                      <div class="input-group-text">From</div>
                      <input type="date" class="form-control" id="fromdate" name="fromdate" placeholder="Username"
                        value="{{ $tanggal = date('Y-m-d') }}">
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
              <a href="{{ route('outreturn.create') }}" role="button" class="btn btn-secondary btn-sm">Create
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


  @section('javascript')
  <script src="{{ asset('jsgrid/gridjs.umd.js') }}"></script>
  <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script>
    const url = generategetUrl('{{ url('api/outreturn') }}', {
        fromdate: document.getElementById('fromdate').value,
        enddate: document.getElementById('enddate').value
    })

    const loadInventorTables = (url) => {
        new gridjs.Grid({
              columns: [{
                  name: "Tanggal",
              }, {
                  name: "Nomor Return"
              }, {
                  name: "Nomor BKB"
              }, {
                  name: "Kode Barang"
              }, {
                  name: "Nama Barang"
              }, {
                  name: "Jenis Barang"
              }, {
                  name: "Satuan"
              }, {
                  name: "Qty"
              }, {
                  name: "Keterangan"
              }, {
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
                  then: data => data.map(card => [
                        convertDate(card.created_at),
                        card.nomor_return,
                        card.outcome.bkb,
                        card.inventory.barcode,
                        card.inventory.nama_barang,
                        card.inventory.component_category.kategori,
                        card.inventory.component_unit.satuan,
                        card.qty_in,
                        card.reason,
                        card.user_input,
                  ])
              }
        }).render(document.getElementById("wrapper"));
    }

    const data = loadInventorTables(url)

    const setDate = () => {
        const urls = generategetUrl('{{ url('api/outreturn') }}', {
          fromdate: document.getElementById('fromdate').value,
          enddate: document.getElementById('enddate').value
        })

        document.getElementById("wrapper").remove()
        const elements = document.createElement('div')
        elements.setAttribute('id', 'wrapper')

        document.querySelector('.card-warpper').appendChild(elements)
        const data = loadInventorTables(urls)
    }
  </script>
  @endsection
</x-nosidebar>