<?=$this->load->view('root/easyui_load')?>
<center><h2>Biaya</h2></center>

<table id="dg" title="Biaya" class="easyui-datagrid" style="width:800px;height:310px"
url="<?=base_url() ?>root/index/jsonBiaya"
toolbar="#toolbar" pagination="true"
rownumbers="true" fitColumns="true" singleSelect="true">
	<thead>
		<tr>
			<th field="paket" width="50">Paket</th>
			<th field="total" width="50">Total Biaya</th>
			<th field="discount" width="50">Discount</th>
			<th field="dp" width="50">DP</th>
			<th field="cb" width="50">Cash Back</th>
			<th field="a_1" width="50">Angsuran 1</th>
			<th field="a_2" width="50">Angsuran 2</th>
			<th field="a_3" width="50">Angsuran 3</th>
			<th field="a_4" width="50">Angsuran 4</th>
		</tr>
	</thead>
</table>
<div id="toolbar">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Tambah Biaya</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit Biaya</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Hapus Biaya</a>
</div>
<div id="dlg" class="easyui-dialog" style="width:400px;height:450px;padding:10px 20px"
closed="true" buttons="#dlg-buttons">
	<div class="ftitle">
		Biaya
	</div>
	<form id="fm" method="post" novalidate>
		<div class="fitem" id="pkt">
			<label>Id Paket:</label>
			<select class="easyui-combobox" name="paket" id="paket">
				<?php
					foreach ($paket->result() as $key) {
						echo "<option value='$key->id_paket'>$key->nama_paket</option>";
					}
				?>
			</select>
		</div>
		<div class="fitem">
			<label>Total Biaya:</label>RP.
			<input name="total" class="easyui-validatebox">
		</div>
		<div class="fitem">
			<label>Discount:</label>RP.
			<input name="discount" class="easyui-validatebox">
		</div>
		<div class="fitem">
			<label>DP:</label>RP.
			<input name="dp" class="easyui-validatebox">
		</div>
		<div class="fitem">
			<label>Cash Back:</label>RP.
			<input name="cb" class="easyui-validatebox">
		</div>
		<div class="fitem">
			<label>Angsuran 1:</label>RP.
			<input name="a_1" class="easyui-validatebox">
		</div>
		<div class="fitem">
			<label>Angsuran 2:</label>RP.
			<input name="a_2" class="easyui-validatebox">
		</div>
		<div class="fitem">
			<label>Angsuran 3:</label>RP.
			<input name="a_3" class="easyui-validatebox">
		</div>
		<div class="fitem">
			<label>Angsuran 4:</label>RP.
			<input name="a_4" class="easyui-validatebox">
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
		$('#dlg').dialog('open').dialog('setTitle', 'New Biaya');
		$('#fm').form('clear');
		url = '<?php echo site_url('root/index/createBiaya');?>';
	}

	function editUser() {
		var row = $('#dg').datagrid('getSelected');
		if (row) {
			$("#pkt").prop("disabled", true);
			$('#dlg').dialog('open').dialog('setTitle', 'Edit Biaya');
			$('#fm').form('load', row);
			url = '<?php echo site_url('root/index/updateBiaya'); ?>/' + row.id;
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
					$.post("<?php echo site_url('root/index/hapusBiaya/')?>", {id : row.id}, function(x) {
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
    <button class="btn btn-primary">Cetak Biaya</button>
  </div><!--end col 2-->
</div>