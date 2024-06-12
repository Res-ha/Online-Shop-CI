<?= $this->extend('Component/template_pengunjung_utama') ?>
<?= $this->section('content') ?>
<div class="card card-solid">
    <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
    <div class="card-body pb-0">
        <div class="row">
            <?php foreach ($barang as $value) { ?>
                <div class="col-sm-4">
                    <form action="<?= base_url('/belanja/simpan') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $value->id_barang ?>">
                        <input type="hidden" name="qty" value="1">
                        <input type="hidden" name="price" value="<?= $value->harga ?>">
                        <input type="hidden" name="image" value="<?= $value->gambar ?>">
                        <input type="hidden" name="weight" value="<?= $value->berat ?>">
                        <input type="hidden" name="name" value="<?= $value->nama_barang ?>">

                        <div class="card bg-light">
                            <div class="card-header text-muted border-bottom-0">
                                <h2 class="lead"><b><?= $value->nama_barang ?></b></h2>
                                <p class="text-muted text-sm"><b>Kategori : </b><?= $value->nama_kategori ?></p>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" width="300px" height="250px">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="text-left">
                                            <h4><span class="badge bg-primary">Rp. <?= number_format($value->harga, 0) ?></span></h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-right">
                                            <a href="<?= base_url('/detail_barang/' . $value->id_barang)  ?>" class="btn btn-sm btn-success">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
                                                <i class="fas fa-cart-plus"> Add</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>