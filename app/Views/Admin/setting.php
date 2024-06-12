<?= $this->extend('Component/template_admin') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Setting Website</h3>
        </div>
        <div class="card-body">
            <div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>

            <form action="<?= base_url('/simpan_setting') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-control">
                                <?php foreach ($provinsi as $p) : ?>
                                    <option value="<?= $p->province_id ?>"><?= $p->province ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kabupaten/Kota</label>
                            <input name="id_kabupaten" id="id_kabupaten" hidden>
                            <select name="kabupaten" id="kabupaten" class="form-control">
                                <option>Pilih Kabupaten/kota</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Toko</label>
                            <input type="text" name="nama_toko" class="form-control" value="<?= $setting->nama_toko ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_telpon" value="<?= $setting->no_telpon ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat Toko</label>
                    <input type="text" name="alamat_toko" value="<?= $setting->alamat_toko ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-success btn-sm">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('document').ready(function() {
        $("#provinsi").on('change', function() {
            $("#kabupaten").empty();
            var id_province = $(this).val();
            $.ajax({
                url: "<?= base_url('kabupaten') ?>",
                type: 'GET',
                data: {
                    'id_province': id_province,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var results = data["rajaongkir"]["results"];
                    for (var i = 0; i < results.length; i++) {
                        $("#kabupaten").append($('<option>', {
                            value: results[i]["city_name"],
                            text: results[i]['city_name'],
                            id: results[i]['city_id'],
                        }));
                    }
                },
            });
        });
        $("#kabupaten").on('change', function() {
            var id_kabupaten = $('option:selected', this).attr('id');
            $("#id_kabupaten").val(id_kabupaten);
        });
    });
</script>
<?= $this->endSection() ?>