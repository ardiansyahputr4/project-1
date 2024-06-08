<?php
class mKategori extends CI_Model {

    function getData() {
        return $this->db->get('tbl_m_kategori')->result();
    }

    function insertData($data) {
        return $this->db->insert('tbl_m_kategori', $data);
    }

    function getDataById($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->get('tbl_m_kategori')->row();
    }

    function updateData($id, $data) {
        $this->db->where('id_kategori', $id);
        return $this->db->update('tbl_m_kategori', $data);
    }

    function deleteData($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->delete('tbl_m_kategori');
    }

    function cekDuplicate($nama_kategori) {
        $this->db->where('nama_kategori', $nama_kategori);
        $query = $this->db->get('tbl_m_kategori');
        return $query->num_rows();
    }
}
