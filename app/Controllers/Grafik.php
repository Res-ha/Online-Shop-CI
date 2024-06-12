<?php

namespace App\Controllers;

use App\Models\Grafik_m;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Grafik extends BaseController
{
    public function __construct()
    {
        $this->grafik = new Grafik_m();
    }

    public function keuangan()
    {
        $bulan_awal = $this->request->getPost('bulan_awal');
        $bulan_akhir = $this->request->getPost('bulan_akhir');
        $status = $this->request->getPost('status');

        $simpananData = $this->grafik->simpananData($bulan_awal, $bulan_akhir);

        $pinjamanData = $this->grafik->pinjamanData($bulan_awal, $bulan_akhir, $status);

        $statusPinjamanData = [
            'Lunas' => $this->grafik->getStatusPinjaman('Lunas', $bulan_awal, $bulan_akhir),
            'Belum Lunas' => $this->grafik->getStatusPinjaman('Belum Lunas', $bulan_awal, $bulan_akhir),
        ];

        $data = [
            'title' => 'Grafik Keuangan',
            'menu' => 'Buku Kas Umum',
            'submenu' => 'Grafik Keuangan',
            'pinjamanData' => json_encode($pinjamanData),
            'statusPinjamanData' => json_encode($statusPinjamanData),
            'simpananData' => json_encode($simpananData),
        ];

        return view('Bendahara/Grafik/keuangan', $data);
    }

    public function anggota()
    {
        $statusData = [
            'Aktif' => $this->grafik->countStatus('Aktif'),
            'Tidak Aktif' => $this->grafik->countStatus('Tidak Aktif'),
        ];
        $genderData = [
            'Laki - Laki' => $this->grafik->countGender('Laki - Laki'),
            'Perempuan' => $this->grafik->countGender('Perempuan'),
        ];

        $fakultasData = $this->grafik->countFakultas();

        $data = [
            'title' => 'Grafik Anggota',
            'menu' => 'Buku Kas Umum',
            'submenu' => 'Grafik Anggota',
            'statusData' => $statusData,
            'genderData' => $genderData,
            'fakultasData' => json_encode($fakultasData),
        ];

        $this->data = [];

        return view('Bendahara/Grafik/anggota', $data, $this->data);
    }
}
