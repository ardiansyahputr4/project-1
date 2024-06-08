<?php
class mSatuan extends CI_Model {

    function getData() {
        return $this->db->get('tbl_m_satuan')->result();
    }

    function insertData($data) {
        return $this->db->insert('tbl_m_satuan', $data);
    }

    function getDataById($id) {
        $this->db->where('id_satuan', $id);
        return $this->db->get('tbl_m_satuan')->row();
    }

    function updateData($id, $data) {
        $this->db->where('id_satuan', $id);
        return $this->db->update('tbl_m_satuan', $data);
    }

    function deleteData($id) {
        $this->db->where('id_satuan', $id);
        return $this->db->delete('tbl_m_satuan');
    }

    function cekDuplicate($nama_satuan) {
        $this->db->where('nama_satuan', $nama_satuan);
        $query = $this->db->get('tbl_m_satuan');
        return $query->num_rows();
    }
}
