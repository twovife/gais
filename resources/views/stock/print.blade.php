<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Dom PDF Print</title>
     <style>
          body {
               font-size: 14px;
               font-family: 'Times New Roman', Times, serif
          }

          .wrapper {
               text-align: right;
               position: sticky;
          }

          .wrapper span {
               font-weight: 800;
          }

          .tag-title {
               text-align: center;
          }

          span {
               letter-spacing: 0.7px;
               line-height: 1rem;
          }

          /* DivTable.com */
          .divTable {
               display: table;
               width: 100%;
          }

          .divTableRow {
               display: table-row;
          }

          .divTableHeading {
               background-color: #EEE;
               display: table-header-group;
          }

          .divTableCell,
          .divTableHead {
               border: 1px solid #999999;
               display: table-cell;
               padding: 3px 10px;
          }

          .divTableHeading {
               background-color: #EEE;
               display: table-header-group;
               font-weight: bold;
          }

          .divTableFoot {
               background-color: #EEE;
               display: table-footer-group;
               font-weight: bold;
          }

          .divTableBody {
               display: table-row-group;
          }

          .divTableRow>div:nth-child(2) {
               text-align: center;
               width: 15%;
          }

          .divTableRow>div:nth-child(3) {
               text-align: center;
               width: 15%;
          }

          .divTableBody>div:nth-child(7n) {
               page-break-after: always;
          }


          .pageHeader {
               position: fixed;
               top: -10px;
          }

          .pageFooter {
               position: fixed;
               bottom: -40px;
          }

          body {
               padding-top: 6.5rem;
               /* counter-reset: my-sec-counter; */
          }



          .paging::before {
               content: counter(page) " of ";
          }

          .paging {
               /* counter-reset: pages; */
               counter-increment: pages;
          }

          .paging::after {
               content: "{{ $countdata }} || {{ $data->bkb }}";
          }
     </style>
</head>

<body style="width: 100%; height: 100%; margin: 0;">
     <div class="pageHeader" style="width: 100%">
          <div class="wrapper">
               <span>Nomor BKB: {{ $data->bkb }}</span>
          </div>
          <div class="tag-title" style="margin-bottom: .5rem;">
               <h2 style="padding: 0;margin: 0;">Bukti Keluar Barang</h2>
               <span>(BKB)</span>
          </div>
          <div style="margin-bottom: 1rem">
               <div style="float: right;">
                    <span>Divisi / Unit :</span>
                    <span> {{ $data->hc_rank_ga_structure->hc_sub_unit->sub_unit }} / {{
                         $data->hc_rank_ga_structure->hc_unit->unit }}</span>
               </div>
               <div>
                    <span>Diberikan Kepada :</span>
                    <span> {{ $data->nama_request }} </span>
               </div>
               <div>
                    <span>Tanggal :</span>
                    <span> {{ $data->created_at }}</span>
               </div>
          </div>
     </div>
     <div class="pageFooter" style="width: 100%">
          <table style="width: 100%">
               <tr style="text-align: center;">
                    <td>Warehouse</td>
                    <td>Penerima</td>
               </tr>
               <tr style="text-align: center;">
                    <td style="padding: .8rem"></td>
                    <td style="padding: .8rem"></td>
               </tr>
               <tr style="text-align: center;">
                    <td>Nama Warehouse</td>
                    <td>Nama Penerima</td>
               </tr>
          </table>
          <div style="font-size: x-small">
               Page
               <small class="paging"></small>
          </div>
     </div>
     <div class="divTable" style="margin-bottom: 1rem">
          <div class="divTableBody">
               <div class="divTableRow">
                    <div class="divTableCell">&nbsp;Nama Barang</div>
                    <div class="divTableCell">&nbsp;Qty</div>
                    <div class="divTableCell">&nbsp;Satuan</div>
               </div>
               @foreach ($data->outcome_detail as $datas)
               <div class="divTableRow">
                    <div class="divTableCell">&nbsp;{{ $datas->inventory->nama_barang }}</div>
                    <div class="divTableCell">&nbsp;{{ $datas->qty_out }}</div>
                    <div class="divTableCell">&nbsp;{{ $datas->inventory->component_unit->satuan }}</div>
               </div>
               @endforeach

          </div>
     </div>
     {{-- <footer>
          <table style="width: 100%">
               <tr style="text-align: center;">
                    <td>Warehouse</td>
                    <td>Penerima</td>
               </tr>
               <tr style="text-align: center;">
                    <td style="padding: .8rem"></td>
                    <td style="padding: .8rem"></td>
               </tr>
               <tr style="text-align: center;">
                    <td>Nama Warehouse</td>
                    <td>Nama Penerima</td>
               </tr>
          </table>
     </footer> --}}
</body>

</html>