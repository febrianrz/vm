<?=$this->load->view('root/easyui_load')?>
<center><h2>Kelas</h2></center>

<table id="dg" title="Kelas" class="easyui-datagrid" style="width:800px;height:310px"
url="<?=base_url() ?>root/index/jsonKelas"
toolbar="#toolbar" pagination="true"
rownumbers="true" fitColumns="true" singleSelect="true">
	<thead>
		<tr>
			<th field="id" width="50">Id Kelas</th>
			<th field="nama" width="50">Nama Kelas</th>
		</tr>
	</thead>
</table>
<div id="toolbar">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Tambah Kelas</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit Kelas</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Hapus Kelas</a>
</div>
<div id="dlg" class="easyui-dialog" style="width:400px;height:200px;padding:10px 20px"
closed="true" buttons="#dlg-buttons">
	<div class="ftitle">
		Kelas
	</div>
	<form id="fm" method="post" novalidate>
		<div class="fitem">
			<label>Nama Kelas:</label>
			<input name="nama" class="easyui-validatebox" required="true">
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
    <button class="btn btn-primary">Cetak Kelas</button>
  </div><!--end col 2-->
</div>
<script type="text/javascript">
	var url;
	function newUser() {
		$('#dlg').dialog('open').dialog('setTitle', 'New Kelas');
		$('#fm').form('clear');
		url = '<?php echo site_url('root/index/createKelas');?>';
	}

	function editUser() {
		var row = $('#dg').datagrid('getSelected');
		if (row) {
			$('#dlg').dialog('open').dialog('setTitle', 'Edit Kelas');
			$('#fm').form('load', row);
			url = '<?php echo site_url('root/index/updateKelas'); ?>/' + row.id;
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
					$.post("<?php echo site_url('root/index/hapusKelas/')?>", {id : row.id}, function(x) {
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