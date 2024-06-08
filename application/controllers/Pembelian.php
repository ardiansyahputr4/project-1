<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('mPembelian');
        $this->load->model('mProduk');
        $this->load->model('mSupplier');
    }

    function index(){
        $data['page'] = "Pembelian";
        $data['judul'] = "Data Pembelian";
        $data['deskripsi'] = "Manage Data Pembelian";
        $this->template->views('pembelian/list', $data);
    }

    function tambah(){
        $data['page'] = "tambah Pembelian";
        $data['judul'] = "Pembelian Barang";
        $data['deskripsi'] = "Transaksi Pembelian Barang";
        $data['nofaktur'] = $this->mPembelian->getNoFaktur();
        $this->template->views('pembelian/tambah', $data);
    }
    //pencarian data supplier
    function findSupplier(){
        $searchTerm = $this->input->post('searchTerm');
        $data = $this->mPembelian->searchSupplier($searchTerm);
        echo json_encode($data);
    }

    //Tampilan Semua Produk
    function tampilkanListBarang(){
        $data = $this->mProduk->getListBarang();
        echo json_encode($data);
    }

    //menampilkan detail barang berdasarkan id produk
    function findBarang(){
        $id_barang=$this->input->post('id_produk');
        if($post = $this->mProduk->getListbarang($id_barang)){
            $data = array('response' => 'success','post' => $post);
        } else {
            $data = array('response' => 'error');
        }
        echo json_encode($data);
    }
   // Simpan Barang
    function simpanProduk() {
        $this->form_validation->set_rules('id_produk', 'Nama Barang Belum di Pilih', 'required');
        $this->form_validation->set_rules('harga_pokok', 'Harga Satuan Barang belum di isi', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual Barang belum di isi', 'required');
        $this->form_validation->set_rules('qty', 'Qty Barang belum di isi', 'required');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $response = array('responce' => 'error', 'message' => validation_errors());
        } else {
            $no_faktur = $this->input->post('no_faktur');
            $id_produk = $this->input->post('id_produk');

            // Periksa No Faktur apakah sudah ada
            if ($this->mPembelian->cekFaktur($no_faktur)) {
                // Jika Sudah ada, maka periksa apakah sudah ada item barang tersimpan
                // dalam tabel detail pembelian
                if ($this->mPembelian->cekItemDuplicate($no_faktur, $id_produk)) {
                    // Jika sudah ada maka batalkan
                    $response = array('responce' => 'error', 'message' => 'Nama Barang Sudah Terdaftar dalam List..');
                } else {
                    // Jika belum ada maka simpan item barang baru
                    $data_detail = array(
                        'no_faktur' => $no_faktur,
                        'id_produk' => $this->input->post('id_produk'),
                        'harga_beli' => intval(str_replace(",", "", $this->input->post('harga_beli', 'true'))),
                        'margin' => intval(str_replace(",", "", $this->input->post('margin', 'true'))),
                        'nilai_margin' => intval(str_replace(",", "", $this->input->post('nilai_margin', 'true'))),
                        'harga_pokok' => intval(str_replace(",", "", $this->input->post('harga_pokok', 'true'))),
                        'harga_jual' => intval(str_replace(",", "", $this->input->post('harga_jual', 'true'))),
                        'diskon' => intval(str_replace(",", "", $this->input->post('diskon', 'true'))),
                        'nilai_diskon' => intval(str_replace(",", "", $this->input->post('nilai_diskon', 'true'))),
                        'sub_total' => intval(str_replace(",", "", $this->input->post('sub_total', 'true'))),
                        'qty' => $this->input->post('qty')
                    );
                    $data_detail = $this->security->xss_clean($data_detail);

                    try {
                        if ($this->mPembelian->insertDetail($data_detail)) {
                            $response = array('responce' => 'success', 'message' => 'Berhasil di Simpan');
                        } else {
                            $response = array('responce' => 'error', 'message' => 'Terjadi Kesalahan, Data GAGAL di Simpan');
                        }
                    } catch (Exception $e) {
                        $response = array('responce' => 'error', 'message' => $e->getMessage());
                    }
                }
            }
        }

        echo json_encode($response);
    }
    // Simpan Transaksi Pembelian
    function saveTransaksi() {
        $this->form_validation->set_rules('no_faktur', 'Terjadi Kesalahan, Refresh Halaman Ini', 'required');
        $this->form_validation->set_rules('is_bayar', 'Cara Bayar Belum di Pilih', 'required');
        if ($this->form_validation->run() == FALSE) {
            $response = array('responce' => 'error', 'message' => validation_errors());
        } else {
            $no_faktur = $this->input->post('no_faktur');
            $tgl_beli = date_format(date_create($this->input->post('tgl_beli')), 'Y-m-d');
            $is_bayar = $this->input->post('is_bayar');
            $jt = $this->input->post('tgl_tempo');
            if ($is_bayar == '0') {
                $jt = fix_date($jt);
            }

            $data_Master = array(
                'no_faktur' => $no_faktur,
                'tgl_faktur' => $tgl_beli,
                'id_supp' => $this->input->post('id_supp'),
                'no_bukti' => $this->input->post('no_bukti'),
                'total_beli' => intval(str_replace(",", "", $this->input->post('total_beli', 'true'))),
                'potongan' => intval(str_replace(",", "", $this->input->post('nilai_potongan', 'true'))),
                'biaya_lain' => intval(str_replace(",", "", $this->input->post('biaya', 'true'))),
                'ppn' => intval(str_replace(",", "", $this->input->post('ppn', 'true'))),
                'total_bersih' => intval(str_replace(",", "", $this->input->post('grandtotal', 'true'))),
                'stts_bayar' => $is_bayar,
                'term' => $this->input->post('term'),
                'tgl_jt' => $jt,
                'stts_beli' => $is_bayar
            );
            $data_Master = $this->security->xss_clean($data_Master);

            try {
                if ($this->mPembelian->closingPembelian($no_faktur, $data_Master)) {
                    $response = array('responce' => 'success', 'message' => 'Transaksi Pembelian Berhasil di Proses');
                } else {
                    $response = array('responce' => 'error', 'message' => 'Terjadi Kesalahan, Data GAGAL di Simpan');
                }
            } catch (Exception $e) {
                $response = array('responce' => 'error', 'message' => $e->getMessage());
            }
        }
        echo json_encode($response);
    }
    // Tampilkan List Barang
    function getListBarang() {
        $no_faktur = $this->input->post('no_faktur');
        $response = $this->mPembelian->getBarangBeli($no_faktur);
        echo json_encode($response);
    }

    function hapusItemBarang() {
        if ($this->input->is_ajax_request()) {
            $id_beli = $this->input->post('id_beli');
            if ($this->mPembelian->deleteItemBarang($id_beli)) {
                $data = array('responce' => 'success');
            } else {
                $data = array('responce' => 'error');
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    function hapusTransaksi() {
        if ($this->input->is_ajax_request()) {
            $no_faktur = $this->input->post('no_faktur');
            if ($this->mPembelian->deleteData($no_faktur)) {
                $data = array('responce' => 'success');
            } else {
                $data = array('responce' => 'error');
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    // end Controller
}