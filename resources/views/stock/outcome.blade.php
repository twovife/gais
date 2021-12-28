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

    tr td:nth-child(3) {
      text-align: left;
    }

    tr td:nth-child(11) {
      text-align: right;
    }
  </style>
  @endsection

  @if (session()->has('success'))
  <div class="alert alert-success" role="alert">
    Berhasil Menambahkan Data
  </div>
  <script>
    var newTab = window.open('outcome/print/{{ session()->get('success') }}');
          newTab.location
  </script>
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
                  name: "Tanggal"
              }, {
                  name: "BKB"
              }, {
                  name: "Nama Barang"
              }, {
                  name: "Kode Barang"
              }, {
                  name: "Jenis Barang"
              }, {
                  name: "Satuan"
              }, {
                  name: "Qty"
              }, {
                  name: "Unit"
              }, {
                  name: "Divisi"
              }, {
                  name: "Request"
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
                        convertDate(card.outcome.created_at),
                        card.outcome.bkb,
                        card.inventory.nama_barang,
                        card.inventory.barcode,
                        card.inventory.component_category.kategori,
                        card.inventory.component_unit.satuan,
                        card.qty_out,
                        card.outcome.hc_rank_ga_structure.hc_unit.unit,
                        card.outcome.hc_rank_ga_structure.hc_sub_unit.sub_unit,
                        card.outcome.nama_request,
                        card.outcome.user_input])
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
  </script>
  @endsection
</x-nosidebar>