const formatRupiah = (money) => {
     if (money === null) {
          return '-';
     } else {
          return new Intl.NumberFormat('id-ID',
               { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }
          ).format(money);
     }


}

const convertDate = (dates) => {
     const month = new Array();
     month[0] = "01";
     month[1] = "02";
     month[2] = "03";
     month[3] = "04";
     month[4] = "05";
     month[5] = "06";
     month[6] = "07";
     month[7] = "08";
     month[8] = "09";
     month[9] = "10";
     month[10] = "11";
     month[11] = "12";

     let d = new Date(dates)
     let hari = d.getDate()
     let bulan = month[d.getMonth()]
     let tahun = d.getFullYear()
     let margeTanggal = `${hari}/${bulan}/${tahun}`

     return margeTanggal
}

const isFalse = (data, object) => {
     const _object = object
     if (data === null) {
          return null
     } else {
          return data[_object];
     }
}

const inOrOut = (income = null, outcome = null, inret = null, outret = null) => {
     if (income) {
          return 'income'
     } else if (outcome) {
          return 'outcome'
     } else if (inret) {
          return 'returnincome'
     } else if (outret) {
          return 'returnoutcome'
     }
}

const showFlexyData = (income, outcome, inret, outret) => {
     if (income) {
          return income['btb']
     } else if (outcome) {
          return outcome['bkb']
     } else if (inret) {
          return inret['nomor_return']
     } else if (outret) {
          return outret['nomor_return']
     }
}


// function for fetch api
const fetchGet = (paramsUrl, params) => {
     return fetch(url + '?' + new URLSearchParams(params), {
          headers: {
               'Accept': 'application/json'
          },
          method: 'GET',
     })
          .then(response => response.json())
          .then(data => data)
}

const fetchPost = (paramsUrl) => {
     return fetch(url, {
          headers: {
               'Accept': 'application/json'
          },
          method: 'POST',
          data: {
               id: 38
          }
     })
          .then(response => response.json())
          .then(data => console.log(data))
}

// dom affected and ontions (options on niceselect)
const niceEvolution = (dom, option) => {
     new NiceSelect.bind(dom, option = false);
}

// option is dom affected, id after created and mutable dom
const returnSelectList = (options) => {
     options.affectedDom.innerHTML = ''
     const select = document.createElement('select')
     select.setAttribute("name", `${options.id}`)
     select.setAttribute("class", 'wide')
     select.id = `${options.id}`
     // create null options
     const nullOpt = document.createElement("option")
     nullOpt.value = '';
     nullOpt.text = 'Pilih Item Yang direturn';
     select.appendChild(nullOpt)

     const data = options.data
     for (let i = 0; i < data.length; i++) {

          if (data[i].inventory.deleted_at === null) {
               const quality = data[i].qty_in ? data[i].qty_in : data[i].qty_out
               const option = document.createElement("option")
               option.value = data[i].id;
               option.setAttribute('data-max', quality)
               option.setAttribute('data-saldo', data[i].inventory.stock)
               option.setAttribute('data-idinv', data[i].inventory_id)
               option.text = data[i].inventory.nama_barang;
               select.appendChild(option)
          }

     }

     options.affectedDom.appendChild(select)
     const mutationDom = document.querySelector(`#${options.id}`)
     niceEvolution(mutationDom, { searchable: true })
}

const replaceInputQty = (params, obj) => {
     const dataMax = obj.options[obj.selectedIndex].getAttribute('data-max');
     const saldo = obj.options[obj.selectedIndex].getAttribute('data-saldo');
     let max = ''
     if (dataMax <= saldo) {
          max = dataMax
     } else {
          max = saldo
     }
     return max;
}