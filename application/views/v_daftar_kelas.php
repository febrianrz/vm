<?php $this->load->view($header)?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/demo/demo.css" />
<script type="text/javascript" src="<?=base_url()?>asset/js/easyui/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/jquery-ui-1.10.4/themes/base/jquery.ui.all.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/daftarStyle.css" />
<script type="text/javascript" src="<?=base_url()?>asset/js/jquery-ui-1.10.4/ui/jquery-ui.js"></script>
<center>
	<h2><strong style="font-size: 2em">Form Pendaftaran</strong></h2>
	<br />
</center>
<div id="main" class="row">
<form class="form-horizontal" role="form" method="post" action="<?=base_url('all_access/daftarAdministrasi')?>">
	<h1><strong style="font-size: 0.7em">Data Kelas</strong></h1>
	<div class="sub_form" id="data_siswa">
		<div class="form-group">
			<label for="kelas" class="col-sm-4 control-label">Kelas</label>
			<div class="col-sm-8">
				<select name="kelas" class="form-control">
					<?php
						foreach ($kelas->result() as $key) {
							echo "<option value='$key->id_kelas'>$key->nama_kelas</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="kelas" class="col-sm-4 control-label">Jadwal</label>
			<div class="col-sm-8">
				<select name="jadwal" class="form-control">
					<?php
						foreach ($jadwal->result() as $key) {
							echo "<option value='$key->id_jadwal'>$key->hari : $key->jam</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="row-validasi">
			<div class=" col-sm-12">
				<input type="submit" class="btn btn-primary" style="float: right; margin-left: 1%" value="Selanjutnya"/>
				<input type="button" class="btn btn-primary" style="float: right" onclick="history.back()" value="Kembali"/>
			</div>
		</div>
	</div><!--data siswa-->
	
</form>
</div>
<script>
	
</script>
<?php $this->load->view($footer)?>
