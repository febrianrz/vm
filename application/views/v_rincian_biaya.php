<?php $this->load->view($header)?>
<script>
	$.getJSON('<?=base_url('all_access/getRincian');?>', function(data) {
       $.each(data.rows, function(i, f) {
          var tblRow = "<tr>" + "<td>" + f.paket + "</td>" + "<td>" + f.total + "</td>" + 
           "<td>" + f.discount + "</td>" + "<td>" + f.dp + "</td>" + "<td>" + f.cb + "</td>" +
           "<td>" + f.a_1 + "</td>" + "<td>" + f.a_2 + "</td>" + "<td>" + f.a_3 + "</td>" + "<td>" + f.a_4 + "</td>" + "</tr>"
           $(tblRow).appendTo("#userdata tbody");
     });
	
   });
</script>

<style>
	#userdata th{
		width: 150px;
		font-size: 1.2em;
		padding: 10px;
	}
	#userdata td{
		
		font-size: 1.2em;
		padding: 10px;
	
</style>
<center>
	<br />
	<h2><strong style="font-size: 2em">Rincian Biaya</strong></h2>
</center>
<div id="main" class="row" style="width: 90%;">
	
	<table border="1" id="userdata" class="table-bordered">
		<thead>
			<th rowspan="2" style="text-align: center; vertical-align: ">Paket</th>
			<th rowspan="2" style="text-align: center">Total Biaya</th>
			<th rowspan="2" style="text-align: center">Discount</th>
			<th rowspan="2" style="text-align: center">DP</th>
			<th rowspan="2" style="text-align: center">Cash Back</th>
			<th colspan="4" style="text-align: center">Angsuran</th>
		</thead>
		<thead>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
		</thead>
		<tbody>
			

		</tbody>
	</table>
	<center style="margin-top: 30px">
		<button class="btn btn-primary" onclick="history.back()">Kembali</button>	
	</center>
	
</div>
<!--footer-->
<?php $this->load->view($footer)?>
