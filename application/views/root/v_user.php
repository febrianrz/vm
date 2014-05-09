<?=$this->load->view('root/easyui_load')?>
<center><h2>User</h2></center>

<table id="dg" title="Jadwal" class="easyui-datagrid" style="width:800px;height:310px"
url="<?=base_url() ?>root/index/jsonUser"
toolbar="#toolbar" pagination="true"
rownumbers="true" fitColumns="true" singleSelect="true">
	<thead>
		<tr>
			<th field="nama_lengkap" width="50">Nama Lengkap</th>
			<th field="username" width="50">Username</th>
			<th field="level" width="50">Level</th>
			<th field="status" width="50">Status</th>
		</tr>
	</thead>
</table>
<div id="toolbar">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Tambah User</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Hapus User</a>
</div>
<div id="dlg" class="easyui-dialog" style="width:430px;height:300px;padding:10px 20px"
closed="true" buttons="#dlg-buttons">
	<div class="ftitle">
		User
	</div>
	<form id="fm" method="post" novalidate>
		<div class="fitem">
			<label>Nama Lengkap:</label>
			<input name="nama_lengkap" class="easyui-validatebox" required="true" />
		</div>
		<div class="fitem">
			<label>Username:</label>
			<input name="username" class="easyui-validatebox" required="true">
		</div>
		<div class="fitem">
			<label>Password:</label>
			<input type="password" name="password" class="easyui-validatebox" required="true">
		</div>
		<div class="fitem">
			<label>Re password:</label>
			<input type="password" name="re_password" class="easyui-validatebox" required="true">
		</div>
		<div class="fitem">
			<label>Level:</label>
			<select name="level" class="easyui-combobox" style="width: 150px">
			<?php
				$tmp = $level->result();
				foreach ($tmp as $row) {
					echo "<option value='$row->id_level'>$row->nama_level</option>";
				}
			?>
			</select>
		</div>
	</form>
</div><!-- dialog-->
<div id="dlg-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
</div>
<script type="text/javascript">
	var url;
	function newUser() {
		$('#dlg').dialog('open').dialog('setTitle', 'New Jadwal');
		$('#fm').form('clear');
		url = '<?php echo site_url('root/index/createUser');?>';
	}

	function editUser() {
		var row = $('#dg').datagrid('getSelected');
		if (row) {
			//alert(row.id);
			$('#dlg').dialog('open').dialog('setTitle', 'Edit User');
			$('#fm').form('load', row);
			url = '<?php echo site_url('root/index/updateUser'); ?>/' + row.id;
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
					$.post("<?php echo site_url('root/index/hapusUser/')?>", {id : row.id}, function(x) {
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
<br />
<div class="row">
  <div class="col-md-11">
    <!--some code here tombol-->
  </div><!--end col 10-->
  <div class="col-md-1">
    <button class="btn btn-primary">Cetak User</button>
  </div><!--end col 2-->
</div>