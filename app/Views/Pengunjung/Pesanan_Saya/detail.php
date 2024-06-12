<?= $this->extend('Component/template_pengunjung') ?>
<?= $this->section('content') ?>
<table class="table">
    <tr>
        <th width="200px">No Order</th>
        <th>:</th>
        <th><?= $transaksi->no_order ?></th>
    </tr>
    <tr>
        <th>Nama</th>
        <th>:</th>
        <th><?= $transaksi->nama_penerima ?></th>
    </tr>
    <tr>
        <th>Alamat</th>
        <th>:</th>
        <th><?= $transaksi->alamat ?></th>
    </tr>
    <tr>
        <th>No Telpon</th>
        <th>:</th>
        <th><?= $transaksi->hp_penerima ?></th>
    </tr>
    <tr>
        <th>Total Bayar</th>
        <th>:</th>
        <th>Rp. <?= number_format($transaksi->total_bayar, 0) ?></th>
    </tr>

    <tr>
        <th>Status Pesanan</th>
        <th>:</th>
        <th><?php
            if ($transaksi->status_order == 0) {
                echo '<b>Belum Dikirim</b>';
            } elseif ($transaksi->status_order == 1) {
                echo '<b>Diproses</b>';
            } elseif ($transaksi->status_order == 2) {
                echo '<b>Pesanan Dikirim</b>';
            } else {
                echo '<b>Pesanan Diterima</b';
            }
            ?></th>
    </tr>

</table>

<table class="table table-bordered">
    <tr class="text-center">
        <th>No</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Total Harga</th>
    </tr>
    <?php $no = 1;
    foreach ($barang as $key => $value) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $value->nama_barang ?></td>
            <td><?= $value->harga ?></td>
            <td><?= $value->qty ?></td>
            <td><?php
                $total_harga = $value->harga * $value->qty;
                echo $total_harga;
                ?></td>
        </tr>
    <?php } ?>
</table>
<h3>Grand Total : <?= $transaksi->grand_total ?></h3>
<?= $this->endSection() ?>