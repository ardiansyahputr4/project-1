<?php
class mProduk extends CI_Model {

    function getData() {
        $this->db->select('p.*, k.nama_kategori, s.nama_satuan');
        $this->db->from('tbl_m_produk p');
        $this->db->join('tbl_m_kategori k', 'p.id_kategori = k.id_kategori');
        $this->db->join('tbl_m_satuan s', 'p.id_satuan = s.id_satuan');
        return $this->db->get()->result();
    }

    function insertData($data) {
        return $this->db->insert('tbl_m_produk', $data);
    }

    function getDataById($id) {
        $this->db->where('id_produk', $id);
        return $this->db->get("tbl_m_produk")->row();
    }

    function updateData($id, $data) {
        $this->db->where('id_produk', $id);
        return $this->db->update('tbl_m_produk', $data);
    }

    function deleteData($id) {
        $this->db->where('id_produk', $id);
        return $this->db->delete('tbl_m_produk');
    }

    function cekDuplicate($nama_produk) {
        $this->db->where('nama_produk', $nama_produk);
        $query = $this->db->get('tbl_m_produk');
        return $query->num_rows();
    }

    // Membuat Kode Barang otomatis berdasarkan Kategori
    function getCode($id_kategori) {
        $query = $this->db->query("SELECT MAX(RIGHT(id_produk, 6)) AS kdmax FROM tbl_m_produk WHERE id_kategori='$id_kategori'");
        $sisCode = "";
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $k) {
                $tmp = ((int)$k->kdmax) + 1;
                $sisCode = sprintf("%06s", $tmp);
            }
        } else {
            $sisCode = "000001";
        }
        return $id_kategori . $sisCode;
    }
}
?>
