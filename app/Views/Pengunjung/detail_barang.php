<?= $this->extend('Component/template_pengunjung') ?>
<?= $this->section('content') ?>
<div class="card card-solid">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none"><?= $barang->nama_barang ?></h3>
                <div class="col-12">
                    <img src="<?= base_url('assets/gambar/' . $barang->gambar) ?>" class="product-image" alt="Product Image">
                    <?php foreach ($gambar as $gambar_barang) { ?>
                        <div class="product-image-thumb"><img src="<?= base_url('assets/gambarbarang/' . $gambar_barang->gambar) ?>" alt="Product Image"></div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-12 col-sm-6 mt-3">
                <table class="table">
                    <tr>
                        <td>Nama Produk</td>
                        <td><strong><?= $barang->nama_barang ?></strong></td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td><strong><?= $barang->nama_kategori ?></strong></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td><strong><?= $barang->deskripsi ?></strong></td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td><strong><?= $barang->ketersediaan ?></strong></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><strong>
                                <div class="btn btn-sm btn-success">
                                    <h4>Rp. <?php echo number_format($barang->harga, 0) ?>.00</h4>
                                </div>
                            </strong></td>
                    </tr>
                </table>
                <form action="<?= base_url('/belanja/simpan') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $barang->id_barang ?>">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" value="<?= $barang->harga ?>">
                    <input type="hidden" name="image" value="<?= $barang->gambar ?>">
                    <input type="hidden" name="weight" value="<?= $barang->berat ?>">
                    <input type="hidden" name="name" value="<?= $barang->nama_barang ?>">

                    <div class="mt-4">
                        <div class="row">
                            <div class="col-sm-2">
                                <input type="number" name="qty" class="form-control" value="1">
                            </div>
                            <div class=" col-sm-8">
                                <button type="submit" class="btn btn-primary btn-flat swalDefaultSuccess">
                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                    Tambah Ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>