<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login Admin dan Pelanggan
$routes->get('/admin', 'Akun::admin');
$routes->post('/login_admin', 'Akun::proses_login_admin');
$routes->get('/logout_admin', 'Akun::logout_admin');

$routes->get('/pelanggan', 'Akun::pelanggan');
$routes->get('/register', 'Akun::register');
$routes->post('/simpan_akun', 'Akun::simpan');
$routes->post('/login', 'Akun::proses_login_pelanggan');
$routes->get('/logout', 'Akun::logout_pelanggan');
$routes->get('/about', 'Home::about');

//Dashboard Admin
$routes->get('/dashboard', 'Dashboard::index');

//Kategori
$routes->get('/kategori', 'Kategori::index');
$routes->post('/kategori/simpan', 'Kategori::simpan');
$routes->put('/kategori/update/(:any)', 'Kategori::update/$1');
$routes->delete('/kategori/(:num)', 'Kategori::delete/$1');

//Barang
$routes->get('/barang', 'Barang::index');
$routes->delete('/barang/(:num)', 'Barang::delete/$1');
$routes->get('/barang/tambah', 'Barang::tambah');
$routes->post('/barang/simpan', 'Barang::simpan');
$routes->get('/barang/edit/(:num)', 'Barang::edit/$1');
$routes->put('/barang/update/(:any)', 'Barang::update/$1');

//Gambar Barang
$routes->get('/gambar_barang', 'Gambar_Barang::index');
$routes->delete('/gambar_barang/(:num)', 'Gambar_Barang::delete/$1');
$routes->get('/gambar_barang/tambah/(:num)', 'Gambar_Barang::tambah/$1');
$routes->post('/gambar_barang/simpan/(:any)', 'Gambar_Barang::simpan/$1');

//Pesanan Masuk (Admin)
$routes->get('/pesanan', 'Pesanan::index');
$routes->get('/pesanan/(:num)', 'Pesanan::detail_pesanan/$1');
$routes->put('/proses/(:any)', 'Pesanan::proses_pesanan/$1');
$routes->put('/kirim/(:any)', 'Pesanan::kirim_pesanan/$1');

//Laporan
$routes->get('/laporan', 'Laporan::index');
$routes->post('/laporan_harian', 'Laporan::laporan_harian');
$routes->post('/laporan_bulanan', 'Laporan::laporan_bulanan');
$routes->post('/laporan_tahunan', 'Laporan::laporan_tahunan');

//Setting
$routes->put('/simpan_setting', 'Dashboard::simpan_setting');
$routes->get('/setting', 'Dashboard::setting');

//Rekening
$routes->get('/rekening', 'Rekening::index');
$routes->post('/rekening/simpan', 'Rekening::simpan');
$routes->put('/rekening/update/(:any)', 'Rekening::update/$1');
$routes->delete('/rekening/(:num)', 'Rekening::delete/$1');

//User
$routes->get('/user', 'user::index');
$routes->post('/user/simpan', 'user::simpan');
$routes->put('/user/update/(:any)', 'user::update/$1');
$routes->delete('/user/(:num)', 'user::delete/$1');

//Halaman Awal
$routes->get('/', 'Home::index');
$routes->get('/detail_barang/(:num)', 'Home::detail_barang/$1');
$routes->get('/kategori_barang/(:any)', 'Home::kategori/$1');

//Belanja
$routes->post('/belanja/simpan', 'Belanja::simpan');
$routes->get('/belanja/drop', 'Belanja::drop');
$routes->post('/update_keranjang', 'Belanja::update');
$routes->get('/delete_barang/(:any)', 'Belanja::delete/$1');
$routes->get('/cek_keranjang', 'Belanja::view_cart');
$routes->get('/belanja/cekout', 'Belanja::cekout');
$routes->post('/belanja/cekout_barang', 'Belanja::cekout');

//Profil Saya (Pelanggan)
$routes->get('/profil_saya/(:num)', 'Profil_Saya::index/$1');
$routes->put('/profil_saya/update/(:any)', 'Profil_Saya::update/$1');

//Pesanan Saya (Pelanggan)
$routes->get('/pesanan_saya', 'Pesanan_Saya::index');
$routes->get('/detail_pesanan_saya/(:any)', 'Pesanan_Saya::detail/$1');
$routes->get('/bayar_pesanan_saya/(:any)', 'Pesanan_Saya::bayar/$1');
$routes->put('/bayar_pesanan_saya/update/(:any)', 'Pesanan_Saya::update_bayar/$1');
$routes->put('/status_pesanan_saya/update/(:any)', 'Pesanan_Saya::diterima/$1');

//Raja Ongkir
$routes->get('kabupaten', 'Dashboard::getcity');
$routes->get('ongkir', 'Dashboard::getcost');
$routes->get('kota_asal', 'Dashboard::getcitystore');
