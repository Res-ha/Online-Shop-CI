<?php

namespace App\Controllers;

use App\Models\m_Kategori;

class Kategori extends BaseController
{

    public function __construct()
    {
        $this->kategori = new m_Kategori();
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'kategori' => $this->kategori->get_All(),
        ];

        return view('Admin/Kategori/index', $data);
    }

    public function simpan()
    {
        $data = $this->request->getPost();
        $this->db->table('tbl_kategori')->insert($data);
        if ($this->db->affectedRows() > 0) {
            return redirect()->to('/kategori')->with('success', 'Data Berhasil Disimpan');
        }
    }

    public function delete($id_kategori)
    {
        $this->db->table('tbl_kategori')->where(['id_kategori' => $id_kategori])->delete();
        return redirect()->to('/kategori')->with('success', 'Data Berhasil Dihapus');
    }

    public function update($id_kategori)
    {
        $data = $this->request->getPost();
        unset($data['_method']);
        $this->db->table('tbl_kategori')->where(['id_kategori' => $id_kategori])->update($data);
        return redirect()->to('/kategori')->with('success', 'Data Berhasil Diupdate');
    }
}
