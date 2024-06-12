<?php

namespace App\Models;

use CodeIgniter\Model;

class m_Pesanan extends Model
{
    public function status_Pesanan($status)
    {
        return $this->db->table('tbl_transaksi')
            ->select('*')
            ->where('status_order', $status)
            ->orderBy('id_transaksi', 'desc')
            ->get()->getResult();
    }

    public function detail_Masuk()
    {
        return $this->db->table('tbl_transaksi')
            ->join('tbl_rinci_transaksi', 'tbl_rinci_transaksi.no_order = tbl_transaksi.no_order', 'left')
            ->orderBy('id_transaksi', 'desc')
            ->get()
            ->getRow();
    }

    public function detail_transaksi($id_transaksi)
    {
        return $this->db->table('tbl_transaksi')
            ->where('id_transaksi', $id_transaksi)
            ->get()->getRow();
    }

    public function detail_barang($id_transaksi)
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->join('tbl_transaksi', 'tbl_transaksi.no_order = tbl_rinci_transaksi.no_order', 'left')
            ->join('tbl_barang', 'tbl_barang.id_barang = tbl_rinci_transaksi.id_barang', 'left')
            ->where('tbl_transaksi.id_transaksi', $id_transaksi) // Gunakan nama tabel sebelum kolom pada kondisi where
            ->get()->getResult();
    }
}
