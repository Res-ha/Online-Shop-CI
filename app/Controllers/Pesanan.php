<?php

namespace App\Controllers;

use App\Models\m_Pesanan;

class Pesanan extends BaseController
{

    public function __construct()
    {
        $this->pesanan = new m_Pesanan();
    }

    public function index()
    {
        $data = [
            'title' => 'Barang',
            'pesanan' => $this->pesanan->status_Pesanan(0),
            'pesanan_diproses' => $this->pesanan->status_Pesanan(1),
            'pesanan_dikirim' => $this->pesanan->status_Pesanan(2),
            'pesanan_selesai' => $this->pesanan->status_Pesanan(3),
            'detail_masuk' => $this->pesanan->detail_Masuk(),
        ];

        return view('Admin/Pesanan/index', $data);
    }

    public function detail_pesanan($id_transaksi)
    {
        $data = [
            'title' => 'Detail Pesanan Masuk',
            'transaksi' => $this->pesanan->detail_transaksi($id_transaksi),
            'barang' => $this->pesanan->detail_barang($id_transaksi),
        ];

        return view('Admin/Pesanan/detail', $data);
    }

    public function proses_pesanan($id_transaksi)
    {
        $data = [
            'status_order' => '1'
        ];

        unset($data['_method']);
        $this->db->table('tbl_transaksi')->where(['id_transaksi' => $id_transaksi])->update($data);
        return redirect()->to('/pesanan')->with('success', 'Data sedang Di Proses/Dikemas');
    }

    public function kirim_pesanan($id_transaksi)
    {
        $data = [
            'no_resi' => $this->request->getVar('no_resi'),
            'status_order' => '2'
        ];

        unset($data['_method']);
        $this->db->table('tbl_transaksi')->where(['id_transaksi' => $id_transaksi])->update($data);
        return redirect()->to('/pesanan')->with('success', 'Data sedang Di Kirim');
    }
}
