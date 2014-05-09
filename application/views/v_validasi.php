<?php $this->load->view($header)?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/demo/demo.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/daftarStyle.css" />	
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/root.css" />
    
<script type="text/javascript" src="<?=base_url()?>asset/js/easyui/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/js/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/bootstrap-3.1.1-dist/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>
<center>
	<h2><strong style="font-size: 2em">Verifikasi</strong></h2>
	<br />
</center>
<script>
	location.hash='#no-';
      if(location.hash == '#no-'){
	location.hash='#_';
	window.onhashchange=function(){
      if(location.hash == '#no-')
      location.hash='#_';}}
</script>
<div id="main" class="row" style="">
	<div class="validasi" style="height: 600px">
		<form method="post" action="<?=base_url('all_access/inputSiswa')?>">
		<?php
			//foreach($this->session->all_userdata() as $key){
				//echo "$key\n";
			//}
		?>
		<span style="font-weight: bold; font-size: 1.6em">Data Siswa</span>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Nama
			</div>
			<div class="col-sm-8 baris">
				: <?=$this->session->userdata('nama')?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Jen.Kelamin
			</div>
			<div class="col-sm-8 baris">
				: <?=$jkel?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Tanggal Lahir
			</div>
			<div class="col-sm-8 baris">
				: <?=$tgl_lahir?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Asal Sekolah
			</div>
			<div class="col-sm-8 baris">
				: <?=$this->session->userdata('asal_sekolah')?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Telepon
			</div>
			<div class="col-sm-8 baris">
				: <?=$this->session->userdata('telp')?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Alamat
			</div>
			<div class="col-sm-8 baris">
				: <?=$this->session->userdata('alamat')?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Nama Wali
			</div>
			<div class="col-sm-8 baris">
				: <?=$this->session->userdata('nama_wali')?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Telepon Wali
			</div>
			<div class="col-sm-8 baris">
				: <?=$this->session->userdata('telp_wali')?>
			</div>
		</div>
		<div style="margin-top:30px">&nbsp;</div>
		<span style="font-weight: bold; font-size: 1.6em;">Data Kelas</span>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Kelas
			</div>
			<div class="col-sm-8 baris">
				: <?php echo $kelas?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Jadwal
			</div>
			<div class="col-sm-8 baris">
				: <?=$hari?>, <?=$jam?> WIB
			</div>
		</div>
		<div style="margin-top:30px">&nbsp;</div>
		<span style="font-weight: bold; font-size: 1.6em">Data Pembayaran</span>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Paket
			</div>
			<div class="col-sm-8 baris">
				: <?=$paket?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Pembayaran
			</div>
			<div class="col-sm-8 baris">
				: <?php
					if($this->session->userdata('bayar')=='' or $this->session->userdata('bayar') =='cash'){
						echo"Cash";
					} else {
						echo"Kredit" ;
					}
				  ?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
				Biaya
			</div>
			<div class="col-sm-8 baris">				
				: Rp. <?=number_format($biaya,2,',','.')?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php //echo $this->session->userdata('bayar')?>
			</div>
		</div>
		<div class="row-validasi">
			<div class="col-sm-4 baris" style="font-weight: bold">
			</div>
			<div class="col-sm-8 baris" style="padding-top: 20px">				
				<?php
					if($this->session->userdata('bayar') == '' or $this->session->userdata('bayar') == 'cash'){
						echo "&nbsp;&nbsp;<span style='font-size: 1.7em'>Lunas</span>";
					} else {
						echo "<br /><a href=\"".base_url('all_access/rincian_biaya')."\" style='text-decoration: underline; font-size: 0.7em'>Rincian</a>";
					}
				?>
			</div>
			
		</div>
		<div class="row-validasi">
			<div class=" col-sm-12">
				<br /><br />
				<input type="submit" class="btn btn-primary" style="float: right; margin-left: 1%; background-color: #882020; border-color: #95b8e7; box-shadow: 5px 5px 5px #882020;" value="Selesai"/>
				<input type="button" class="btn btn-primary" style="float: left; margin-left: 1%; background-color: #882020; border-color: #95b8e7; box-shadow: 5px 5px 5px #882020;" onclick="history.back()" value="Kembali"/>
			</div>
		</div>
	</div><!--validasi-->
</div><!--end main-->
<script>
	
</script>
<?php $this->load->view($footer)?>
