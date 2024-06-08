<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('mKategori');
    }

    function index(){
        $data['page'] = "Kategori";
        $data['judul'] = "Data Kategori";
        $data['deskripsi'] = "Manage Data Kategori";
        $data['data'] = $this->mKategori->getData();
        $this->template->views('view_kategori', $data);
    }

    function tampilkanData(){
        $data = $this->mKategori->getData();
        echo json_encode($data);
    }

    function tambahData(){
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
        if ($this->form_validation->run() == FALSE) {
            $response = array('response' => 'error', 'message' => validation_errors());
        } else {
            $nama_kategori = $this->input->post('nama_kategori');
            $validData = $this->mKategori->cekDuplicate($nama_kategori);
            if ($validData >= 1) {
                $response = array('response' => 'error', 'message' => 'Nama Kategori Barang Sudah Terdaftar...');
            } else {
                $data = ['nama_kategori' => $nama_kategori];
                if ($this->mKategori->insertData($data)) {
                    $response = array('response' => 'success', 'message' => 'Record added Successfully');
                } else {
                    $response = array('response' => 'error', 'message' => 'Terjadi Kesalahan, Data Gagal Disimpan');
                }
            }
        }
        echo json_encode($response);
    }

    function perbaruiData(){
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
        $this->form_validation->set_rules('id_kategori', 'ID Kategori', 'required');
        if ($this->form_validation->run() == FALSE) {
            $response = array('response' => 'error', 'message' => validation_errors());
        } else {
            $nama_kategori = $this->input->post('nama_kategori');
            $id_kategori = $this->input->post('id_kategori');
            $data = ['nama_kategori' => $nama_kategori];
            if ($this->mKategori->updateData($id_kategori, $data)) {
                $response = array('response' => 'success', 'message' => 'Record updated Successfully');
            } else {
                $response = array('response' => 'error', 'message' => 'Terjadi kesalahan, Data Gagal disimpan');
            }
        }
        echo json_encode($response);
    }

    function tampilkanDataById(){
        $id_kategori = $this->input->post('id_kategori');
        $data = $this->mKategori->getDataById($id_kategori);
        echo json_encode($data);
    }

    function hapusData(){
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id_kategori');
            if ($this->mKategori->deleteData($id)) {
                $data = array('response' => 'success');
            } else {
                $data = array('response' => 'error');
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
}
?>
