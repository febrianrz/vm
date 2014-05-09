<?=$this->load->view('root/easyui_load')?>
<center><h2>Biodata Siswa</h2></center>
	<table id="dg" title="My Users" class="easyui-datagrid" style="width:800px;height:310px"
			url="<?=base_url() ?>root/index/jsonSiswa"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="id" width="50">Id Siswa</th>
				<th field="nama_link" width="50">Nama</th>
				<th field="tgl_lahir" width="50">Tanggal Lahir</th>
				<th field="jenis_kelamin" width="50">Jenis Kelamin</th>
				<th field="sekolah" width="80">Sekolah</th>
				<th field="telepon" width="50">Telepon</th>
				<th field="wali" width="50">Nama Wali</th>
				<th field="telp_wali" width="50">Telepon Wali</th>
				<th field="alamat" width="50">Alamat</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Daftar</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit Siswa</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Hapus Siswa</a>
	</div>
	<div id="dlg" class="easyui-dialog" style="width:400px;height:350px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">
			Biodata Siswa
		</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label>Id Formulir:</label>
				<input name="id" class="easyui-validatebox" required="true">
			</div>
			<div class="fitem">
				<label>Nama:</label>
				<input name="nama" class="easyui-validatebox" required="true">
			</div>
			<div class="fitem">
				<label>Tanggal Lahir:</label>
				<input name="tgl_lahir" class="easyui-datebox">
				</input>
			</div>
			<div class="fitem">
				<label>Jenis Kelamin:</label>
				<input name="jenis_kelamin" class="easyui-datebox">
				</input>
			</div>
			<div class="fitem">
				<label>Sekolah:</label>
				<input name="sekolah" class="easyui-validatebox" required="true">
			</div>
			<div class="fitem">
				<label>Telepon:</label>
				<input name="telepon" class="easyui-validatebox" required="false">
			</div>
			<div class="fitem">
				<label>Wali:</label>
				<input name="wali" class="easyui-validatebox" required="true">
			</div>
			<div class="fitem">
				<label>Telepon Wali</label>
				<input name="telp_wali" class="easyui-validatebox" required="true">
			</div>
		</form>
	</div><!-- dialog-->
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
	</div>
	<br />
	<div class="row">
	  <div class="col-md-11">
	    <!--some code here tombol-->
	  </div><!--end col 10-->
	  <div class="col-md-1">
	    <button class="btn btn-primary">Cetak Siswa</button>
	  </div><!--end col 2-->
	</div>


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
		width: 30%;
	}
</style>

<script type="text/javascript">
	var url;
	function newUser() {
		window.location = "<?=base_url('all_access/daftar')?>"
	}

	function editUser() {
		var row = $('#dg').datagrid('getSelected');
		if (row) {
			$('#dlg').dialog('open').dialog('setTitle', 'Edit Siswa');
			$('#fm').form('load', row);
			url = '<?php echo site_url('root/index/updateSiswa'); ?>/' + row.id;
		}
		
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

	function destroyUser() {
		var row = $('#dg').datagrid('getSelected');
		if (row) {
			$.messager.confirm('Confirm', 'Apakah anda yakin ingin menghapus ?', function(r) {
				if (r) {
					$.post("<?php echo site_url('root/index/hapusSiswa/')?>", {id : row.id}, function(x) {
							if (x.success){
								$('#dg').datagrid('reload'); // reload the user data
							} else {
								$.messager.show({ // show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						}, 'json'
					);
				}
			});
		}
	}
</script>