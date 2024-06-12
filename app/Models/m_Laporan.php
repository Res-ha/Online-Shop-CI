<?php

namespace App\Models;

use CodeIgniter\Model;

class m_Laporan extends Model
{
    public function get_All()
    {
        return $this->db->table('tbl_kategori')
            ->select('*')
            ->orderBy('id_kategori', 'desc')
            ->get()->getResult();
    }

    public function get_LaporanHarian($tanggal, $bulan, $tahun)
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->select('*')
            ->join('tbl_transaksi', 'tbl_transaksi.no_order = tbl_rinci_transaksi.no_order', 'left')
            ->join('tbl_barang', 'tbl_barang.id_barang = tbl_rinci_transaksi.id_barang', 'left')
            ->where('DAY(tbl_transaksi.tgl_order)', $tanggal)
            ->where('MONTH(tbl_transaksi.tgl_order)', $bulan)
            ->where('YEAR(tbl_transaksi.tgl_order)', $tahun)
            ->get()->getResult();
    }

    public function get_LaporanBulanan($bulan, $tahun)
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->select('*')
            ->join('tbl_transaksi', 'tbl_transaksi.no_order = tbl_rinci_transaksi.no_order', 'left')
            ->join('tbl_barang', 'tbl_barang.id_barang = tbl_rinci_transaksi.id_barang', 'left')
            ->where('MONTH(tbl_transaksi.tgl_order)', $bulan)
            ->where('YEAR(tbl_transaksi.tgl_order)', $tahun)
            ->get()->getResult();
    }

    public function get_LaporanTahunan($tahun)
    {
        return $this->db->table('tbl_rinci_transaksi')
            ->select('*')
            ->join('tbl_transaksi', 'tbl_transaksi.no_order = tbl_rinci_transaksi.no_order', 'left')
            ->join('tbl_barang', 'tbl_barang.id_barang = tbl_rinci_transaksi.id_barang', 'left')
            ->where('YEAR(tbl_transaksi.tgl_order)', $tahun)
            ->get()->getResult();
    }
}
