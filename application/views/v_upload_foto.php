<?php $this->load->view($header)?>
<style>
	.frame {
		border: 1px solid;
		border-radius: 10px;
		width: 500px;
		padding: 10px;
	}
	.bingkai {
		border: 1px solid;
		width: 90%;
		min-height: 150px;
		background-image:url("<?=base_url()?>asset/image/user-icon.png");
		background-size:130px 150px;
		background-repeat:no-repeat;
	}
</style>
<!--script type="text/javascript" src="<?=base_url('asset/js/jquery-2.1.0.min.js')?>"></script-->
<script type="text/javascript" src="<?=base_url('asset/js/AjaxFileUploaderV2.1/jquery.js')?>"></script>
<script type="text/javascript" src="<?=base_url('asset/js/AjaxFileUploaderV2.1/ajaxfileupload.js')?>"></script>

<!--main-->
<div class="main" style="padding: 20px">
	<center>
		<h2>Upload Foto</h2>
	</center>
	<div class="frame" style="margin: 0 auto;">
		<h2 style="margin: 0; text-align: center">Kartu Tanda Anggota</h2>
		<h2 style="margin: 0; text-align: center">Villa Merah</h2><hr />
		<div class="row" style="padding: 0">
			<div class="col-md-7" style="font-size: 1.2em">
				<div class="col-md-5" style="font-size: 1em; padding:0; font-weight: bold">
					NIS  <br />
					Kelas <br />
					Nama <br />
					Tanggal Lahir <br />
					Alamat <br />
				</div>
				<div class="col-md-6" style="font-size: 1em; padding:0 ">
					: <?php echo $this->session->userdata('id_new')?><br />
					: <?php echo $kelas?><br />
					: <?php echo $siswa?><br />
					: <?php echo $tgl_lahir?><br />
					: <?php echo $alamat?><br />
				</div>							
			</div>
			<div class="col-md-5">
				<div class="bingkai">
					<div id="loading"></div>
				</div>
				
					<input type="file" name="userfile" id="userfile" onchange="upload()" style="visibility: hidden"/>
					<!--rogress id="progressBar" value="0" max="100" style="width: 100%"></progress-->
					<input type="submit" name="submit" value="Unggah" id="submit" class="btn btn-default"/>
				
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 30px">
		<center>
			<button type="submit" class="btn btn-primary" style="" onclick="selesai()">Selesai</button>
		</center>
	</div>
</div>
	
		<!--bagian upload foto-->
		<script>
			//ketika gambar diklik
			function selesai(){
				window.location = "<?php echo base_url('all_access/success')?>";
			}
			
			function foto(){
				$('#userfile').click();
			}
			
			$(function() {
				var tmp = "";
    			$('#submit').click(function(e) {
        			//e.preventDefault();
        			foto();
    			});
			});
			
			function upload(){
				var tmp ="";
				$.ajaxFileUpload({
        			url             :'<?=base_url('all_access/do_upload/')?>',
            		beforeSend		:function(xhr){
        				$("#loading").html("<img src='<?=base_url('asset/image/ajax-loader.gif')?>'>");
        			},
            		secureuri       :false,
            		fileElementId   :'userfile',
            		dataType        :'json',
            		success : function (data, status) {
                		if(data.status == 'bisa'){
                   			//alert(data.msg);
                   			tmp = data.msg;
                		} else {
                			alert(data.msg);
                		}
                		//alert(data);
            		}, error : function (data, status) {
            			alert(data.msg);
            		}, complete : function(){
            			var sp = tmp.split(".");
            			//alert(sp[1]);
            			var add = "<img src='<?=base_url('asset/image/siswa')?>/" + sp[0] + "_thumb." + sp[1] + "' />";
            			$(".bingkai").html(add);
            				//alert(add);
            			}
        			});
        		return false;
		
			}
			location.hash='#no-';
if(location.hash == '#no-'){
	location.hash='#_';
	window.onhashchange=function(){
      if(location.hash == '#no-')
      	location.hash='#_';
      }
    }			
		</script>
		<!--akhir upload foto-->
		<!--akhir main-->
		
		<!--bagian footer-->
		<?=$this->load->view($footer)?>
		<!--akhir footer-->
	</body>
</html>