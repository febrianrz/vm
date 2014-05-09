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
<form class="form-horizontal" role="form" method="post" action="<?=base_url('all_access/daftarKelas')?>">
	<h1><strong style="font-size: 0.7em">Data Siswa</strong></h1>
	<div class="sub_form" id="data_siswa">
		<div class="form-group">
			<label for="nama" class="col-sm-4 control-label">Nama Siswa</label>
			<div class="col-sm-8">
				<input type="text" name="nama" class="form-control nama" id="" placeholder="Nama Siswa" required>
			</div>
		</div>
		<div class="form-group">
			<label for="nama" class="col-sm-4 control-label">Jenis Kelamin</label>
			<div class="col-sm-8">
				<div class="radio">
  					<label>
    					<input type="radio" name="jkel" id="optionsRadios2" value="L" checked="true" />Laki-Laki
  					</label>
				</div>
				<div class="radio">
  					<label>
    					<input type="radio" name="jkel" id="optionsRadios2" value="P" />Perempuan
  					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			
			<label for="tgl_lahir" class="col-sm-4 control-label">Tanggal Lahir</label>
			<div class="col-sm-8">
				<div id="">
					<input type="date" name="tgl_lahir" size="8" class="form-control" id="datepicker" value="01/01/1990" />
				</div>
    			<script>
    				
    			</script>
			<!--input class="easyui-datebox form-control" name="tgl_lahir" placeholder="Tanggal Lahir" style="width: 320px; height: 30px; border-radius: 10px" value="01/01/1990"/-->
				<!--div id="date2" class="datefield">
	    			<input id="day" type="tel" maxlength="2" placeholder="DD"/> /
				    <input id="month" type="tel" maxlength="2" placeholder="MM"/> /
				    <input id="year" type="tel" maxlength="4" placeholder="YYYY" />
				</div-->
			</div>
		</div>
		<div class="form-group">
			<label for="sekolah" class="col-sm-4 control-label">Asal Sekolah</label>
			<div class="col-sm-8">
				<input type="text" name="asal_sekolah" class="form-control sekolah" id="" placeholder="Asal Sekolah" required>
			</div>
		</div>
		<div class="form-group">
			<label for="telp" class="col-sm-4 control-label">Telepon</label>
			<div class="col-sm-8">
				<input type="number" name="telp" class="form-control" id="telp" maxlength="12" placeholder="Telepon" />
			</div>
		</div>
		<div class="form-group">
			<label for="Alamat" class="col-sm-4 control-label">Alamat</label>
			<div class="col-sm-8">
				<textarea name="alamat" class="form-control" style="resize: none" placeholder="Alamat"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="nama_wali" class="col-sm-4 control-label">Nama Wali</label>
			<div class="col-sm-8">
				<input type="text" name="nama_wali" class="form-control nama_wali" id="" placeholder="Nama Wali" required>
			</div>
		</div>
		<div class="form-group">
			<label for="telp_wali" class="col-sm-4 control-label">Telepon Wali</label>
			<div class="col-sm-8">
				<input type="number" name="telp_wali" class="form-control number" maxlength="12" id="telp_wali" placeholder="Telepon Wali" required>
				&nbsp;<span id="errmsg"></span>
			</div>
		</div>		
	</div><!--data siswa-->
	
	<button type="submit" class="btn btn-primary" style="float: right">Selanjutnya</button>
</form>
</div>
<script>
	$("#datepicker").datepicker({dateFormat: "dd/mm/yy"});
	$(document).ready(function () {
  		//called when key is pressed in textbox
  		$("#telp").keypress(function (e) {
     		//if the letter is not digit then display error and don't type anything
     		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        		//display error message
        		//$("#errmsg").html("Masukkan Angka").show().fadeOut("slow");
            	return false;
    		}
   		});
   		$("#telp_wali").keypress(function (e) {
     		//if the letter is not digit then display error and don't type anything
     		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        		//display error message
        		//$("#errmsg").html("Masukkan Angka").show().fadeOut("slow");
            	return false;
    		}
   		});
	});
		
	function ucwords(input) {
    	var words = input.split(/(\s|-)+/),
        output = [];

    	for (var i = 0, len = words.length; i < len; i += 1) {
        	output.push(words[i][0].toUpperCase() +
            	words[i].toLowerCase().substr(1));
    	}
    	return output.join('');
	}
	
	$("input").keyup(function() {
    	var cp_value= ucwords($(this).val(),true) ;
    	$(this).val(cp_value );
	});
</script>
<?php $this->load->view($footer)?>
