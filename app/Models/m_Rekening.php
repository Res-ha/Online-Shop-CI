<?php

namespace App\Models;

use CodeIgniter\Model;

class m_Rekening extends Model
{
    public function get_All()
    {
        return $this->db->table('tbl_rekening')
            ->select('*')
            ->orderBy('id_rekening', 'desc')
            ->get()->getResult();
    }
}
