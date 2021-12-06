<x-nosidebar :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <link rel="stylesheet" href="{{ asset('jsgrid/theme/mermaid.min.css') }}">
     <style>
          .gridjs-tr *:nth-child(10),
          .gridjs-tr *:nth-child(9),
          .gridjs-tr *:nth-child(8) {
               background: rgba(255, 211, 211, 0.53);
               color: black;
               font-weight: 800;
          }

          tr th {
               text-align: center;
          }

          tr td:not(:nth-child(2)) {
               text-align: center;
          }

          tr td:nth-child(11) {
               text-align: right;
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
                              </div>
                              <div class="extra-btn ms-auto">
                                   <button class="btn btn-outline-info btn-sm">Export</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="card mb-3">
               <div class="card-body">
                    <div id="wrapper"></div>
               </div>
          </div>
     </div>

     @section('javascript')
     <script src="{{ asset('jsgrid/gridjs.umd.js') }}"></script>
     <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

     <script>
          const url = '{{ url('api/mutasi') }}?inventory_id={{ $trow_id }}'
          const loadJsGrid = loadInventorTables(url)
          function loadInventorTables(url) {
               new gridjs.Grid({
                    columns: [{
                         name: "Tanggal",
                    },{
                         name: "BTB"
                    },{
                         name: "BKB"
                    },{
                         name: "Kategory"
                    },{
                         name: "Satuan"
                    },{
                         name: "Barcode"
                    },{
                         name: "Nama Barang"
                    },{
                         name: "Masuk"
                    },{
                         name: "Keluar"
                    },{
                         name: "Saldo",
                    },{
                         name: "Harga"
                    },{
                         name: "Pic Req"
                    },{
                         name: "Divisi"
                    },{
                         name: "Unit"
                    }],
                    search: true,
                    className: {
                         table: "table table-sm table-striped"
                    },
                    pagination: {
                    limit: 10
               },
                    server: {
                    url: url,
                    then: data => data.map(card => [
                         convertDate(card.created_at),
                         isFalse(card.vincome,'btb'),
                         isFalse(card.voutcome,'bkb'),
                         card.inventory.component_category.kategori,
                         card.inventory.component_unit.satuan,
                         card.inventory.nama_barang,
                         card.inventory.vinventory.barcode,
                         isFalse(card.vincome,'qty_in'),
                         isFalse(card.voutcome,'qty_out'),
                         showSaldo(card.voutcome??card.vincome),
                         isFalse(card.vincome,'harga'),
                         isFalse(card.voutcome,'nama_request'),
                         isFalse(card.voutcome,'divisi'),
                         isFalse(card.voutcome,'unit')
                         ])
               }
               }).render(document.getElementById("wrapper"));
          }

          function _0x3840(){const _0x46caff=['15JJfDXu','getMonth','849394swQMSY','934113tdXcmw','50ueyqDr','1349631XXNfAO','398418lKTwSS','77QewXny','getFullYear','getDate','411780bXjdOt','3174105zACCQA','1175728MUDUjt'];_0x3840=function(){return _0x46caff;};return _0x3840();}(function(_0x30902b,_0x5550e7){const _0x5bf636=_0x263b,_0x2366c5=_0x30902b();while(!![]){try{const _0x1b7fce=-parseInt(_0x5bf636(0x1b1))/0x1+-parseInt(_0x5bf636(0x1b0))/0x2+parseInt(_0x5bf636(0x1ae))/0x3*(parseInt(_0x5bf636(0x1ab))/0x4)+-parseInt(_0x5bf636(0x1ac))/0x5+-parseInt(_0x5bf636(0x1a7))/0x6+parseInt(_0x5bf636(0x1a8))/0x7*(parseInt(_0x5bf636(0x1ad))/0x8)+parseInt(_0x5bf636(0x1a6))/0x9*(parseInt(_0x5bf636(0x1a5))/0xa);if(_0x1b7fce===_0x5550e7)break;else _0x2366c5['push'](_0x2366c5['shift']());}catch(_0x2b6c9c){_0x2366c5['push'](_0x2366c5['shift']());}}}(_0x3840,0xc8778));function _0x263b(_0x2207a2,_0xf1e662){const _0x384050=_0x3840();return _0x263b=function(_0x263b74,_0x1a6aaf){_0x263b74=_0x263b74-0x1a5;let _0x2dbdb8=_0x384050[_0x263b74];return _0x2dbdb8;},_0x263b(_0x2207a2,_0xf1e662);}function convertDate(_0x4c4ebb){const _0x26f177=_0x263b,_0x326f04=new Array();_0x326f04[0x0]='01',_0x326f04[0x1]='02',_0x326f04[0x2]='03',_0x326f04[0x3]='04',_0x326f04[0x4]='05',_0x326f04[0x5]='06',_0x326f04[0x6]='07',_0x326f04[0x7]='08',_0x326f04[0x8]='09',_0x326f04[0x9]='10',_0x326f04[0xa]='11',_0x326f04[0xb]='12';let _0x2dfac7=new Date(_0x4c4ebb),_0x4fcbf9=_0x2dfac7[_0x26f177(0x1aa)](),_0x313ad7=_0x326f04[_0x2dfac7[_0x26f177(0x1af)]()],_0x3c000b=_0x2dfac7[_0x26f177(0x1a9)](),_0x1602d0=_0x4fcbf9+'/'+_0x313ad7+'/'+_0x3c000b;return _0x1602d0;}

          function isFalse(data, object){
               const _object = object
               if (data === null) {
                    return null
               }else{
                    return data[_object];
               }
          }

          function showSaldo(data){
               return data.saldo
          }


     </script>
     @endsection


</x-nosidebar>