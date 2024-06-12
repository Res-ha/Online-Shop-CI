<?= $this->extend('Component/template_admin') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
            <h3 class="card-title">Data Barang</h3>
            <div class="card-tools">
                <a href="<?= base_url('barang/tambah') ?>" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Ketersediaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($barang as $value) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= $value->kode_barang ?></td>
                            <td>
                                <?= $value->nama_barang ?><br>
                                Berat : <?= $value->berat ?> Gr
                            </td>
                            <td class="text-center"><?= $value->nama_kategori ?></td>
                            <td class="text-center">Rp. <?= number_format($value->harga, 0) ?></td>
                            <td class="text-center"><img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" width="150px"></td>
                            <td class="text-center"><?= $value->ketersediaan ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('barang/edit/' . $value->id_barang) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value->id_barang ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--modal delete -->
<?php foreach ($barang as $value) : ?>
    <div class="modal fade" id="delete<?= $value->id_barang ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Apakah Anda Yakin Ingin Menghapus Data Ini <?= $value->nama_barang ?>?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <form action="<?= base_url('/barang/' . $value->id_barang) ?>" method="post" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection() ?>