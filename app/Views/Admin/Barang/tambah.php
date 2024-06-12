<?= $this->extend('Component/template_admin') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Add Barang</h3>
        </div>
        <form action="<?= base_url('/barang/simpan') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="form-group">
                    <label>Kode Barang</label>
                    <input name="kode_barang" class="form-control" placeholder="Kode Barang" value="<?= $kode_barang ?>">
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input name="nama_barang" class="form-control" placeholder="Nama Barang" value="<?= set_value('nama_barang') ?>">
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="id_kategori" class="form-control">
                                <option value="">--Pilih Kategori--</option>
                                <?php foreach ($kategori as $key => $value) { ?>
                                    <option value="<?= $value->id_kategori ?>"><?= $value->nama_kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Harga</label>
                            <input name="harga" class="form-control" placeholder="Harga Barang" value="<?= set_value('harga') ?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Berat (Gr)</label>
                            <input type="number" name="berat" min="0" class="form-control" placeholder="Berat Dalam Satuan Gram" value="<?= set_value('berat') ?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Ketersediaan Stok :</label>
                            <select name="ketersediaan" id="ketersediaan" class="form-control">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Habis">Habis</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Barang</label>
                    <textarea name="deskripsi" class="form-control" rows="5" placeholder="Deskripsi Barang"><?= set_value('deskripsi') ?></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control" id="preview_gambar" accept="image/*" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="<?= base_url('/barang') ?>" class="btn btn-success btn-sm">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>