<?php

namespace App\Models;

use CodeIgniter\Model;

class m_Transaksi extends Model
{
    public function simpan_transaksi($data)
    {
        $this->db->insert('tbl_transaksi', $data);
    }

    public function simpan_rinci_transaksi($data_rinci)
    {
        $this->db->insert('tbl_rinci_transaksi', $data_rinci);
    }

    public function status_Transaksi($status)
    {
        $session = \Config\Services::session();
        $session->start();
        return $this->db->table('tbl_transaksi')
            ->select('*')
            ->where('id_pelanggan', $session->get('id_pelanggan'))
            ->where('status_order', $status)
            ->orderBy('id_transaksi', 'desc')
            ->get()->getResult();
    }

    public function rekening()
    {
        return $this->db->table('tbl_rekening')
            ->select('*')
            ->get()->getResult();
    }
}
