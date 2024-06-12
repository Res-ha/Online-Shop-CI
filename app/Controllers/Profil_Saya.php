<?php

namespace App\Controllers;

use App\Models\m_Transaksi;
use App\Models\m_Kategori;
use App\Models\m_Pesanan;

class Profil_Saya extends BaseController
{

    public function __construct()
    {
        $this->transaksi = new m_Transaksi();
        $this->kategori = new m_Kategori();
        $this->pesanan = new m_Pesanan();
    }

    public function index($id_pelanggan = null)
    {
        if ($id_pelanggan != NULL) {
            $data = array(
                'title' => 'Profil Saya',
                'kategori' => $this->kategori->get_All(),
                'cart' => \Config\Services::cart(),
                'profil' => $this->db->table('tbl_pelanggan')
                    ->where('id_pelanggan', $id_pelanggan)
                    ->get()
                    ->getRow(),
            );
            return view('Pengunjung/Profil_Saya/index', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id_pelanggan)
    {
        $data = $this->request->getPost();
        unset($data['_method']);
        $this->db->table('tbl_pelanggan')->where(['id_pelanggan' => $id_pelanggan])->update($data);
        return redirect()->to('/profil_saya/' . $id_pelanggan)->with('success', 'Data Berhasil Diupdate');
    }
}
