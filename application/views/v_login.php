<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login Villa Merah</title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<meta name="description" content="Villa merah form" />
		<meta name="keywords" content="villa merah, form" />
		<meta name="author" content="Villa Merah" />
		
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>asset/css/back_slide/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>asset/css/back_slide/css/style1.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>asset/css/loginStyle.css" />
		<script type="text/javascript" src="<?=base_url() ?>asset/css/back_slide/js/modernizr.custom.86080.js"></script>
		<script type="text/javascript" src="<?=base_url() ?>asset/js/login.js"></script>
		<!--link rel="shortcut icon" href="<?=base_url() ?>asset/image/favicon.ico"-->
		<link rel="stylesheet" href="<?=base_url(); ?>asset/bootstrap-3.1.1-dist/css/bootstrap.css" />
		<script type="text/javascript" src="<?=base_url(); ?>asset/js/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="<?=base_url(); ?>asset/js/blur.js"></script>
		<style>
			* {
				margin: 0 auto;
				padding: 0;
			}
			#page {
				background: url('<?php base_url();?>asset/image/background.png') no-repeat;
				background-size: cover;
				text-align: center;
			}
			
			.clear {
				clear: both;
			}
			
			#main {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				z-index: -2;
				background-size: cover !important;
			}
			
			#submain {
				margin-top: 5%;
				border: 2px;
				width: 90%;
				min-height: 80%;
				background: #ffffff;
				border-radius: 10px;
				color: #ffffff;
				padding-top: 10px;
				padding-bottom: 3%;
			}
			.head_login {
				font-size: 3em;
				margin-bottom: 5%;
				color: #d31a22;
			}
			
			#back-login {
				border: 1px;
				width: 40%;
				height: 40%;
				min-height: 40%;
				background-image: url('<?php base_url();?>asset/image/vilmel.png');
				background-size: 70% 100%;
				background-repeat: no-repeat;
				background-position: center center;
				float: left;
			}
			#form-login {
				width: 40%;
				float: left;
			}

		</style>
		<script>
			$(document).ready(function() {
				/*
				$.ajax({
					url:"http://localhost/villa_merah/login/jsonBackground",
					dataType:"json",
					type:"post",
					data:"req='true'",
					success:function(data){
						//alert(data);
						//console.log(data.row[0].tes);
						$.each(data.row, function(i, val){
							console.log(val.tes);
						});
					},
					error:function(data){
						alert('error');
					}
				});
				*/
				
				/*
				$('.targetcopy').blurjs({
					source : 'body',
					//radius : 30,
					overlay : 'rgba(255,255,255,0.5)'
				});
				*/
			
				$(".btn").click(function() {
					//alert('hai');
					user = $("#username").val();
					pass = $("#password").val();
					$.ajax({
						type : "POST",
						url : "<?=base_url('login/cek_login') ?>
							",
							data : $('form').serialize(),
							timeout : 5000,
							success : function(html) {
								if (html != 'false') {
									window.location.replace("<?=base_url() ?>"+html);
								} else {
									$('#loading').remove();
									$(".not_login").slideUp();
									$(".not_login").slideDown();
								}
							},
							error: function(xhr, status){
								alert('Unknown Error : ' + status);
							}
					});
					return false;
				});
			});
		</script>
	</head>
	<body id="page">
		<ul class="cb-slideshow">
			<li>
				<span>Image 0</span>
				<div>
					<h3></h3>
				</div>
			</li>
			<li>
				<span>Image 02</span>
				<div>
					<h3></h3>
				</div>
			</li>
			<li>
				<span>Image 03</span>
				<div>
					<h3></h3>
				</div>
			</li>
			<li>
				<span>Image 04</span>
				<div>
					<h3></h3>
				</div>
			</li>
			<li>
				<span>Image 05</span>
				<div>
					<h3></h3>
				</div>
			</li>
			<li>
				<span>Image 06</span>
				<div>
					<h3></h3>
				</div>
			</li>

		</ul>
		<div class="container">
			<!-- Codrops top bar -->
			<div class="codrops-top">
				<div id="main">
					<div id="submain" class="targetcopy">
						<div class="head_login">
							<b>Selamat Datang</b>
						</div>
						<div id="back-login">
							<!-- Villa Merah Logo-->
							<br />
							<br />
							<br />
							<br />
							<br />
							<br />
							<br />
							<br />
						</div><!--back-login-->
						<div id="loading">
							
						</div>
						<div id="form-login">
							<div style="margin-top:20px; color: #ff0000">
								<p class="not_login" style="display: none; margin: 0 auto; padding: 5px; border: 1px; border-radius: 5px; margin-bottom: 5px; ">
									<i>Maaf, username dan password tidak sesuai !</i>
								</p>
							</div>
							<form class="form-horizontal" role="form" method="post" action="">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" name="username" class="form-control" id="" placeholder="Username" autocomplete="off" autofocus required>
									</div>
								</div>
								<div class="form-group">

									<div class="col-sm-12">
										<input type="password" name="password" class="form-control" placeholder="Password">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-0 col-sm-1">
										<button type="submit" class="btn btn-default" style="font-weight: bold;">
											Sign in
										</button>
									</div>
								</div>
							</form><!-- form-login-->
						</div>
						<div class="clear"></div>
						<?php $this->load->view('footer')?>
					</div>
				</div>
				<div class="clr"></div>
			</div><!--/ Codrops top bar -->

		</div>

	</body>
</html>