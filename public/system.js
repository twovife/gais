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
     } else if (riten) {
          return outret['nomor_return']
     }
}