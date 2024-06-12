<?= $this->extend('Component/template_pengunjung') ?>
<?= $this->section('content') ?>
<div class="row" style="margin-bottom: 275px;">
    <div class="col-sm-12">
        <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#order" aria-selected="true">Order</a>
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
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="order-tab">
                        <table class="table">
                            <tr>
                                <th>No Order</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tanggal</th>
                                <th>Expedisi</th>
                                <th>Total Bayar</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach ($belum_bayar as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->no_order ?></td>
                                    <td><?= $value->nama_penerima ?></td>
                                    <td><?= $value->alamat ?></td>
                                    <td><?= $value->tgl_order ?></td>
                                    <td>
                                        <b><?= $value->expedisi ?></b><br>
                                        Paket : <?= number_format($value->paket, 0) ?><br>
                                        Ongkir : <?= number_format($value->ongkir, 0) ?>
                                    </td>
                                    <td>
                                        <b>Rp.<?= number_format($value->total_bayar, 0) ?></b><br>
                                        <?php if ($value->status_bayar == 0) { ?>
                                            <span class="badge badge-warning">Belum Bayar</span>
                                        <?php } else { ?>
                                            <span class="badge badge-success">Sudah Bayar</span><br>
                                            <span class="badge badge-primary">Menunggu Verifikasi</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($value->status_bayar == 0) { ?>
                                            <a href="<?= base_url('/bayar_pesanan_saya/' . $value->id_transaksi) ?>" class="btn btn-sm btn-flat btn-primary">Bayar</a>
                                        <?php } ?>
                                        <a href="<?= base_url('/detail_pesanan_saya/' . $value->id_transaksi) ?>" class="btn btn-sm btn-primary btn-flat">Detail</a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </table>
                    </div>
                    <div class="tab-pane fade" id="pesanan_diproses" role="tabpanel" aria-labelledby="pesanan_diproses-tab">
                        <table class="table">
                            <tr>
                                <th>No Order</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tanggal</th>
                                <th>Expedisi</th>
                                <th>Total Bayar</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach ($diproses as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->no_order ?></td>
                                    <td><?= $value->nama_penerima ?></td>
                                    <td><?= $value->alamat ?></td>
                                    <td><?= $value->tgl_order ?></td>
                                    <td>
                                        <b><?= $value->expedisi ?></b><br>
                                        Paket : <?= $value->paket ?><br>
                                        Ongkir : <?= number_format($value->ongkir, 0) ?>
                                    </td>
                                    <td>
                                        <b>Rp.<?= number_format($value->total_bayar, 0) ?></b><br>
                                        <span class="badge badge-success">Terverifikasi</span><br>
                                        <span class="badge badge-primary">Diproses/Dikemas</span>

                                    </td>
                                    <td><a href="<?= base_url('/detail_pesanan_saya/' . $value->id_transaksi) ?>" class="btn btn-sm btn-primary btn-flat">Detail</a></td>
                                </tr>
                            <?php } ?>

                        </table>

                    </div>
                    <div class="tab-pane fade" id="pesanan_dikirim" role="tabpanel" aria-labelledby="pesanan_dikirim-tab">
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
                            <?php foreach ($dikirim as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->no_order ?></td>
                                    <td><?= $value->nama_penerima ?></td>
                                    <td><?= $value->alamat ?></td>
                                    <td><?= $value->tgl_order ?></td>
                                    <td>
                                        <b><?= $value->expedisi ?></b><br>
                                        Paket : <?= $value->paket ?><br>
                                        Ongkir : <?= number_format($value->ongkir, 0) ?>
                                    </td>
                                    <td>
                                        <b>Rp.<?= number_format($value->total_bayar, 0) ?></b><br>
                                        <span class="badge badge-success">Dikirim</span><br>
                                    </td>
                                    <td>
                                        <h5><?= $value->no_resi ?><br>
                                            <button data-toggle="modal" data-target="#diterima<?= $value->id_transaksi ?>" class="btn btn-primary btn-xs btn-flat">Diterima</button>
                                        </h5>
                                    </td>
                                    <td><a href="<?= base_url('/detail_pesanan_saya/' . $value->id_transaksi) ?>" class="btn btn-sm btn-primary btn-flat">Detail</a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="pesanan_selesai" role="tabpanel" aria-labelledby="pesanan_selesai-tab">
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
                            <?php foreach ($selesai as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->no_order ?></td>
                                    <td><?= $value->nama_penerima ?></td>
                                    <td><?= $value->alamat ?></td>
                                    <td><?= $value->tgl_order ?></td>
                                    <td>
                                        <b><?= $value->expedisi ?></b><br>
                                        Paket : <?= $value->paket ?><br>
                                        Ongkir : <?= number_format($value->ongkir, 0) ?>
                                    </td>
                                    <td>
                                        <b>Rp.<?= number_format($value->total_bayar, 0) ?></b><br>
                                        <span class="badge badge-success">Selesai</span><br>
                                    </td>
                                    <td>
                                        <h5><?= $value->no_resi ?><br>
                                        </h5>
                                    </td>
                                    <td><a href="<?= base_url('/detail_pesanan_saya/' . $value->id_transaksi) ?>" class="btn btn-sm btn-primary btn-flat">Detail</a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($dikirim as $key => $value) { ?>
    <div class="modal fade" id="diterima<?= $value->id_transaksi ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url('/status_pesanan_saya/update/' . $value->id_transaksi) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-header">
                        <h4 class="modal-title">Pesanan Diterima</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda Yakin Pesanan Sudah Diterima...?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<?= $this->endSection() ?>