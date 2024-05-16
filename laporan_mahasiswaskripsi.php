<?php
session_start();
if (!isset($_SESSION["Email"])) {
	header("location:index.php");
}
?>
<?php
include("db.php");
include("header.php");
include("menu.php");
?>
<div id="page-wrapper" style="padding-top: 2rem;">
	<link rel="stylesheet" type="text/css" href="tag.css">
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="jquery.form.js"></script>
	<script>
		$(document).ready(function() {
			$('form').ajaxForm(function() {
				alert("Uploaded SuccessFully");
			});
		});

		function preview_image() {
			var total_file = document.getElementById("upload_file").files.length;
			for (var i = 0; i < total_file; i++) {
				$('#image_preview').append("<imgsrc='" + URL.createObjectURL(event.target.files[i]) + "'><br>");
			}
		}
	</script>
	<div class="panel panel-primary">
		<div class=" panel-heading">
			<h3 class="panel-title">Laporan Mahasiswa / Skripsi</h3>
		</div>
		<div class="panel-body">
			<div class="border border-dark">
				<form action=laporan_mahasiswaskripsiexec.php method=post enctype='multipart/form-data'>
					<div style="margin-bottom: 2rem;">
						<label for="TanggalAwal" class="form-label">Tanggal Awal</label>
						<input type="date" class="form-control" name="TanggalAwal" id="TanggalAwal" aria-describedby="emailHelp" required>
					</div>
					<div style="margin-bottom: 2rem;">
						<label for="TanggalAkhir" class="form-label">Tanggal Akhir</label>
						<input type="date" class="form-control" name="TanggalAkhir" id="TanggalAkhir" required>
					</div>
					<div style="margin-bottom: 2rem;">
						<label for="All" class="form-label">Print Semua Data</label>
						<select name="All" class="form-control" required>
							<option selected disabled>-- Pilih --</option>
							<option value="Tidak" selected="">Tidak</option>
							<option value="Ya">Ya</option>
						</select>
					</div>
					<button class="btn btn-primary" name="send_image">Proses</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>