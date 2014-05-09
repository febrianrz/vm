<?php 
	if(!$this->session->userdata('login'))
		show_404();
	//header
	$this->load->view($page);
?>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/daftarStyle.css" />	
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/root.css" />
    
<script type="text/javascript" src="<?=base_url()?>asset/js/easyui/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/js/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/bootstrap-3.1.1-dist/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url('asset/js/AjaxFileUploaderV2.1/jquery.js')?>"></script>
<script type="text/javascript" src="<?=base_url('asset/js/AjaxFileUploaderV2.1/ajaxfileupload.js')?>"></script>

<style>
	.user {
		width: 100%;
		padding: 2% 3% 2% 3%;
		
	}
	.foto_user {
		float: left;
		padding: 5% 0 5% 0;
		width: 100%;
		border: 1px solid;
		margin-right: 5%;
		height: 30%;
	}
	
	.foto_user img {
		width: 100%;
		height: 100%;
	}
		
	.bio_table{
		
		width: 30%;
	}
	
	.bio_table tr td{
		width: 0.2%;
	}
		
</style>

<script>
	$(document).ready(function(){
		$.ajax({
			url:"<?=base_url('all_access/getDataUser')?>",
			dataType:"json",
			type:"post",
			data:"req='true'",
			success:function(data){
				//alert(data.nama);
				//alert(Object.keys(data).length);
				//var ln = Object.keys()
				//for(var i = 0; i <= data.length; i++){
					//$("table tr td:last-child").append("tes");
				//}
				$("div fieldset:nth-child(1)").append(data.nama);
				$("div fieldset:nth-child(2)").append(data.username);
				$("div fieldset:nth-child(3)").append(data.level);
				var tmp = "<img src='<?=base_url('asset/image/user')?>/"+data.foto+"' />";
				$("div .foto_user").append(tmp);
			},
			error:function(){
				alert("Maaf, terjadi masalah pada saat parsing data");
			}
		});
	});
</script>

<div class='container' style="padding: 5%">
	
	<div class="user">
		<div class="col-md-3">
			<div class="foto_user">
				
				<!--img src="<?=base_url('asset/image/user_foto.png')?>" alt="tes"/-->
				
			</div>
			<input type="file" name="userfile" onchange="upload()" id="userfile" style="visibility: hidden"/>
			<input type="submit" class="btn btn-default" value="Unggah" id="unggah"/>
		</div>
		<div class="col-md-9">
			<center><h2>Keterangan User</h2></center>
			<div class="data_user">
				<div class="row">
					<div class="col-md-4" style="font-weight: bold">
						Nama Lengkap<br />
						Username<br />
						Level<br />
					</div>
					<div class="col-md-5">
						<fieldset></fieldset>
						<fieldset></fieldset>
						<fieldset></fieldset>
					</div>
				</div>
				
			</div>
			<center style="margin-top: 10%">
				<button type="button" class="btn btn-primary" onclick="editUser()">Ubah Password</button>
			</center>
		</div><!-- col 9-->
		
		<div class="clear"></div>
	</div>
	<div id="dlg" class="easyui-dialog" style="width:400px;height:200px;padding:10px 20px"
		closed="true" buttons="#dlg-buttons">
	<form id="fm" method="post" novalidate>
		<div class="fitem">
			<label>Password Saat Ini</label>
			<input type="password" name="cu_password" class="easyui-validatebox" required="true">
		</div>
		<div class="fitem">
			<label>Password Baru</label>
			<input type="password" name="new_password" class="easyui-validatebox" required="true">
		</div>
		<div class="fitem">
			<label>Re-Password Baru</label>
			<input type="password" name="re_password" class="easyui-validatebox" required="true">
		</div>
	</form>
</div><!-- dialog-->
<div id="dlg-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Ubah</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
</div>
	
</div>




<script type="text/javascript">
	var url;
	function editUser() {
		$('#dlg').dialog('open').dialog('setTitle', 'Ubah Password');
		$('#fm').form('clear');
		url = '<?php echo site_url('profile/updatePassword');?>';
		
	}

	function saveUser() {
		$('#fm').form('submit', {
			url : url,
			onSubmit : function() {
				return $(this).form('validate');
			},
			success : function(result) {
				var x = eval ("(" + result + ")")
				if(x.success){
					alert('Password berhasil diubah');
					$('#dlg').dialog('close'); // close the dialog
					$('#dg').datagrid('reload');
				} else {
					 $.messager.show({
						title: 'Error',
						msg: x.msg
					});
				}
			}
		});
	}
	
	function pilihFoto(){
		$("#userfile").click();
	}
	
	$(function(){
		$("#unggah").click(function(e){
			//alert("hai");
			pilihFoto();
		});
	});
	
	function upload(){
		var tmp = "";        			
        		$.ajaxFileUpload({
            		url             :'<?=base_url('all_access/do_upload_user/')?>',
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
            					alert("emang gagal");
            					//alert(data.msg);
            		}, complete : function(){
            					var sp = tmp.split(".");
            					//alert(sp[1]);
            					var add = "<img src='<?=base_url('asset/image/user')?>/" + sp[0] + "_thumb." + sp[1] + "' />";
            					$(".foto_user").html(add);
            					//alert(add);
            		}
        		});
        		return false;
	}
</script>
<style>
	<style type="text/css">
	#fm {
		margin: 0;
		padding: 10px 30px;
	}
	.ftitle {
		font-size: 14px;
		font-weight: bold;
		padding: 5px 0;
		margin-bottom: 10px;
		border-bottom: 1px solid #ccc;
	}
	.fitem {
		margin-bottom: 5px;
	}
	.fitem label {
		display: inline-block;
		width: 40%;
	}
</style>

<?php //footer
	$this->load->view('root/v_footer');
?>