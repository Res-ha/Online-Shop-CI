<?php

namespace App\Controllers;

use App\Models\m_Barang;
use App\Models\m_Kategori;

class Barang extends BaseController
{

    public function __construct()
    {
        $this->barang = new m_Barang();
        $this->kategori = new m_Kategori();
    }

    public function index()
    {
        $data = [
            'title' => 'Barang',
            'barang' => $this->barang->get_All(),
        ];

        return view('Admin/Barang/index', $data);
    }

    public function generateKodeBarang()
    {
        $kodeBarang = $this->barang->getKodeBarang();

        if ($kodeBarang) {
            $lastNumber = intval(str_replace('BR-', '', $kodeBarang['kode_barang']));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'BR-' . $newNumber;
    }


    public function tambah()
    {
        $data = [
            'title' => 'Tambah Barang',
            'kategori' => $this->kategori->get_All(),
            'kode_barang' => $this->generateKodeBarang(),
        ];

        return view('Admin/Barang/tambah', $data);
    }

    public function simpan()
    {
        $gambar = $this->request->getFile('gambar');
        $gambar->move('./assets/gambar/');

        $data = [
            'kode_barang' => $this->request->getVar('kode_barang'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'harga' => $this->request->getVar('harga'),
            'berat' => $this->request->getVar('berat'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'gambar' => $gambar->getName(),
            'ketersediaan' => $this->request->getVar('ketersediaan'),
        ];

        $this->db->table('tbl_barang')->insert($data);

        if ($this->db->affectedRows() > 0) {
            return redirect()->to('/barang')->with('success', 'Data Berhasil Disimpan');
        }
    }

    public function delete($id_barang)
    {
        $this->db->table('tbl_barang')->where(['id_barang' => $id_barang])->delete();
        return redirect()->to('/barang')->with('success', 'Data Berhasil Dihapus');
    }

    public function edit($id_barang = null)
    {
        if ($id_barang != NULL) {
            $data = [
                'title' => 'Ubah Barang',
                'barang' => $this->barang->get_Barang($id_barang),
                'kategori' => $this->kategori->get_All(),
            ];
            return view('Admin/Barang/ubah', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id_barang)
    {
        $barang = $this->barang->get_Barang($id_barang);
        $gambar_Lama = $barang->gambar;

        $file = $this->request->getFile('gambar');
        if ($file->isValid() && !$file->hasMoved()) {
            if (!empty($barang->gambar) && file_exists('./assets/gambar/' . $barang->gambar)) {
                unlink('./assets/gambar/' . $barang->gambar);
            }

            $gambarName = $file->getRandomName();
            $file->move('./assets/gambar/', $gambarName);
        } else {
            $gambarName = $gambar_Lama;
        }

        $data = [
            'kode_barang' => $this->request->getVar('kode_barang'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'harga' => $this->request->getVar('harga'),
            'berat' => $this->request->getVar('berat'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'gambar' => $gambarName,
            'ketersediaan' => $this->request->getVar('ketersediaan'),
        ];

        unset($data['_method']);
        $this->db->table('tbl_barang')->where(['id_barang' => $id_barang])->update($data);
        return redirect()->to('/barang')->with('success', 'Data Berhasil Diupdate');
    }
}
