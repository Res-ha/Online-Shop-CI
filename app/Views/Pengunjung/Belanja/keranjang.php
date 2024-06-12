<?= $this->extend('Component/template_pengunjung') ?>
<?= $this->section('content') ?>

<div class="card card-solid" style="margin-bottom: 260px;">
    <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
    <div class="card-body pb-0">
        <div class="row">
            <div class="col-sm-12">
                <form action="<?= base_url('/update_keranjang') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <table class="table" cellpadding="6" cellspacing="1" style="width:100%">
                        <tr>
                            <th width="100px">QTY</th>
                            <th>Nama Barang</th>
                            <th style="text-align:right">Harga</th>
                            <th style="text-align:right">Sub-Total</th>
                            <th style="text-align:center">Berat</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <?php
                        $i = 1;
                        $tot_berat = 0;
                        foreach ($cart->contents() as $value) {
                            $id = $value['id'];
                            $berat = $value['qty'] * $value['weight'];

                            $tot_berat = $tot_berat + $berat;
                        ?>
                            <tr>
                                <td>
                                    <input type="number" name="qty[<?= $value['rowid'] ?>]" min="1" class="form-control" value="<?= $value['qty'] ?>">
                                </td>
                                <td><?= $value['name']; ?></td>
                                <td style="text-align:right">Rp. <?= number_format($value['price'], 0); ?></td>
                                <td style="text-align:right">Rp. <?= number_format($value['subtotal'], 0); ?></td>
                                <td class="text-center"><?= $berat  ?> Gr</td>
                                <td class="text-center">
                                    <a href="<?= base_url('/delete_barang/' . $value['rowid']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                            <?php $i++; ?>

                        <?php } ?>

                        <tr>
                            <td class="right">
                                <h3>Total :</h3>
                            </td>
                            <td class="right">
                                <h3>Rp. <?= number_format($cart->total(), 0); ?></h3>
                            </td>
                            <th>Total Berat : <?= $tot_berat ?> Gr</th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                    </table>

                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Update Cart</button>
                    <a href="<?= base_url('/belanja/drop') ?>" class="btn btn-danger btn-flat"><i class="fa fa-recycle"></i> Clear Cart</a>
                    <a href="<?= base_url('/belanja/cekout')  ?>" class="btn btn-success btn-flat"><i class="fa fa-check-square"></i> Check Out</a>
                    <?= form_close(); ?>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>