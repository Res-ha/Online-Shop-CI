<?= $this->extend('Component/template_admin') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data User</h3>

            <div class="card-tools">
                <button data-toggle="modal" data-target="#add" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</button>
            </div>
        </div>
        <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
        <div class="card-body">
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($user as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $value->nama_user ?></td>
                            <td class="text-center"><?= $value->username ?></td>
                            <td class="text-center"><?= $value->password ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value->id_user ?>"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/user/simpan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama user</label>
                        <input type="text" name="nama_user" class="form-control" placeholder="Nama user" required>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Passsword" required>
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

<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value->id_user ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/user/update/' . $value->id_user) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label>Nama User</label>
                            <input type="text" name="nama_user" value="<?= $value->nama_user ?>" class="form-control" placeholder="Nama user" required>
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" value="<?= $value->username ?>" class="form-control" placeholder="Nama user" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" value="<?= $value->password ?>" class="form-control" placeholder="Nama user" required>
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
<?php } ?>
<?= $this->endSection() ?>