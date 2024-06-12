<?= $this->extend('Component/template_pengunjung') ?>
<?= $this->section('content') ?>

<div class="invoice p-3 mb-3">
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-shopping-cart"></i> Checkout
                <small class="float-right">Date: <?= date('d-m-Y') ?></small>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th width="150px" class="text-center">Harga</th>
                        <th>Barang</th>
                        <th class="text-center">Total Harga</th>
                        <th class="text-center">Berat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $tot_berat = 0;
                    foreach ($cart->contents() as $value) {
                        $id = $value['id'];
                        $berat = $value['qty'] * $value['weight'];
                        $tot_berat = $tot_berat + $berat;
                    ?>
                        <input type="hidden" name="qty<?= $i++ ?>" value="<?= $value['qty'] ?>">
                        <tr>
                            <td><?= $value['qty']; ?></td>
                            <td class="text-center">Rp. <?= number_format($value['price'], 0); ?></td>
                            <td><?= $value['name']; ?></td>
                            <td class="text-center">Rp. <?= number_format($value['subtotal'], 0); ?></td>
                            <td class="text-center"><?= $berat ?> Gr</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <form action="<?= base_url('/belanja/cekout_barang') ?>" method="post" enctype="multipart/form-data">
        <?=
        csrf_field();
        $bytes = random_bytes(4);
        $no_order = date('Ymd') . strtoupper(bin2hex($bytes));
        ?>

        <?php
        $i = 1;
        foreach ($cart->contents() as $value) {
            echo form_hidden('qty' . $i++, $value['qty']);
        }
        ?>

        <input name="estimasi" id="estimasi" hidden>
        <input name="no_order" value="<?= $no_order ?>" hidden>
        <div class="row">
            <div class="col-sm-8 invoice-col">
                Tujuan :
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <select class="form-control" id="provinsi" name="provinsi">
                                <option>--Pilih Provinsi--</option>
                                <?php foreach ($provinsi as $p) : ?>
                                    <option value="<?= $p->province_id ?>"><?= $p->province ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten/Kota</label>
                            <select class="form-control" id="kabupaten" name="kota">
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Expedisi</label>
                            <input type="text" name="expedisi" value="JNE" readonly class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="service">Paket</label>
                            <select class="form-control" id="service" name="paket"></select>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Kode POS</label>
                            <input name="kode_pos" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Penerima</label>
                            <input name="nama_penerima" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>HP Penerima</label>
                            <input name="hp_penerima" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Grand Total:</th>
                            <input type="hidden" name="grand_total" value="<?= $cart->total(); ?>">
                            <th>Rp. <?= number_format($cart->total(), 0); ?></th>
                        </tr>
                        <tr>
                            <th>Berat:</th>
                            <input type="hidden" name="berat" value="<?= $tot_berat; ?>">
                            <th><?= $tot_berat ?> Gr</th>
                        </tr>
                        <tr>
                            <th>Ongkir:</th>
                            <input type="hidden" name="ongkir" id="input_ongkir">
                            <th><label id="ongkir"></label></th>
                        </tr>
                        <tr>
                            <th>Total Bayar:</th>
                            <input type="hidden" name="total_bayar" id="input_total_bayar">
                            <th><label id="total_bayar"></label></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row no-print">
            <div class="col-12">
                <a href="<?= base_url('/cek_keranjang') ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Kembali Ke Keranjang</a>
                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-shopping-cart"></i> Proses Cekout
                </button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var ongkir = 0;

    $(document).ready(function() {
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
                            value: results[i]["city_id"],
                            text: results[i]['city_name']
                        }));
                    }
                },
            });
        });

        $("#kabupaten").on('change', function() {
            var city_id = $(this).val();
            $.ajax({
                url: "<?= base_url('kota_asal') ?>",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var origin = response.origin;
                    console.log(response);
                    var kota_asal = response["origin"]["id_kabupaten"]
                    $.ajax({
                        url: "<?= base_url('ongkir') ?>",
                        type: 'GET',
                        data: {
                            'origin': kota_asal,
                            'destination': city_id,
                            'weight': 1000,
                            'courier': 'jne'
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            $("#service").empty();
                            var results = data["rajaongkir"]["results"][0]["costs"];
                            for (var i = 0; i < results.length; i++) {
                                var text = results[i]["description"] + "(" + results[i]["service"] + ")" + " | " + results[i]["cost"][0]["etd"] + " hari";
                                $("#service").append($('<option>', {
                                    value: results[i]["cost"][0]["value"],
                                    text: text,
                                    etd: results[i]["cost"][0]["etd"]
                                }));
                            }
                        },
                    });
                },
            });
        });

        $("#service").on('change', function() {
            var estimasi = $('option:selected', this).attr('etd');
            $("#estimasi").val(estimasi + " Hari");
            var ongkir = parseInt($(this).val());
            document.getElementById("input_ongkir").value = ongkir;
            $("#ongkir").text("Rp " + ongkir);
            var totalBayar = parseInt(<?= $cart->total() ?>) + ongkir;
            document.getElementById("input_total_bayar").value = totalBayar;
            $("#total_bayar").text("Rp " + totalBayar);
        });

    });
</script>

<?= $this->endSection() ?>