<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\m_Kategori;
use App\Models\m_Pelanggan;

class Akun extends BaseController
{

    public function __construct()
    {
        $this->kategori = new m_Kategori();
        $this->pelanggan = new m_Pelanggan();
    }

    public function generateKodePelanggan()
    {
        $kodePelanggan = $this->pelanggan->getKodePelanggan();
        $currentDate = date('Ymd');

        if ($kodePelanggan) {
            $parts = explode('-', $kodePelanggan['kode_pelanggan']);

            if (isset($parts[1])) {
                $lastNumber = intval($parts[1]);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
        } else {
            $newNumber = 1;
        }

        return 'PLG-' . $newNumber . '-' . $currentDate;
    }


    public function register()
    {
        $data = [
            'title' => 'Register Pelanggan',
            'kategori' => $this->kategori->get_All(),
            'kode_pelanggan' => $this->generateKodePelanggan(),
            'cart' => \Config\Services::cart(),
        ];
        return view('Akun/Pelanggan/register', $data);
    }


    public function simpan()
    {
        $data = [
            'kode_pelanggan' => $this->request->getPost('kode_pelanggan'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];
        $this->db->table('tbl_pelanggan')->insert($data);
        if ($this->db->affectedRows() > 0) {
            return redirect()->to('/pelanggan')->with('success', 'Data Berhasil Disimpan');
        }
    }

    public function pelanggan()
    {
        $data = [
            'title' => 'Login',
            'kategori' => $this->kategori->get_All(),
            'cart' => \Config\Services::cart(),
        ];
        return view('Akun/Pelanggan/login', $data);
    }

    public function proses_login_pelanggan()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $cekAkun = $this->db->table('tbl_pelanggan')
            ->where([
                'email' => $email,
                'password' => $password,
            ])->get()->getRowArray();
        if ($cekAkun) {
            $data = [
                'id_pelanggan' => $cekAkun['id_pelanggan'],
                'email' => $cekAkun['email'],
                'nama_pelanggan' => $cekAkun['nama_pelanggan'],
            ];

            session()->set($data);
            return redirect()->to(base_url('/'));
        } else {
            session()->setFlashdata('pesan', 'Username / Level / Password Salah  !!!');
            return redirect()->to(base_url('/pelanggan'));
        }
    }

    public function logout_pelanggan()
    {
        session()->remove(['id_pelanggan', 'email', 'nama_pelanggan']);
        return redirect()->to(base_url('/pelanggan'))->with('success', 'Berhasil Logout !!!');
    }

    public function admin()
    {
        $data = [
            'title' => 'Login',
            'kategori' => $this->kategori->get_All(),
            'cart' => \Config\Services::cart(),
        ];
        return view('Akun/Admin/login', $data);
    }

    public function proses_login_admin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $cekAkun = $this->db->table('tbl_user')
            ->where([
                'username' => $username,
                'password' => $password,
            ])->get()->getRowArray();
        if ($cekAkun) {
            $data = [
                'id_user' => $cekAkun['id_user'],
                'username' => $cekAkun['username'],
                'nama_user' => $cekAkun['nama_user'],
            ];

            session()->set($data);
            return redirect()->to(base_url('/dashboard'));
        } else {
            session()->setFlashdata('pesan', 'Username / Level / Password Salah  !!!');
            return redirect()->to(base_url('/admin'));
        }
    }

    public function logout_admin()
    {
        session()->remove(['id_user', 'username', 'nama_user']);
        return redirect()->to(base_url('/admin'))->with('success', 'Berhasil Logout !!!');
    }
}
