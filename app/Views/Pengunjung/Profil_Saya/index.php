<?= $this->extend('Component/template_pengunjung') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h1 class="card-title text-center"><?= $profil->nama_pelanggan ?></h1>
            </div>
            <div class="card-body">
                <div class="table-wrapper">
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td><?= $profil->nama_pelanggan ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $profil->email ?></td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <td><?= $profil->bank ?></td>
                        </tr>
                        <tr>
                            <th>No Rekening</th>
                            <td><?= $profil->no_rek ?></td>
                        </tr>
                    </table>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $profil->id_pelanggan ?>"><i class="fa fa-edit"></i>Edit</button>
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">About Me</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-auto pr-0">
                        <i class="fa fa-map"></i>
                    </div>
                    <div class="col">
                        <h5 class="card-title font-weight-bold mb-0">Provinsi</h5>
                    </div>
                </div>
                <p class="card-text"><?= $profil->provinsi ?></p>
                <div class="row">
                    <div class="col-auto pr-0">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="col">
                        <h5 class="card-title font-weight-bold mb-0">Kota</h5>
                    </div>
                </div>
                <p class="card-text"><?= $profil->kota ?></p>
                <div class="row">
                    <div class="col-auto pr-0">
                        <i class="fa fa-street-view"></i>
                    </div>
                    <div class="col">
                        <h5 class="card-title font-weight-bold mb-0">Alamat</h5>
                    </div>
                </div>
                <p class="card-text"><?= $profil->alamat ?></p>
                <div class="row">
                    <div class="col-auto pr-0">
                        <i class="fa fa-file"></i>
                    </div>
                    <div class="col">
                        <h5 class="card-title font-weight-bold mb-0">Kode Pos</h5>
                    </div>
                </div>
                <p class="card-text"><?= $profil->kode_pos ?></p>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="edit<?= $profil->id_pelanggan ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Pelanggan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/profil_saya/update/' . $profil->id_pelanggan) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" value="<?= $profil->nama_pelanggan ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="<?= $profil->email ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" value="<?= $profil->password ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input type="text" name="no_hp" value="<?= $profil->no_hp ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <input type="text" name="bank" value="<?= $profil->bank ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No Rekening</label>
                        <input type="text" name="no_rek" value="<?= $profil->no_rek ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi" value="<?= $profil->provinsi ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <input type="text" name="kota" value="<?= $profil->kota ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" value="<?= $profil->alamat ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" value="<?= $profil->kode_pos ?>" class="form-control" required>
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
<?= $this->endSection() ?>