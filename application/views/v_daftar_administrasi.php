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
<form class="form-horizontal" role="form" method="post" action="<?=base_url('all_access/validasi')?>">
	<h1><strong style="font-size: 0.7em">Data Biaya</strong></h1>
	<div class="sub_form" id="data_siswa">
		<div class="form-group">
			<label for="kelas" class="col-sm-4 control-label">Paket</label>
			<div class="col-sm-8">
				<select name="paket" class="form-control" id="paket">
					<?php
						foreach ($paket->result() as $key) {
							echo "<option value='$key->id_paket'>$key->nama_paket</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="form-group bayar" style="">
			<label for="kelas" class="col-sm-4 control-label">Bayar</label>
			<div class="col-sm-8">
				<select name="bayar" class="form-control" id="id_bayar">
					<option value="cash">Cash</option>
					<option value="kredit">Kredit</option>
				</select>
			</div>
		</div>
		<div class="form-group biaya" style="">
			<!-- bagian biaya total biaya -->
			<label for="kelas" class="col-sm-4 control-label">Biaya</label>
			<?php
				//format rupiah
				function buatrp($angka) {
					$jadi = "Rp " . number_format($angka,2,',','.');
					return $jadi;
				}
			?>
			<div class="col-sm-8" id="priv" style="display: block">
				<?php
					foreach($biaya->result() as $key){
						if($key->id_paket != 1){
							continue;
						} else {
							echo "<strong style='font-size:2em'>Rp. ".number_format($key->total_biaya,2,',','.')."</strong>";
						}
					}
				?>
			</div>
			<div class="col-sm-8" id="stand_c" style="display: none">
			<?php
				// Jika membayar standar dan juga Cash
				
				foreach($biaya->result() as $key){
						if($key->id_paket != 2){
							continue;
						} else {
							echo "<strong style='font-size:2em'>Rp.".number_format($key->total_biaya,2,',','.')."</strong><br />";
							break;
						}
					}
				
			?>
			</div>
			<div class="col-sm-8" id="stand_k" style="display: none">
			<?php
				// Jika membayar standar dan juga kredit
				foreach($biaya->result() as $key){
						if($key->id_paket != 2){
							continue;
						} else {
							echo "<div class=''>";
								echo "<input type='radio' name='uang_muka' value='$key->id_biaya' id='um'/>DP: Rp. ".number_format($key->dp,2,',','.');
							echo "</div>";
							//echo "<strong style='font-size:2em'>Rp. $key->total_biaya</strong><br />";
							
						}
					}
			?>
			</div>
			<div class="col-sm-8" id="plus_c" style="display: none">
			<?php
				// Jika membayar standar dan juga Cash
				
				foreach($biaya->result() as $key){
						if($key->id_paket != 3){
							continue;
						} else {
							echo "<strong style='font-size:2em'>Rp. ".number_format($key->total_biaya,2,',','.')."</strong><br />";
							break;
						}
					}
				
			?>
			</div>
			<div class="col-sm-8" id="plus_k" style="display: none">
			<?php
				// Jika membayar standar dan juga kredit
				foreach($biaya->result() as $key){
						if($key->id_paket != 3){
							continue;
						} else {
							echo "<div class=''>";
								echo "<input type='radio' name='uang_muka' value='$key->id_biaya' id='um'/>DP: Rp. ".number_format($key->dp,2,',','.');
							echo "</div>";
							//echo "<strong style='font-size:2em'>Rp. $key->total_biaya</strong><br />";
							
						}
					}
			?>
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
	$(document).ready(function(){
		$("#id_bayar").prop("disabled", true);
	});
	$('#paket').change(function(){
		var paket = $('#paket option:selected').val();
		var bayar = $('#id_bayar option:selected').val();
		//alert(bayar);
		
		//jika paket private setelah utak atik
		if(paket == 1){
			$('#id_bayar').val('cash');
			$("#id_bayar").prop("disabled", true);
			$('#priv').slideDown();
			//hapus biaya lain
			$('#stand_c').slideUp();
			$('#stand_k').slideUp();
			$('#plus_c').slideUp();
			$('#plus_k').slideUp();
			
			//hapus radio button
			$("input:radio").attr("checked", false);
		} else if(paket == 2){
			//Jika paket bukan private
			stand_c();
			
		} else if(paket == 3){
			plus_c();
		}
		
		//jika paket standar dan cash
		
		
		
		//alert(val1);
		//if(val1 == 1){
			//$('#id_bayar').val('cash');
			//$("#id_bayar").prop("disabled", true);
			//$('#priv').slideUp();
			//$('#id_biaya_2').slideDown();
			//$('.bayar').slideUp();
		//} else if(val1 == 2){
			//alert(val1);
			//$("#id_bayar").prop("disabled", false);
			//$('.bayar').slideDown();
		//}
	});
	
	$('#id_bayar').change(function(){
		var paket = $('#paket option:selected').val();
		var bayar = $('#id_bayar option:selected').val();
		if((paket == 2) && (bayar == 'cash')){
			$("input:radio").attr("checked", false);
			$('#plus_c').slideUp();
			$('#plus_k').slideUp();	
			$('#stand_c').slideDown();
			$('#stand_k').slideUp();	
		} else if((paket == 2) && (bayar == 'kredit')){
			//$('input:radio').prop("checked", true);
			$('#plus_c').slideUp();
			$('#plus_k').slideUp();	
			$('#stand_k').slideDown();
			$('#stand_c').slideUp();
		}
		
		if((paket == 3) && (bayar == 'cash')){
			$("input:radio").attr("checked", false);
			$('#plus_c').slideDown();
			$('#plus_k').slideUp();	
			$('#stand_c').slideUp();
			$('#stand_k').slideUp();	
		} else if((paket == 3) && (bayar == 'kredit')){
			$('input:radio[name="uang_muka"]').attr('checked', 'checked');
			$('#plus_c').slideUp();
			$('#plus_k').slideDown();	
			$('#stand_k').slideUp();
			$('#stand_c').slideUp();
		}
	});
	
	function stand_c(){
		$("input:radio").attr("checked", false);
		$("#id_bayar").prop("disabled", false);
		$('#id_bayar').val('cash');
		$('#stand_c').slideDown();
		$('#priv').slideUp();
		$('#stand_k').slideUp();
		$('#plus_c').slideUp();
		$('#plus_k').slieUp();
	}
	
	function plus_c(){
		$("input:radio").attr("checked", false);
		$("#id_bayar").prop("disabled", false);
		$('#id_bayar').val('cash');
		$('#priv').slideUp();
		$('#stand_k').slideUp();
		$('#stand_c').slideUp();
		$('#plus_c').slideDown();
		$('#plus_k').slieUp();
	}
</script>
<?php $this->load->view($footer)?>
