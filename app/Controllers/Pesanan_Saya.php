<?php

namespace App\Controllers;

use App\Models\m_Transaksi;
use App\Models\m_Kategori;
use App\Models\m_Pesanan;

class Pesanan_Saya extends BaseController
{

    public function __construct()
    {
        $this->transaksi = new m_Transaksi();
        $this->kategori = new m_Kategori();
        $this->pesanan = new m_Pesanan();
    }

    public function index()
    {
        $data = [
            'title' => 'Pesanan Saya',
            'belum_bayar' => $this->transaksi->status_Transaksi(0),
            'diproses' => $this->transaksi->status_Transaksi(1),
            'dikirim' => $this->transaksi->status_Transaksi(2),
            'selesai' => $this->transaksi->status_Transaksi(3),
            'kategori' => $this->kategori->get_All(),
            'cart' => \Config\Services::cart(),
        ];

        return view('Pengunjung/Pesanan_Saya/index', $data);
    }

    public function bayar($id_transaksi)
    {
        $data = [
            'title' => 'Pembayaran',
            'pesanan' => $this->pesanan->detail_transaksi($id_transaksi),
            'rekening' => $this->transaksi->rekening(),
            'cart' => \Config\Services::cart(),
            'kategori' => $this->kategori->get_All(),
        ];
        return view('Pengunjung/Pesanan_Saya/bayar', $data);
    }

    public function update_bayar($id_transaksi)
    {
        $gambar = $this->request->getFile('bukti_bayar');
        $name = $gambar->getRandomName();
        $gambar->move('./assets/bukti_bayar/', $name);
        $data = array(
            'id_transaksi' => $id_transaksi,
            'atas_nama' => $this->request->getPost('atas_nama'),
            'nama_bank' => $this->request->getPost('nama_bank'),
            'no_rek' => $this->request->getPost('no_rek'),
            'status_bayar' => '1',
            'bukti_bayar'    => $name,
        );
        unset($data['_method']);
        $this->db->table('tbl_transaksi')->where(['id_transaksi' => $id_transaksi])->update($data);
        return redirect()->to('/pesanan_saya')->with('success', 'Foto Berhasil Di Upload !!!');
    }


    public function diterima($id_transaksi)
    {
        $data = [
            'id_transaksi' => $id_transaksi,
            'status_order' => '3'
        ];
        unset($data['_method']);
        $this->db->table('tbl_transaksi')->where(['id_transaksi' => $id_transaksi])->update($data);
        return redirect()->to('/pesanan_saya')->with('success', 'Pesanan Telah diterima !!!');
    }

    public function detail($id_transaksi)
    {
        $data = array(
            'title' => 'Detail Pesanan Masuk',
            'kategori' => $this->kategori->get_All(),
            'cart' => \Config\Services::cart(),
            'transaksi' => $this->pesanan->detail_transaksi($id_transaksi),
            'barang' => $this->pesanan->detail_barang($id_transaksi),
        );

        return view('Pengunjung/Pesanan_Saya/detail', $data);
    }
}
