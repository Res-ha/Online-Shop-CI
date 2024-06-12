<?php

namespace App\Models;

use CodeIgniter\Model;

class m_Barang extends Model
{
    public function get_All()
    {
        return $this->db->table('tbl_barang')
            ->select('tbl_barang.*, tbl_kategori.nama_kategori')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_barang.id_kategori', 'left')
            ->orderBy('tbl_barang.id_barang', 'desc')
            ->get()->getResult();
    }

    public function get_Barang($id_barang)
    {
        return $this->db->table('tbl_barang')
            ->select('*')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_barang.id_kategori', 'left')
            ->where('id_barang', $id_barang)
            ->get()
            ->getRow();
    }

    public function getKodeBarang()
    {
        return $this->db->table('tbl_barang')
            ->select('kode_barang')
            ->orderBy('kode_barang', 'DESC')
            ->limit(1)
            ->get()->getRowArray();
    }
}
