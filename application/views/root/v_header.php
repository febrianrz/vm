<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$title ?></title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<meta name="description" content="Villa merah form" />
		<meta name="keywords" content="villa merah, form" />
		<meta name="author" content="Villa Merah" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="shortcut icon" href="<?=base_url() ?>asset/image/favicon.ico">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/bootstrap-3.1.1-dist/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/bootstrap-3.1.1-dist/css/bootstrap.min.css" />
		

		
	    
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/root.css" />
		
		
	</head>
	<body>
	
		<header>
			<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #882020;" role="navigation">
			   <div class="navbar-header">
			   	<!--Logo dan brand villa merah-->
			      <img src="<?=base_url('asset/image/vilmel.jpeg')?>" width="40" height="40" style="float: left; margin-top: 5px;margin-left: 5px;"/>
			    	<a class="navbar-brand" href="<?=base_url()?>" style="color: #FFFFFF">Villa Merah</a>
				</div>
				<div class="collapse navbar-collapse" id="example-navbar-collapse">
					<div>
					      <p class="navbar-text navbar-right" style="color: #FFFFFF">Signed in as 
					         <a href="<?=base_url('profile')?>" class="navbar-link" style="color: #FFFFFF"><?php echo $this->session->userdata('user')?></a> &nbsp; |
					         &nbsp; <a href="<?=base_url('login/logout')?>" class="navbar-link" style="color: #FFFFFF">Logout</a>&nbsp;&nbsp;&nbsp;
					      </p>
					</div>
   				</div>
   
			</nav>
		</header>