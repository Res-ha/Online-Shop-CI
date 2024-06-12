<?php

namespace App\Controllers;

use App\Models\m_Laporan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->laporan = new m_Laporan();
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan Penjualan',
        ];

        return view('Admin/Laporan/index', $data);
    }

    public function laporan_harian()
    {
        $tanggal = $this->request->getPost('tanggal');
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $data = [
            'title' => 'Laporan Penjualan Harian',
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->laporan->get_LaporanHarian($tanggal, $bulan, $tahun),
        ];
        return view('Admin/Laporan/waktu_laporan', $data);
    }

    public function laporan_bulanan()
    {
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $data = [
            'title' => 'Laporan Penjualan Harian',
            'tanggal' => '',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->laporan->get_LaporanBulanan($bulan, $tahun),
        ];
        return view('Admin/Laporan/waktu_laporan', $data);
    }

    public function laporan_tahunan()
    {
        $tahun = $this->request->getPost('tahun');
        $data = [
            'title' => 'Laporan Penjualan Harian',
            'tanggal' => '',
            'bulan' => '',
            'tahun' => $tahun,
            'laporan' => $this->laporan->get_LaporanTahunan($tahun),
        ];
        return view('Admin/Laporan/waktu_laporan', $data);
    }
}
