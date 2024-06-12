<?php

namespace App\Models;

use CodeIgniter\Model;

class m_Dashboard extends Model
{
    public function count_Tabel($tabel)
    {
        return $this->db->table($tabel)->countAll();
    }
}
