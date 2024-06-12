<?php

namespace App\Controllers;

use App\Models\m_User;

class User extends BaseController
{

    public function __construct()
    {
        $this->user = new m_user();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'user' => $this->user->get_All(),
        ];

        return view('Admin/User/index', $data);
    }

    public function simpan()
    {
        $data = $this->request->getPost();
        $this->db->table('tbl_user')->insert($data);
        if ($this->db->affectedRows() > 0) {
            return redirect()->to('/user')->with('success', 'Data Berhasil Disimpan');
        }
    }

    public function delete($id_user)
    {
        $this->db->table('tbl_user')->where(['id_user' => $id_user])->delete();
        return redirect()->to('/user')->with('success', 'Data Berhasil Dihapus');
    }

    public function update($id_user)
    {
        $data = $this->request->getPost();
        unset($data['_method']);
        $this->db->table('tbl_user')->where(['id_user' => $id_user])->update($data);
        return redirect()->to('/user')->with('success', 'Data Berhasil Diupdate');
    }
}
