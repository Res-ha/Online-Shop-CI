<?php

namespace App\Controllers;

use App\Models\m_Dashboard;


class Dashboard extends BaseController
{
    private $url = "https://api.rajaongkir.com/starter/";
    private $apiKey = "226f2710b3ce664e03f17586fe058808";

    public function __construct()
    {
        $this->dashboard = new m_Dashboard();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'total_barang' => $this->dashboard->count_Tabel('tbl_barang'),
            'total_kategori' => $this->dashboard->count_Tabel('tbl_kategori'),
            'total_pesanan_masuk' => $this->dashboard->count_Tabel('tbl_transaksi'),
        ];
        return view('Admin/dashboard', $data);
    }

    public function setting()
    {
        $provinsi = $this->rajaongkir('province');

        $data = [
            'title' => 'Setting',
            'setting' => $this->db->table('tbl_setting')
                ->select('*')
                ->where('id', 1)
                ->get()->getRow(),
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
        ];
        return view('Admin/setting', $data);
    }

    public function simpan_setting()
    {
        $data = $this->request->getPost();
        unset($data['_method']);
        $this->db->table('tbl_setting')->where(['id' => 1])->update($data);
        return redirect()->to('/setting')->with('success', 'Data Berhasil Diupdate');
    }

    public function getcitystore()
    {
        $lokasi_asal = $this->db->table('tbl_setting')
            ->select('id_kabupaten')
            ->where('id', 1)
            ->get()->getRow();

        echo json_encode(['origin' => $lokasi_asal]);
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
