<?= $this->extend('Component/template_pengunjung') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-sm-4">
        <div class="register-box mt-5">
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Login Pelanggan</p>
                    <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
                    <form action="<?= base_url('/login') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
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

                        <div class="row">
                            <div class="col-8">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </div>

                        <a href="<?= base_url('/register') ?>" class="text-center">Belum Punya Akun...!</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>