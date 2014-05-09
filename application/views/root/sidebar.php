<!--ul class="nav nav-pills nav-stacked">
	<li><a href="<?=base_url()?>root/index/">Home</a></li>
  	<li><a href="<?=base_url()?>root/index/siswa">Biodata Siswa</a></li>
  	<li><a href="<?=base_url()?>root/index/sekolah">Data Sekolah</a></li> 
  	<li><a href="<?=base_url()?>root/index/kelas">Kelas</a></li>
  	<li><a href="<?=base_url()?>root/index/paket">Paket</a></li>
  	<li class="active"><a href="<?=base_url()?>root/index/jadwal">Jadwal</a></li>
  	<li><a href="<?=base_url()?>root/index/biaya">Biaya</a></li>
  	<li><a href="<?=base_url()?>root/index/user">User</a></li>
  	<li><a href="<?=base_url()?>root/index/level">Level</a></li>
</ul-->
<script type="text/javascript" src="<?=base_url()?>asset/js/easyui/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/bootstrap-3.1.1-dist/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>


<div class="panel-group" id="accordion">
	<div class="panel-default">
		<div class="panel-heading" style="padding-left: 0">
			<input type="search" class="searchbox" name="search" placeholder="Pencarian" /><br />
			<select class="form-control">
  				<option>Nama</option>
  				<option>Kelas</option>
  				<option>Paket</option>
 				<option>Jadwal</option>
  				<option>Sekolah</option>
			</select>
		</div>
	</div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a href="<?=base_url('root/index')?>">
          Home
        </a>
      </h4>
    </div>
    
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Siswa
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <a href="<?=base_url()?>root/index/siswa">Biodata Siswa</a>
        </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Administrasi
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
       <a href="<?=base_url()?>root/index/sekolah">Data Sekolah</a><br />
       <a href="<?=base_url()?>root/index/kelas">Kelas</a><br />
       <a href="<?=base_url()?>root/index/paket">Paket</a><br />
       <a href="<?=base_url()?>root/index/jadwal">Jadwal</a><br />
       <a href="<?=base_url()?>root/index/biaya">Biaya</a><br />
       </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
          Tools
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">
      	<a href="<?=base_url()?>root/index/user">User</a><br />
  		<a href="<?=base_url()?>root/index/level">Level</a><br />
  		<a href="#">Backup</a><br />
       </div>
    </div>
  </div>
</div>

		