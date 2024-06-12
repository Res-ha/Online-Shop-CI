<?= $this->extend('Component/template_admin') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
            <h3 class="card-title">Data Kategori</h3>
            <div class="card-tools">
                <button data-toggle="modal" data-target="#add" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kategori as $value) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $value->nama_kategori ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value->id_kategori ?>"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value->id_kategori ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/kategori/simpan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($kategori as $value) : ?>
    <div class="modal fade" id="edit<?= $value->id_kategori ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/kategori/update/' . $value->id_kategori) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama kategori</label>
                            <input type="text" name="nama_kategori" value="<?= $value->nama_kategori ?>" class="form-control" placeholder="Nama Kategori" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($kategori as $value) : ?>
    <div class="modal fade" id="delete<?= $value->id_kategori ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Apakah Anda Yakin Ingin Menghapus Data <?= $value->nama_kategori ?>?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <form action="<?= base_url('/kategori/' . $value->id_kategori) ?>" method="post" class="d-inline">
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