// javascript master

// load tables inventory
function loadInventorTables(url) {
     new gridjs.Grid({
          columns: [{
               name: "Kode Barang",
               formatter: (cell, row) => {
                    return gridjs.html(`<a href="#" class="link-primary fw-bold" data-bs-toggle="modal" data-bs-target="#creating", data-bs-id=${row._cells[4].data}>${cell}</a>`)
                    return gridjs.h('a', {
                         className: 'pe-auto',
                         "data-bs-toggle": "modal",
                         "data-bs-target": "#creating",
                         "data-bs-id": cell,
                    }, cell);
               }
          }, {
               name: "Kategori"
          }, {
               name: "Nama Barang"
          }, {
               name: "Satuan"
          }, {
               name: "Delete",
               formatter: (cell, row) => {
                    const routes = '{{ route('inventory.delete',': id') }}'
                    return gridjs.html(formDelete(cell, routes))
          }
          }],
          search: true,
          pagination: {
          limit: 10
     },
          server: {
          url: url,
          then: data => data.map(card => [card.barcode, card.component_category.kategori, card.nama_barang, card.component_unit.satuan, card.id])
     }
     }).render(document.getElementById("wrapper"));
}





