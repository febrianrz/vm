<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$title ?></title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>asset/bootstrap-3.1.1-dist/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>asset/bootstrap-3.1.1-dist/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>asset/css/daftarStyle.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/demo/demo.css" />
	    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/demo/demo.css" />
	    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/themes/default/easyui.css" />
	    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/js/easyui/themes/icon.css" />
	    
		<script type="text/javascript" src="<?=base_url() ?>asset/js/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="<?=base_url() ?>asset/bootstrap-3.1.1-dist/js/bootstrap.js"></script>
		<script type="text/javascript" src="<?=base_url() ?>asset/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="<?=base_url()?>asset/js/easyui/jquery.min.js"></script>
	    <script type="text/javascript" src="<?=base_url()?>asset/js/root.js"></script>
	    <script type="text/javascript" src="<?=base_url()?>asset/js/easyui/jquery.easyui.min.js"></script>
		
	</head>
	<body>
		<!-- hanya bagian header halaman admin, marketing -->
		
		<header>
			<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #882020;" role="navigation">
			   <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" 
			         data-target="#example-navbar-collapse">
			         <span class="sr-only">Toggle navigation</span>
			         <span class="icon-bar"></span>
			         <span class="icon-bar"></span>
			         <span class="icon-bar"></span>
			      </button>
			    	<a class="navbar-brand" href="#" style="color: #FFFFFF">Villa Merah</a>
				</div>
				<div class="collapse navbar-collapse" id="example-navbar-collapse">
				      <ul class="nav navbar-nav">
				         <li class="active"><a href="<?=base_url()?>administrator/home">Home</a></li>
				         <li><a href="<?=base_url()?>all_access/daftar" style="color: #FFFFFF">Daftar</a></li>
				         <li><a href="#" style="color: #FFFFFF">Biaya</a></li>
				         <li><a href="#" style="color: #FFFFFF">Jadwal</a></li>
				         <li><a href="#" style="color: #FFFFFF">Jurusan</a></li>
				         <li><a href="#" style="color: #FFFFFF">Paket</a></li>
				         
				         <!--li class="dropdown">
				            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				               Java <b class="caret"></b>
				            </a>
				            <ul class="dropdown-menu">
				               <li><a href="#">jmeter</a></li>
				               <li><a href="#">EJB</a></li>
				               <li><a href="#">Jasper Report</a></li>
				               <li class="divider"></li>
				               <li><a href="#">Separated link</a></li>
				               <li class="divider"></li>
				               <li><a href="#">One more separated link</a></li>
				            </ul>
				         </li-->
				      </ul>
				      <div>
					      <p class="navbar-text navbar-right" style="color: #FFFFFF">Signed in as 
					         <a href="<?=base_url('profile')?>" style="color: #FFFFFF" class="navbar-link"><?php echo $this->session->userdata('user')?></a> &nbsp; |
					         &nbsp; <a href="<?=base_url('login/logout')?>" style="color: #FFFFFF" class="navbar-link">Logout</a>
					      </p>
				</div>
   			</div>
   
			</nav>
		</header>


		