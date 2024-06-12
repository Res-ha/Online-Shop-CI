<?php

namespace App\Models;

use CodeIgniter\Model;

class m_Kategori extends Model
{
    public function get_All()
    {
        return $this->db->table('tbl_kategori')
            ->select('*')
            ->orderBy('id_kategori', 'desc')
            ->get()->getResult();
    }

    public function get_Kategori($id_kategori)
    {
        return $this->db->table('tbl_kategori')
            ->select('*')
            ->where('id_kategori', $id_kategori)
            ->get()->getRow();
    }

    public function get_KategoriBarang($id_kategori)
    {
        return $this->db->table('tbl_barang')
            ->select('*')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_barang.id_kategori', 'left')
            ->where('tbl_barang.id_kategori', $id_kategori)
            ->get()->getResult();
    }
}
