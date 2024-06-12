<?php

namespace App\Models;

use CodeIgniter\Model;

class m_GambarBarang extends Model
{
    public function get_All()
    {
        return $this->db->table('tbl_barang')
            ->select('tbl_barang.*, COUNT(tbl_gambar.id_barang) as total_gambar')
            ->join('tbl_gambar', 'tbl_gambar.id_barang = tbl_barang.id_barang', 'left')
            ->groupBy('tbl_barang.id_barang')
            ->orderBy('tbl_barang.id_barang', 'desc')
            ->get()
            ->getResult();
    }

    public function get_GambarBarang($id_barang)
    {
        return $this->db->table('tbl_gambar')
            ->select('*')
            ->where('id_barang', $id_barang)
            ->get()->getResult();
    }
}
