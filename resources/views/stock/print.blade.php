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

          .divTableBody:nth-of-type(6n) {
               page-break-after: always;
          }
     </style>
</head>

<body style="width: 100%; height: 100%; margin: 0; padding: 0;">
     <div class="wrapper">
          <span>Nomor BKB: </span>
     </div>
     <div class="tag-title" style="margin-bottom: .5rem;">
          <h2 style="padding: 0;margin: 0;">Bukti Keluar Barang</h2>
          <span>(BKB)</span>
     </div>
     <div style="margin-bottom: 1rem">
          <div style="float: right;">
               <span>Divisi / Unit :</span>
               <span> Outbound / Opr</span>
          </div>
          <div>
               <span>Diberikan Kepada :</span>
               <span> Aziz nur ihsan</span>
          </div>
          <div>
               <span>Tanggal :</span>
               <span> 25/07/2021</span>
          </div>
     </div>
     <div class="divTable" style="margin-bottom: 1rem">
          <div class="divTableBody">
               <div class="divTableRow">
                    <div class="divTableCell">&nbsp;Nama Barang</div>
                    <div class="divTableCell">&nbsp;Qty</div>
                    <div class="divTableCell">&nbsp;Satuan</div>
               </div>
               <div class="divTableRow">
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
               </div>
               <div class="divTableRow">
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
               </div>
               <div class="divTableRow">
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
               </div>
               <div class="divTableRow">
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
               </div>
               <div class="divTableRow">
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
               </div>
               <div class="divTableRow">
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
               </div>
               <div class="divTableRow">
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
                    <div class="divTableCell">&nbsp;</div>
               </div>
          </div>
     </div>
     <!-- DivTable.com -->
     <div style="text-align: center;width: 25%;float: right;">
          <div style="margin-bottom: 2rem">
               <span>Penerima</span>
          </div>
          <div>
               <span>Nama Penerima</span>
          </div>
     </div>
     <div style="text-align: center;width: 25%;">
          <div style="margin-bottom: 2rem">
               <span>Warehouse</span>
          </div>
          <div>
               <span>Nama Warehouse</span>
          </div>
     </div>
</body>

</html>