<?= $this->extend('Component/template_admin') ?>
<?= $this->section('content') ?>
<div class="col-sm-12">
    <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#pesanan_masuk" aria-selected="true">Pesanan Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#pesanan_diproses" aria-selected="false">Diproses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#pesanan_dikirim" aria-selected="false">Dikirim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#pesanan_selesai" aria-selected="false">Selesai</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pesanan_masuk" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th></th>
                        </tr>
                        <?php foreach ($pesanan as $value) { ?>
                            <tr>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->nama_penerima ?></td>
                                <td><?= $value->alamat ?><br>Provinsi : <?= $value->provinsi ?><br>Kode Pos : <?= $value->kode_pos ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td><b><?= $value->expedisi ?></b><br>Paket : <?= $value->paket ?><br>Ongkir : <?= number_format($value->ongkir, 0) ?></td>
                                <td><b>Rp.<?= number_format($value->total_bayar, 0) ?></b><br><?php if ($value->status_bayar == 0) { ?><span class="badge badge-warning">Belum Bayar</span><?php } else { ?><span class="badge badge-success">Sudah Bayar</span><br><span class="badge badge-primary">Menunggu Verifikasi</span><?php } ?></td>
                                <td><?php if ($value->status_bayar == 1) { ?><button class="btn btn-sm btn-success btn-flat" data-toggle="modal" data-target="#cek<?= $value->id_transaksi ?>">Cek Bukti Bayar</button>
                                        <form action="<?= base_url('/proses/' . $value->id_transaksi) ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="PUT">
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-sm">Proses</button>
                                        </form>
                                    <?php } ?><br>
                                    <a href="<?= base_url('/pesanan/' . $value->id_transaksi) ?>" class="btn btn-sm btn-primary btn-flat">Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="pesanan_diproses" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th></th>
                        </tr>
                        <?php foreach ($pesanan_diproses as $value) { ?>
                            <tr>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->nama_penerima ?></td>
                                <td><?= $value->alamat ?><br>Provinsi : <?= $value->provinsi ?><br>Kode Pos : <?= $value->kode_pos ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td><b><?= $value->expedisi ?></b><br>Paket : <?= $value->paket ?><br>Ongkir : <?= number_format($value->ongkir, 0) ?></td>
                                <td><b>Rp.<?= number_format($value->total_bayar, 0) ?></b><br><span class="badge badge-primary">Diproses/Dikemas</span></td>
                                <td><?php if ($value->status_bayar == 1) { ?>
                                        <button class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#kirim<?= $value->id_transaksi ?>"><i class="fa fa-paper-plane"></i> Kirim</button><?php } ?>
                                    <a href="<?= base_url('/pesanan/' . $value->id_transaksi) ?>" class="btn btn-sm btn-primary btn-flat">Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="pesanan_dikirim" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                    <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th>No Resi</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($pesanan_dikirim as $value) { ?>
                            <tr>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->nama_penerima ?></td>
                                <td><?= $value->alamat ?><br>Provinsi : <?= $value->provinsi ?><br>Kode Pos : <?= $value->kode_pos ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td><b><?= $value->expedisi ?></b><br>Paket : <?= $value->paket ?><br>Ongkir : <?= number_format($value->ongkir, 0) ?></td>
                                <td><b>Rp.<?= number_format($value->total_bayar, 0) ?></b><br><span class="badge badge-success">Dikirim</span></td>
                                <td>
                                    <h4><?= $value->no_resi ?></h4>
                                </td>
                                <td>
                                    <a href="<?= base_url('/pesanan/' . $value->id_transaksi) ?>" class="btn btn-sm btn-primary btn-flat">Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="pesanan_selesai" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                    <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th>No Resi</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($pesanan_selesai as $value) { ?>
                            <tr>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->nama_penerima ?></td>
                                <td><?= $value->alamat ?><br>Provinsi : <?= $value->provinsi ?><br>Kode Pos : <?= $value->kode_pos ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td><b><?= $value->expedisi ?></b><br>Paket : <?= $value->paket ?><br>Ongkir : <?= number_format($value->ongkir, 0) ?></td>
                                <td><b>Rp.<?= number_format($value->total_bayar, 0) ?></b><br><span class="badge badge-success">Diterima/Sampai</span></td>
                                <td>
                                    <h4><?= $value->no_resi ?></h4>
                                </td>
                                <td>
                                    <a href="<?= base_url('/pesanan/' . $value->id_transaksi) ?>" class="btn btn-sm btn-primary btn-flat">Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($pesanan as $value) { ?>
    <div class="modal fade" id="cek<?= $value->id_transaksi ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= $value->no_order ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th>Nama Bank</th>
                            <th>:</th>
                            <td><?= $value->nama_bank ?></td>
                        </tr>
                        <tr>
                            <th>No Rek</th>
                            <th>:</th>
                            <td><?= $value->no_rek ?></td>
                        </tr>
                        <tr>
                            <th>Atas Nama</th>
                            <th>:</th>
                            <td><?= $value->atas_nama ?></td>
                        </tr>
                        <tr>
                            <th>Total Bayar</th>
                            <th>:</th>
                            <td>Rp. <?= number_format($value->total_bayar, 0) ?></td>
                        </tr>
                    </table>
                    <img class="img-fluid pad" src="<?= base_url('assets/bukti_bayar/' . $value->bukti_bayar) ?>" alt="">
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php foreach ($pesanan_diproses as $value) { ?>
    <div class="modal fade" id="kirim<?= $value->id_transaksi ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= $value->no_order ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/kirim/' . $value->id_transaksi) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <th>Expedisi</th>
                                <th>:</th>
                                <th><?= $value->expedisi ?></th>
                            </tr>
                            <tr>
                                <th>Paket</th>
                                <th>:</th>
                                <th><?= $value->paket ?></th>
                            </tr>
                            <tr>
                                <th>Paket</th>
                                <th>:</th>
                                <th>Rp.<?= number_format($value->ongkir, 0) ?></th>
                            </tr>
                            <tr>
                                <th>No Resi</th>
                                <th>:</th>
                                <th><input name="no_resi" class="form-control" placeholder="No Resi" required></th>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<?= $this->endSection() ?>