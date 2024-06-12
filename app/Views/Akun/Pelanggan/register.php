<?= $this->extend('Component/template_pengunjung') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-sm-4">
        <div class=" register-box">
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Register Pelanggan Baru</p>
                    <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
                    <form action="<?= base_url('/simpan_akun') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="input-group mb-3">
                            <input type="text" name="kode_pelanggan" value="<?= $kode_pelanggan ?>" class="form-control" placeholder="Kode Pelanggan">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="nama_pelanggan" value="<?= set_value('nama_pelanggan') ?>" class="form-control" placeholder="Nama Pelanggan">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="ulangi_password" value="<?= set_value('ulangi_password') ?>" class="form-control" placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </div>
                    </form>

                    <a href="<?= base_url('pelanggan') ?>" class="text-center">Saya Sudah Punya Akun...!</a>
                </div>
                <!-- /.form-box -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>