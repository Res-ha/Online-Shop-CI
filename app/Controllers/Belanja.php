<?php

namespace App\Controllers;

use App\Models\m_Barang;
use App\Models\m_Kategori;

class Belanja extends BaseController
{
    private $url = "https://api.rajaongkir.com/starter/";
    private $apiKey = "226f2710b3ce664e03f17586fe058808";

    public function __construct()
    {
        $this->barang = new m_Barang();
        $this->kategori = new m_Kategori();
        $this->validation = \Config\Services::validation();
    }

    public function cek()
    {
        $cart = \Config\Services::cart();
        $response = $cart->contents();
        echo '<pre>';
        print_r($response);
        echo '<pre>';
    }

    public function view_cart()
    {
        $data = [
            'title' => 'Home',
            'barang' => $this->barang->get_All(),
            'kategori' => $this->kategori->get_All(),
            'cart' => \Config\Services::cart(),
        ];
        return view('Pengunjung/Belanja/keranjang', $data);
    }

    public function simpan()
    {
        $cart = \Config\Services::cart();

        $cart->insert(array(
            'id'      => $this->request->getVar('id'),
            'image'   => $this->request->getPost('image'),
            'weight'   => $this->request->getPost('weight'),
            'qty'     => $this->request->getVar('qty'),
            'price'   => $this->request->getVar('price'),
            'name'    => $this->request->getVar('name'),
        ));

        return redirect()->to('/')->with('success', 'Barang Masuk Keranjang');
    }

    public function drop()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to('/cek_keranjang')->with('success', 'Semua Barang Berhasil Dihapus Dari Keranjang');;
    }

    public function update()
    {
        $cart = \Config\Services::cart();
        $i = 1;
        foreach ($cart->contents() as $key => $value) {
            $cart->update(array(
                'rowid' => $key,
                'qty' => $this->request->getPost('qty')[$key]
            ));
        }
        return redirect()->to('/cek_keranjang')->with('success', 'Keranjang Berhasil Diupdate');
    }

    public function delete($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to('/cek_keranjang')->with('success', 'Barang Berhasil Dihapus');
    }

    public function cekout()
    {
        $provinsi = $this->rajaongkir('province');
        $this->validation->setRules([
            'provinsi' => 'required',
            'kota' => 'required',
            'expedisi' => 'required',
            'paket' => 'required'
        ], [
            'provinsi' => [
                'required' => 'Provinsi Harus Diisi !!!'
            ],
            'kota' => [
                'required' => 'Kota Harus Diisi !!!'
            ],
            'expedisi' => [
                'required' => 'Expedisi Harus Diisi !!!'
            ],
            'paket' => [
                'required' => 'Paket Harus Diisi !!!'
            ]
        ]);
        if (!$this->validation->run($_POST)) {
            $data = array(
                'title' => 'Cek Out Belanja',
                'cart' => \Config\Services::cart(),
                'kategori' => $this->kategori->get_All(),
                'provinsi' => json_decode($provinsi)->rajaongkir->results,
            );
            return view('Pengunjung/Belanja/cekout', $data);
        } else {
            $session = \Config\Services::session();
            $session->start();

            $data = array(
                'id_pelanggan' => $session->get('id_pelanggan'),
                'no_order' => $this->request->getPost('no_order'),                'no_order' => $this->request->getPost('no_order'),
                'tgl_order' => date('Y-m-d'),
                'nama_penerima' => $this->request->getPost('nama_penerima'),
                'hp_penerima' => $this->request->getPost('hp_penerima'),
                'provinsi' => $this->request->getPost('provinsi'),
                'kota' => $this->request->getPost('kota'),
                'alamat' => $this->request->getPost('alamat'),
                'kode_pos' => $this->request->getPost('kode_pos'),
                'expedisi' => $this->request->getPost('expedisi'),
                'paket' => $this->request->getPost('paket'),
                'estimasi' => $this->request->getPost('estimasi'),
                'ongkir' => $this->request->getPost('ongkir'),
                'berat' => $this->request->getPost('berat'),
                'grand_total' => $this->request->getPost('grand_total'),
                'total_bayar' => $this->request->getPost('total_bayar'),
                'status_bayar' => '0',
                'status_order' => '0',
            );
            $this->db->table('tbl_transaksi')->insert($data);
            $cart = \Config\Services::cart();
            $i = 1;
            foreach ($cart->contents() as $key => $value) {
                $data_rinci = array(
                    'no_order' => $this->request->getPost('no_order'),
                    'id_barang' => $value['id'],
                    'qty' => $this->request->getPost('qty' . $i++),
                    'nama_barang' => $value['name'],
                );
                $this->db->table('tbl_rinci_transaksi')->insert($data_rinci);
            }

            $cart->destroy();
            return redirect()->to('/pesanan_saya')->with('success', 'Barang Berhasil Dihapus');
        }
    }

    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGet('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }

    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');
            $data = $this->rajaongkircost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }

    private function rajaongkircost($origin, $destination, $weight, $courier)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey,
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;

        if ($id_province != null) {
            $endPoint = $endPoint . "?province=" . $id_province;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }
}
