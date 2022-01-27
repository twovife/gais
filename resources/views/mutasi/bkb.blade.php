<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
  @section('css')
  <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">

  <style>
    table tr td,
    th {
      text-align: center;
    }

    table tr td,
    th:nth-child(1) {
      max-width: 100px;
    }
  </style>
  @endsection


  <div class="container-fluid">
    <div class="card mb-3">
      <div class="card-body">
        <div class="card-title">
          <h5 class="mb-3">Data Bukti Keluar Barang ( BKB )</h5>
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
                <form action="{{ route('download.bkb') }}" method="POST" class="ms-2">
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
    const urls = generategetUrl('{{ url('api/bkb') }}', {
                  fromdate: document.getElementById('fromdate').value,
                  enddate: document.getElementById('enddate').value
              })
          // const urls = '{{ url('api/btb') }}'

    const loadtables = (url) =>{
          new gridjs.Grid({
              columns: [{
                    name: "Action",
                    formatter: (cell) => {
                        const id = cell
                        return gridjs.html(`<a role="button" href="bkb/${cell}" class="btn btn-sm btn-primary">Show</a>`)
                    }
              },{
                    name: "Tanggal"
              },{
                    name: "BKB"
              },{
                    name: "Unit"
              },{
                    name: "Divisi"
              },{
                    name: "PIC"
              },{
                    name: "User Input"
              },],
              search: true,
              className: {
                    table: "table table-sm table-striped"
              },
              pagination: {
                    limit: 20
              },
              server:{
                    url: url,
                    then: data => data.map(card=>[
                        card.id,
                        card.tanggal,
                        card.bkb,
                        card.unit,
                        card.divisi,
                        card.nama,
                        card.user_input
                    ])
              }
          }).render(document.getElementById("wrapper"));
    }

    const setDate = () => {
          const url = generategetUrl('{{ url('api/bkb') }}', {
              fromdate: document.getElementById('fromdate').value,
              enddate: document.getElementById('enddate').value
          })
    
          document.getElementById("wrapper").remove()
          const elements = document.createElement('div')
          elements.setAttribute('id', 'wrapper')
    
          document.querySelector('.card-warpper').appendChild(elements)
          const data = loadtables(url)
    }

    const onloadtables = loadtables(urls)

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