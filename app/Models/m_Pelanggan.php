<?php

namespace App\Models;

use CodeIgniter\Model;

class m_Pelanggan extends Model
{
    public function getKodePelanggan()
    {
        return $this->db->table('tbl_pelanggan')
            ->select('kode_pelanggan')
            ->orderBy('kode_pelanggan', 'DESC')
            ->limit(1)
            ->get()->getRowArray();
    }
}
