<?php

namespace App\Controllers;

use App\Models\m_GambarBarang;
use App\Models\m_Barang;

class Gambar_Barang extends BaseController
{

    public function __construct()
    {
        $this->gambar_barang = new m_GambarBarang();
        $this->barang = new m_Barang();
    }

    public function index()
    {
        $data = [
            'title' => 'Gambar Barang',
            'gambarbarang' => $this->gambar_barang->get_All(),
        ];

        return view('Admin/Gambar_Barang/index', $data);
    }


    public function delete($id_gambar)
    {
        $this->db->table('tbl_gambar')->where(['id_gambar' => $id_gambar])->delete();
        return redirect()->to('/gambar_barang')->with('success', 'Data Berhasil Dihapus');
    }

    public function tambah($id_barang = null)
    {
        if ($id_barang != NULL) {
            $data = [
                'title' => 'Add Gambar Barang',
                'barang'  => $this->barang->get_Barang($id_barang),
                'gambar' => $this->gambar_barang->get_GambarBarang($id_barang),
            ];
            return view('Admin/Gambar_Barang/tambah', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function simpan($id_barang)
    {
        $gambar = $this->request->getFile('gambar');
        $gambar->move('./assets/gambarbarang/');

        $data = [
            'id_barang' => $id_barang,
            'ket'       => $this->request->getPost('ket'),
            'gambar' => $gambar->getName(),
        ];

        $this->db->table('tbl_gambar')->insert($data);
        return redirect()->to('/gambar_barang')->with('success', 'Data Berhasil Diupdate');
    }
}
