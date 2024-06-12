<?php

namespace App\Models;

use CodeIgniter\Model;

class m_User extends Model
{
    public function get_All()
    {
        return $this->db->table('tbl_user')
            ->select('*')
            ->orderBy('id_user', 'desc')
            ->get()->getResult();
    }
}
