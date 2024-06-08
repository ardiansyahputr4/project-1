//hitung nilai margin
function hitung_hpp() {
    let margin = $("#margin").val();
    let harga_beli = $("#harga_beli").val();

    if (isEmptyNumber(harga_beli)) {
        harga_beli=0;
    }else{
        harga_beli=harga_beli.replace(/[,.]/g, '');
    }
    if(margin.length > 0) {
        margin=parseFloat(margin).toFixed(2);
        let nilai_margin = (margin/100) * harga_beli;
        let hpp=parseInt(harga_beli)+parseInt(nilai_margin);
        $("#nilai_margin").val(parseFloat(hpp).toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        $("#harga_pokok").val(parseFloat(hpp).toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    }
}

//hitung nilai sub total
function hitung_subtotal() {
    let qty = $("#qty").val();
    let harga_jual = $("#harga_jual").val();
    let diskon = $("#diskon").val();

    if (isEmptyNumber (harga_jual)) {
        harga_jual=0;
    }else {
        harga_jual= clearFormat(harga_jual);
    }

    if (isEmptyNumber(diskon)) {
        diskon=0;
    } else {
        diskon= parseFloat(diskon).toFixed(2);
    }

    let jumlah_harga = qty * harga_jual;
    let nilai_diskon = diskon/100 * jumlah_harga;
    $("#nilai_diskon").val(parseFloat(nilai_diskon).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    let sub_total = parseFloat(jumlah_harga).toFixed(2);
    $("#sub_total").val(parseFloat(sub_total).toFixed(2).replace(/(\d)(?=\d\d\d)+((?!\d))/g, "$1, "));
}

//hitung nilai total transaksi
function hitung_total() {
    var total_beli = $("#total_beli").val();
    var potongan = $("nilai_potongan").va();
    var biaya = $("#biaya").va();

    if (isEmptyNumber(biaya)) {
        biaya=0;
    }else{
        biaya=clearFormat(biaya);
    }

    if (isEmptyNumber(potongan)) {
        diskon=0;
    } else {
        diskon= parseFloat(potongan).toFixed(0);
    }

    total_beli= clearFormat(total_beli);
    let nilai_pajak = parseInt(total_beli,10)*11/100;
    nilai_pajak = parseFloat(nilai_pajak).toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    $("#ppn").val(nilai_pajak);

    let jum_bersih = parseInt(total_beli,10)-parseInt(nilai_pajak,10)+parseInt(biaya,10);
    grandtotal = parseFloat(grandtotal).toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    $("#grandtotal").val(grandtotal);
}

//bersihkan format mata uang
function clearFormat(sVar){
    sVar = sVar.replace(/[,.]/g, '');
    return sVar;
}

//menambahkan hari berikutnya
function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

//membuat format tanggal dd/mm/yy
function setFormatDate(date) {
    var dd = date.getDate();
    var mm = (date.getMonth()+1);
    var y= date.getFullYear();
    return dd + '/' + mm + '/' + y;
}

//fungsi untuk memasukkan tanggal jatuh tempo
function insertJatuhTempo() {
    var valTerm = $("#term").val();
    var DateBeli = $("#tgl_beli").val();
    if (!isEmptyNumber(valTerm)) {
        var newDate = new Date(DateBeli);
        var numberOfDaysToAdd = parseInt(valTerm);
        someDate=addDays(newDate, numberOfDaysToAdd);
        var dtJatuhTempo = setFormatDate(someDate);
        
        $('#dt_tempo').val(setFormatDate(someDate));
    }else{
        $("#dt_tempo").val('');
    }
}

//pilih Item Supplier
$(document).ready(function() {
    $('#itemSupp').on('select2:select', function (e) {
        var data = e.params.data;
        $("#id_supp").val(data['id']);
        $("#nama_supp").val(data['text']);
        $("#id_barang").focus();
    });
    //modal tambah supplier baru
    $('.tambah_supplier').click(function (e){
        $("#modal_supp").modal('show');
    });

    //validasi saat qty di isi
    $("#qty").keyup(function(){
        el = $(this);
        if(el.val().length > 0){
            $('#btn_tambah').removeAttr('disabled');
            $('#btn_clear').removeAttr('disabled');
        } else {
            $('#btn_tambah').attr('disabled','true');
            $('#btn_clear').attr('disabled','true');
        }
    });

    //validasi harga pokok
    $('#harga_pokok').keypress(function(e){
        if(e.which == 13) {
            var harga_beli = $("#harga_beli").val();
            var harga_pokok = $("#harga_pokok").val();
            harga_beli= clearFormat(harga_beli);
            harga_pokok = clearFormat(harga_pokok);

            if (parseInt(harga_pokok)<parseInt(harga_beli)) {
                Swal.fire({
                    icon:'error',
                    title: 'Oops...<br> Harga Pokok Tidak Boleh Lebih Kecil Harga Beli',
                    footer: 'Harga Beli Barang <b> ' + ' ( ' + harga_beli + ' ) ' + '</b> Silahkan Periksa Kembali'
                });
            }
        }
    })
}); 

// validasi harga jual
$('#harga_jual').keypress(function(e){
    if(e.which == 13) {
        var harga_jual = $("#harga_jual").val();
        var harga_pokok = $("#harga_pokok").val();
        harga_beli= clearFormat(harga_jual);
        harga_pokok = clearFormat(harga_pokok);

        if (parseInt(harga_jual)<parseInt(harga_pokok)) {
            Swal.fire({
                icon:'error',
                title: 'Oops...<br> Harga Jual Tidak Boleh Lebih Kecil Harga Satuan',
                footer: 'Harga Satuan Barang <b> ' + ' ( ' + harga_pokok + ' ) ' + '</b> Silahkan Periksa Kembali'
            });
        }
    }
});

// validasi jenis transaksi Tunai/Kredit
$('#is_bayar').change(function() {
    if ($("#is_bayar").val() == 0) {
        $('#term').attr("disabled", false);
        $('#keterangan').focus();

    }else {
        $('#term').attr("disabled", true);
        $('#term').focus();
    }
});