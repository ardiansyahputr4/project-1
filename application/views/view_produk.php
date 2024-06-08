<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border color-header">
                <h3 class="box-title"><i class="fa fa-th"></i> Data Barang</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-default btn-sm" href="<?php echo base_url('produk'); ?>">
                        <span class="fa fa-refresh"></span> Refresh
                    </a>
                    <button type="button" class="btn btn-sm btn-success" id="btnTambah">
                        <span class="fa fa-plus"></span> Tambah
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-condensed" id="mydata">
                            <thead>
                                <tr>
                                    <th style='width:30px;text-align: center;'>#No</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Satuan</th>
                                    <th style='width:90px;text-align: right;'>Harga Beli</th>
                                    <th style='width:80px; text-align: right;'>Harga Pokok</th>
                                    <th style='width:80px;text-align: right;'>Harga Jual</th>
                                    <th style='width:120px;text-align: center;'>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_data">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel"><i class="fa fa-plus"></i> Data Supplier Barang</h4>
            </div>
            <form action="" method="post" id="form_add">
                <div class="modal-body">
                    <input type="hidden" id="id_produk" name="id_produk">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Kategori">Kategori <span class="text-danger">*</span></label>
                                <select name="id_kategori" id="id_kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategori as $row) {
                                        echo "<option value='$row->id_kategori'>$row->nama_kategori</option>";
                                    } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="Nama Barang">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" id="nama_produk" name="nama_produk" autocomplete="off" class="form-control input-sm"
                                    placeholder="Nama Barang">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Satuan">Satuan <span class="text-danger">*</span></label>
                                <select name="id_satuan" id="id_satuan" class="form-control">
                                    <option value="">Pilih Satuan</option>
                                    <?php foreach ($satuan as $row) {
                                        echo "<option value='$row->id_satuan'>$row->nama_satuan</option>";
                                    } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Barcode">Barcode</label>
                                <input type="text" id="barcode" name="barcode" autocomplete="off" class="form-control input-sm"
                                    placeholder="Nomor Barcode">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Harga Beli">Harga Beli <span class="text-danger">*</span></label>
                                <input type="text" id="harga_beli" name="harga_beli" autocomplete="off" class="form-control input-sm"
                                    placeholder="Harga Beli" onkeypress="return isNumber(event);">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Harga Pokok">Harga Pokok <span class="text-danger">*</span></label>
                                <input type="text" id="harga_pokok" name="harga_pokok" autocomplete="off" class="form-control input-sm"
                                    placeholder="Harga Pokok" onkeypress="return isNumber(event);">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Harga Jual">Harga Jual <span class="text-danger">*</span></label>
                                <input type="text" id="harga_jual" name="harga_jual" autocomplete="off" class="form-control input-sm"
                                    placeholder="Harga Jual" onkeypress="return isNumber(event);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnSimpan" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url().'assets/js/validate.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    var bEdit = false;
    tampil_data();
    
    function tampil_data() {
        $.ajax({
            url: "<?php echo base_url(); ?>Produk/tampilkanData",
            type: "POST",
            dataType: "json",
            success: function(response) {
                var html = "";
                for (var i = 0; i < response.length; i++) {
                    html += "<tr>";
                    html += "<td>" + (i+1) + "</td>";
                    html += "<td>" + response[i].nama_produk + "</td>";
                    html += "<td>" + response[i].nama_kategori + "</td>";
                    html += "<td>" + response[i].nama_satuan + "</td>";
                    html += "<td style=\"text-align: right;\">" + Intl.NumberFormat('id-ID').format(response[i].harga_beli) + "</td>";
                    html += "<td style=\"text-align: right;\">" + Intl.NumberFormat('id-ID').format(response[i].harga_pokok) + "</td>";
                    html += "<td style=\"text-align: right;\">" + Intl.NumberFormat('id-ID').format(response[i].harga_jual) + "</td>";
                    html += "<td style='text-align: center;'><button data-id=\"" + response[i].id_produk + "\" class=\"btn btn-success btn-xs btn-edit\"><i class=\"fa fa-edit\"></i> Edit</button> ";
                    html += "<button data-id=\"" + response[i].id_produk + "\" class=\"btn btn-danger btn-xs btn-hapus\"><i class=\"fa fa-trash\"></i> Hapus</button></td>";
                    html += "</tr>";
                }
                $("#tbl_data").html(html);
                $('#mydata').DataTable();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }

    $(document).on("click", "#btnTambah", function(e){
        e.preventDefault();
        bEdit = false;
        $('#form_add')[0].reset(); 
        $('#formModal').modal('show'); 
        $('.modal-title').text('Tambah Barang');
    });

    $("#tbl_data").on('click', '.btn-edit', function(){
        var id_produk = $(this).attr('data-id');
        bEdit = true;
        $.ajax({
            url: '<?php echo base_url(); ?>Produk/tampilkanDataById',
            type: 'POST',
            data: {id_produk: id_produk},
            dataType: 'json',
            success: function(response){
                $('#form_add')[0].reset();
                $('.modal-title').text('Edit Barang');
                $('input[name="id_produk"]').val(response.id_produk);
                $('input[name="nama_produk"]').val(response.nama_produk);
                $('select[name="id_kategori"]').val(response.id_kategori);
                $('select[name="id_satuan"]').val(response.id_satuan);
                $('input[name="barcode"]').val(response.barcode);
                $('input[name="harga_beli"]').val(response.harga_beli);
                $('input[name="harga_pokok"]').val(response.harga_pokok);
                $('input[name="harga_jual"]').val(response.harga_jual);
                $('#formModal').modal('show');
            }
        });
    });

    $("#tbl_data").on('click', '.btn-hapus', function(){
        var id_produk = $(this).attr('data-id');
        if(confirm('Yakin ingin menghapus data ini?')) {
            $.ajax({
                url: '<?php echo base_url(); ?>Produk/hapusData',
                type: 'POST',
                data: {id_produk: id_produk},
                dataType: 'json',
                success: function(data){
                    if(data.response === 'success') {
                        tampil_data();
                    } else {
                        alert('Gagal menghapus data.');
                    }
                }
            });
        }
    });

    $("#btnSimpan").click(function() {
        var url = '';
        if (bEdit) {
            url = '<?php echo base_url(); ?>Produk/perbaruiData';
        } else {
            url = '<?php echo base_url(); ?>Produk/tambahData';
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form_add').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.response === 'success') {
                    $('#formModal').modal('hide');
                    tampil_data();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});

</script>
