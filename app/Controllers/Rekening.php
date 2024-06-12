<?php

namespace App\Controllers;

use App\Models\m_Rekening;

class Rekening extends BaseController
{

    public function __construct()
    {
        $this->rekening = new m_Rekening();
    }

    public function index()
    {
        $data = [
            'title' => 'Rekening Bank',
            'rekening' => $this->rekening->get_All(),
        ];

        return view('Admin/Rekening/index', $data);
    }

    public function simpan()
    {
        $data = $this->request->getPost();
        $this->db->table('tbl_rekening')->insert($data);
        if ($this->db->affectedRows() > 0) {
            return redirect()->to('/rekening')->with('success', 'Data Berhasil Disimpan');
        }
    }

    public function delete($id_rekening)
    {
        $this->db->table('tbl_rekening')->where(['id_rekening' => $id_rekening])->delete();
        return redirect()->to('/rekening')->with('success', 'Data Berhasil Dihapus');
    }

    public function update($id_rekening)
    {
        $data = $this->request->getPost();
        unset($data['_method']);
        $this->db->table('tbl_rekening')->where(['id_rekening' => $id_rekening])->update($data);
        return redirect()->to('/rekening')->with('success', 'Data Berhasil Diupdate');
    }
}
