<?= $this->extend('Component/template_admin') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Add Gambar Barang : <?= $barang->nama_barang ?></h3>
		</div>
		<div class="card-body">
			<div id="flash" data-flash="<?= session()->getFlashdata('success') ?>"></div>

			<form action="<?= base_url('/gambar_barang/simpan/' . $barang->id_barang) ?>" method="post" enctype="multipart/form-data">
				<?= csrf_field() ?>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Ket Gambar</label>
							<input name="ket" class="form-control" placeholder="Ket Gambar" value="<?= set_value('ket') ?>">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Gambar</label>
							<input type="file" name="gambar" class="form-control" id="preview_gambar" accept="image/*" required>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<img src="<?= base_url('assets/gambar/nofoto.jpg') ?>" id="gambar_load" width="200px">
						</div>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
					<a href="<?= base_url('/gambar_barang') ?>" class="btn btn-success btn-sm">Kembali</a>
				</div>

			</form>

			<hr>
			<div class="row">
				<?php foreach ($gambar as $value) { ?>
					<div class="col-sm-3">
						<div class="form-group">
							<img src="<?= base_url('assets/gambarbarang/' . $value->gambar) ?>" id="gambar_load" width="250px" height="200px">
						</div>
						<p>Ket : <?= $value->ket ?></p>
						<button data-toggle="modal" data-target="#delete<?= $value->id_gambar ?>" class="btn btn-danger btn-xs btn-block"><i class="fas fa-trash"></i> Delete</button>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>


<?php foreach ($gambar as $value) { ?>
	<div class="modal fade" id="delete<?= $value->id_gambar ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete <?= $value->ket ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">

					<div class="form-group">
						<img src="<?= base_url('assets/gambarbarang/' . $value->gambar) ?>" id="gambar_load" width="250px" height="200px">
					</div>
					<h5>Apakah Anda Yakin Ingin Menghapus Gambar Ini...?</h5>


				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<form action="<?= base_url('/gambar_barang/' . $value->id_gambar) ?>" method="post" class="d-inline">
						<?= csrf_field() ?>
						<input type="hidden" name="_method" value="DELETE">
						<button type="submit" class="btn btn-primary">Delete</button>
					</form>
				</div>

			</div>
		</div>
	</div>
<?php } ?>


<script>
	function bacaGambar(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#gambar_load').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#preview_gambar").change(function() {
		bacaGambar(this);
	});
</script>
<?= $this->endSection() ?>