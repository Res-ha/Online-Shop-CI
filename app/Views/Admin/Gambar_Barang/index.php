<?= $this->extend('Component/template_admin') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Gambar Barang</h3>
        </div>
        <div class="card-body">
            <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Cover</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($gambarbarang as $value) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value->nama_barang ?></td>
                            <td class="text-center"><img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" width="100px"></td>
                            <td class="text-center"><span class="badge bg-primary">
                                    <h5><?= $value->total_gambar ?></h5>
                                </span></td>
                            <td class="text-center">
                                <a href="<?= base_url('gambar_barang/tambah/' . $value->id_barang) ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Gambar</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>