<?php

namespace App\Controllers;

use App\Models\m_Barang;
use App\Models\m_Kategori;
use App\Models\m_GambarBarang;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    public function __construct()
    {
        $this->gambar_barang = new m_GambarBarang();
        $this->barang = new m_Barang();
        $this->kategori = new m_Kategori();
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'barang' => $this->barang->get_All(),
            'kategori' => $this->kategori->get_All(),
            'cart' => \Config\Services::cart(),
        ];
        return view('home', $data);
    }

    public function detail_barang($id_barang)
    {
        $data = [
            'title' => 'Detail Barang',
            'barang' => $this->barang->get_Barang($id_barang),
            'gambar' => $this->gambar_barang->get_GambarBarang($id_barang),
            'kategori' => $this->kategori->get_All(),
            'cart' => \Config\Services::cart(),
        ];
        return view('Pengunjung/detail_barang', $data);
    }

    public function kategori($id_kategori)
    {
        $kategori = $this->kategori->get_Kategori($id_kategori);
        $data = [
            'title' => 'Kategori Barang : ' . $kategori->nama_kategori,
            'barang' => $this->kategori->get_KategoriBarang($id_kategori),
            'kategori' => $this->kategori->get_All(),
            'cart' => \Config\Services::cart(),
        ];
        return view('home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'barang' => $this->barang->get_All(),
            'kategori' => $this->kategori->get_All(),
            'cart' => \Config\Services::cart(),
        ];
        return view('about', $data);
    }
}
