<?= $this->extend('Component/template_admin') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
            <h3 class="card-title">Data Rekening Bank</h3>
            <div class="card-tools">
                <button data-toggle="modal" data-target="#add" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Bank</th>
                        <th>No Rekening</th>
                        <th>Atas Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($rekening as $value) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $value->nama_bank ?></td>
                            <td><?= $value->no_rek ?></td>
                            <td><?= $value->atas_nama ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value->id_rekening ?>"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value->id_rekening ?>"><i class="fas fa-trash"></i></button>
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
                <h4 class="modal-title">Add Rekening</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/rekening/simpan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <input type="text" name="nama_bank" class="form-control" placeholder="Nama Bank" required>
                    </div>
                    <div class="form-group">
                        <label>No Rekening</label>
                        <input type="text" name="no_rek" class="form-control" placeholder="No Rekening" required>
                    </div>
                    <div class="form-group">
                        <label>Atas Nama</label>
                        <input type="text" name="atas_nama" class="form-control" placeholder="Atas Nama" required>
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

<?php foreach ($rekening as $value) : ?>
    <div class="modal fade" id="edit<?= $value->id_rekening ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Rekening</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/rekening/update/' . $value->id_rekening) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <input type="text" name="nama_bank" class="form-control" value="<?= $value->nama_bank ?>" required>
                        </div>
                        <div class="form-group">
                            <label>No Rekening</label>
                            <input type="text" name="no_rek" class="form-control" value="<?= $value->no_rek ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Atas Nama</label>
                            <input type="text" name="atas_nama" class="form-control" value="<?= $value->atas_nama ?>" required>
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

<?php foreach ($rekening as $value) : ?>
    <div class="modal fade" id="delete<?= $value->id_rekening ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Apakah Anda Yakin Ingin Menghapus Data <?= $value->nama_bank ?>?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <form action="<?= base_url('/rekening/' . $value->id_rekening) ?>" method="post" class="d-inline">
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