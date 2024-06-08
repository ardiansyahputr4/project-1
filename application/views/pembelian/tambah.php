<div class="page-wrapper">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-th"></i> Transaksi Baru</h3>
            <a class="btn_tutup pull-right btn btn-primary btn-sm" id="btn_tutup">Tutup Transaksi</a>
        </div>
        <br>
        <div class="container-fluid">
            <form action="" method="post" id="form_beli">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Data Customer</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="fa fa-user"></span>
                            </span>
                            <select class="itemSupp form-control" id="itemSupp" name="itemSupp"></select>
                            <input readonly type="hidden" id="id_supp" name="id_supp" class="form-control input-sm">
                            <div class="input-group-addon">
                                <a class="tambah_supplier" href="#"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">#No Invoice</label>
                            <input readonly type="text" id="no_faktur" name="no_faktur" value="<?php echo $nofaktur; ?>" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">#No Bukti</label>
                            <input type="text" id="no_bukti" name="no_bukti" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <div class="input-group date">
                                <input class="form-control" id="tgl_beli" name="tgl_beli" type="date" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="Cari Nama Barang">Cari Nama Barang</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="fa fa-list-alt"></span>
                            </span>
                            <input readonly type="text" name="nama_barang" id="nama_barang" placeholder="Nama Barang.." class="form-control cari_barang">
                            <input readonly type="hidden" id="id_produk" name="id_produk" class="form-control input-sm">
                            <div class="input-group-addon">
                                <a class="cari_barang" href="#"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Satuan</label>
                        <input readonly type="text" id="satuan" class="form-control input-sm">
                    </div>
                </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Stok</label>
                            <input readonly type="text" id="stok" name="stok" class="form-control input-sm">
                        </div>
                        </div>

                        <div class="col-xs-2">
                        <div class="form-group">
                            <label for="">Harga Beli</label>
                            <input id="harga_beli" name="harga_beli" style="text-align:right;color:blue;font-weight: bold;" type="text" class="form-control input-sm">
                        </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-xs-1">
                            <div class="form-group">
                            <label for="">Margin <span class="text-danger">*</span></label>
                            <input type="text" name="margin" id="margin" autocomplete="off" onkeypress="return isNumber(this, event);" style='text-align: right' class="form-control input-sm" maxlength="2" onkeyup="hitung_hpp()" required>
                            </div>
                        </div>

                        <div class="col-xs-2">
                            <div class="form-group">
                            <label for="">Harga Pokok <span class="text-danger">*</span></label>
                            <input type="text" autocomplete="off" onkeypress="return isNumber(this, event);" style='text-align: right' name="harga_pokok" id="harga_pokok" class="form-control input-sm" required>
                            </div>
                        </div>


                        <div class="col-xs-2">
                            <div class="form-group">
                            <label for="">Harga Jual <span class="text-danger">*</span></label>
                            <input type="text" autocomplete="off" onkeypress="return isNumber(this, event);" style='text-align: right' name="harga_jual" id="harga_jual" class="form-control input-sm" required>
                            </div>
                        </div>

                        <div class="col-xs-1">
                            <label for="">Jumlah <span class="text-danger">*</span></label>
                            <div class="form-group">
                            <input autocomplete="off" name="qty" id="qty" onkeypress="return isNumber(this, event);" style='text-align: right' type="text" onkeyup="hitung_subtotal()" class="form-control input-sm" />
                            </div>
                        </div>

                        <div class="col-xs-1">
                            <label for="">Diskon</label>
                            <div class="form-group">
                            <input id="diskon" name="diskon" onkeypress="return isNumber(this, event);" type="text" autocomplete="off" style="text-align:right;" class="form-control input-sm" maxlength="2" onkeyup="hitung_subtotal()" required>
                            </div>
                        </div>
                        </div>

                            <div class="col-xs-2">
                            <div class="form-group">
                                <label for="nilai_diskon">Nilai Diskon</label>
                                <input id="nilai_diskon" style="text-align:right;color:red;font-weight: bold;"
                                name="nilai_diskon" class="form-control input-sm" readonly>
                            </div>
                            </div>
                            <div class="col-xs-2">
                            <div class="form-group">
                                <label for="sub_total">Sub Total</label>
                                <input id="sub_total" size="16" style="text-align:right;color:blue;font-weight: bold;"
                                name="sub_total" class="form-control input-sm" readonly>
                            </div>
                            </div>
                            <input id="total" size="16" style="text-align:right;color:blue;font-weight: bold;"
                                name="total" class="form-control input-sm" type="hidden" readonly>
                        </div>

                        <div class="box-footer with-border color-footer">
                            <div class="box-tools pull-right">
                                <button type="button" disabled="disabled" class="btn btn-sm btn-success" id="btn_tambah" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing ">
                                    <span class="fa fa-floppy-o"></span> Tambah </button>
                                <button type="button" disabled="disabled" id="btn_clear"  class="btn btn-sm btn-warning btn_clear">
                                    <span class="fa fa-times"></span>
                                </button>
                                    <span class="fa fa-floppy-o"></span> Batal </button>
                            </div>
                        </div>
                    </form>
                    <h4 class="item-title text-bold"><span class="text-danger">List</span>Barang di Beli</h4>
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th style='width:30px;text-align: center;'>#No</th>
                                <th>Nama Barang</th>
                                <th style='width:80px;text-align: right;'>Harga Beli</th>
                                <th style='width:30px;text-align: right;'>Margin</th>
                                <th style='width:100px;text-align: right;'>Harga Pokok</th>
                                <th style='width:80px;text-align: right;'>Harga Jual</th>
                                <th style='width:40px;text-align: right;'>Qty</th>
                                <th>Satuan</th>
                                <th style='width:80px;text-align: right;'>Nilai Disc</th>
                                <th style='width:80px;text-align: right;'>Sub Total</th>
                                <th style='width:40px;text-align: center;'>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_produk">
                        </tbody>
                    </table>

                    <div class="col-sm-6">
                        <div class="row">
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="">Cara Bayar</label>
                                        <select class="form-control" id="is_bayar" name="is_bayar">
                                            <option value="1">Tunai</option>
                                            <option value="0">Kredit</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>Term</label>
                                        <input disabled="disabled" onkeypress="return isNumber(this,event);" name="term" id="term"
                                            type="text" autocomplete="off" class="form-control input-sm" onkeyup="insertJatuhTempo()">
                                    </div>
                                </div>

                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>J. Tempo</label>
                                        <input readonly name="dt_tempo" id="dt_tempo" type="text" class="form-control input-sm" required>
                                    </div>
                                </div>

                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <textarea class="required form-control" name="keterangan" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-11">
                                    <div class="box-tools pull-right">
                                        <button type="button" disabled="disabled" class="btn btn-sm btn-primary" id="btn_simpan"
                                            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing ">
                                            <span class="fa fa-floppy-o"></span> Simpan Transaksi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="" method="POST" id="form_bayar">
                        <div class="d-md-flex flex-md-wrap">
                            <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                                <table class="table">
                                    <tbody>
                                        <tr class="success" style="background-color: $f9f9f9 !important;font-weight: bold; font-size:16px;">
                                            <td colspan="1">#TOTAL PEMBELIAN</td>
                                            <td style="text-align: right !important;">
                                                <input id="total_beli" name="total_beli" type="text" readonly style="width:120px;text-align: right; font-weight: bold;
                                                font-size: 16px; color:red"/>
                                            </td>
                                        </tr>

                                        <tr class="active" style="background-color: $f9f9f9 !important; font-size:14px;">
                                            <td colspan="1">JUMLAH DISKON</td>
                                            <td style="text-align: right !important;">
                                                <input id="nilai_potongan" name="nilai_potongan" type="text" readonly 
                                                style="width:120px;text-align: right;" type="text" autocomplete="off"/>
                                            </td>
                                        </tr>

                                        <tr class="info" style="background-color: $f9f9f9 !important; font-size:14px;">
                                            <td colspan="1">PPN (11%)</td>
                                            <td style="text-align: right !important;">
                                                <input id="ppn" name="ppn" type="text" readonly 
                                                style="width:120px;text-align: right;" type="text" autocomplete="off" />
                                            </td>
                                        </tr>

                                        <tr class="active" style="background-color: $f9f9f9 !important; font-size:14px;">
                                            <td colspan="1">BIAYA LAIN</td>
                                            <td style="text-align: right !important;">
                                                <input id="biaya" name="biaya" onkeypress="return isNumber(this,event);" readonly 
                                                style="width:120px;text-align: right;" type="text" onkeyup="hitung_total()" autocomplete="off"/>
                                            </td>
                                        </tr>

                                        <tr class="active" style="background-color: $f9f9f9 !important; font-size:14px;">
                                            <td colspan="1">#GRAND TOTAL</td>
                                            <td style="text-align: right !important;">
                                                <input id="grandtotal" name="grandtotal" type="text" readonly style="width:120px;text-align: right; font-weight: bold;
                                                font-size: 16px; color:red"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
             </div>
         </div>
    </div>
</div>

<!-- Modal Barang -->
<div class="modal fade" id="modal_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="item-title text-bold"><span class="text-danger">List</span>Barang</h4>
        </div>
        <div class="table table-bordered table-condensed" id="tblbarang">
            <thead>
                <tr>
                <th style='width:200px; '> Nama Barang</th>
                <th style='width:10px;text-align: right; '> Harga Beli</th>
                <th style='width:10px;text-align: right; '> Harga Beli</th>
                <th style='width:10px; '> Satuan</th>
                <th style='width:5;text-align: right; '> Stok</th>
                <th style='width:10px; text-align: center;'>Action</th>
            </tr>
            </thead>
            <tbody id="dataBarang">
            </tbody>
            </table>
        </div>
    </div>
</div>
</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" id="btnSave_Supplier" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Simpan Data</button>
        </div>
    </div>
</div>

<script src="<?php echo base_url().'assets/js/validate.js'?>"></script>
<script src="<?php echo base_url().'assets/js/beli.js'?>"></script>
<
                    