<!--Bagian Header-->
<?=$this->load->view($header)?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/demo/demo.css" />
<script type="text/javascript" src="<?=base_url()?>asset/js/easyui/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/js/easyui/jquery.easyui.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/root.css" />
<!--AKhir bagian header-->
<script>
	$(document).ready(function(){
		$.ajax({
			url:"<?php base_url('all_access/json_siswa/').$id;?>",
			dataType:"json",
			type:"post",
			data:"req='true'",
			success:function(data){
				//alert(data.id);
				//alert(Object.keys(data).length);
				//var ln = Object.keys()
				//for(var i = 0; i <= data.length; i++){
					//$("table tr td:last-child").append("tes");
				//}
				$("span.id_siswa").append(data.id);
				$("span.nama").append(data.nama);
				$("span.tgl_lahir").append(data.tgl_lahir);
				$("span.jkel").append(data.jkel);
				$("span.sekolah").append(data.sekolah);
				$("span.telp").append(data.telp);
				$("span.kelas").append(data.kelas);
				$("span.paket").append(data.paket);
				$("div.foto").append("<img src='<?=base_url('asset/image/siswa')?>/"+data.foto+"' />");
				//$("div fieldset:nth-child(2)").append(data.username);
				//$("div fieldset:nth-child(3)").append(data.level);
				//$("div .foto_user").append(tmp);
			},
			error:function(){
				alert("Maaf, terjadi masalah pada saat parsing data");
			}
		});
	});
</script>
		<!--bagian body-->
		<div class="main">
			<center><h1 style="font-weight: bold">Data Siswa<hr /></h1></center>
			<div class="row" style="padding-left: 20px">
				<div class="col-md-5" style="font-size: 1.2em">
					<div class="row">
					<div class="col-md-5" style="font-size: 1.2em; font-weight: bold">
						ID Siswa	 <br />
						Nama Siswa	 <br />
						Tanggal Lahir<br />
						Jenis Kelamin<br />
					</div>
					<div class="col-md-7" style="font-size: 1.2em; padding: 0">
						
						: <span class="id_siswa"></span><br />
						: <span class="nama"></span><br />
						: <span class="tgl_lahir"></span><br />
						: <span class="jkel"></span><br />
					</div>	
					</div><!--end row datasiswa1-->
				</div>
				<div class="col-md-4" style="font-size: 1.2em">
					<div class="row">
						<div class="col-md-5" style="font-size: 1.2em; font-weight: bold">
							Asal Sekolah  <br />
							Telepon		 <br />
							Kelas		 <br />
							Paket		 <br />
						</div>
						<div class="col-md-7" style="font-size: 1.2em; padding: 0">
							: <span class="sekolah"></span><br />
							: <span class="telp"></span><br />
							: <span class="kelas"></span><br />
							: <span class="paket"></span><br />
						</div>
					</div>
				</div>
				<div class="col-md-3" style="font-size: 1.2em">
					<div class="foto" style="border: 1px solid; width: 75%">
						
					</div>
				</div>
			</div>
			<!--tabel rincian biaya-->
			<div class="tabel_rincian" style="padding: 20px">
			<table border=1 class="table">
				<tr>
					<th></th>
					<th>Angsuran 1</th>
					<th>Angsuran 2</th>
					<th>Angsuran 3</th>
					<th>Angsuran 4</th>
				</tr>
				<tr>
					<th>Biaya</th>
					<td>100</td>
					<td>100</td>
					<td>100</td>
					<td>100</td>
				</tr>
				<tr>
					<th>Status</th>
					<td>N</td>
					<td>N</td>
					<td>N</td>
					<td>N</td>
				</tr>
			</table>
			</div><br />
			<center><button class="btn btn-primary" onclick="history.back()">Kembali</button></center>
		</div><!--akhir main-->
		<!--akhir bagian body-->
		<!--Bagian Footer-->
		<?=$this->load->view($footer)?>
		<!--Akhir bagian footer-->

</html>