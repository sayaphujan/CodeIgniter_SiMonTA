<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo site_url();?>assets/img/stmik.png">
		<title><?=$title;?> | SimonTA</title>
 
 
		<!-- MAIN CSS -->
		<link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/ndoboost.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/gaya.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- PLUGINS CSS -->
		<link href="<?=base_url();?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/plugins/weather-icon/css/weather-icons.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/plugins/prettify/prettify.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/plugins/pnotify/pnotify.custom.min.css" rel="stylesheet">
		
		<!-- MAIN CSS -->
		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
		<link href="<?=base_url();?>assets/css/custom.css" rel="stylesheet">
		<?php $css = $this->session->userdata('levelid');
			if($css == 6):
		?>
		<link href="<?=base_url();?>assets/css/example-home-shop.css" rel="stylesheet">
		<?php endif; ?>
		<!-- MAIN JAVASRCIPT  -->
		<script src="<?=base_url();?>assets/js/jquery.js"></script>
		<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
		<script  type="text/javascript" src="<?=base_url();?>assets/js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector: "textarea",
				plugins: [
					"advlist autolink lists link image charmap print preview anchor",
					"searchreplace visualblocks code fullscreen",
					"insertdatetime media table contextmenu paste"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
			});
		</script>
		 
 
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			body{
				margin-top: 0px;
			}

			.sign-in{
				margin-top: 15px;
				margin-left: 10px;
				margin-right: 10px;
			}

			.form-control .input-login{
				boder:1px solid #ddd;
			}
			.panel{
				border-radius: 0px;
			}
			.panel-default>.panel-heading{

				background-color: #343B46;
				color:#fff;
				border-top-right-radius:0px;
				border-top-left-radius:0px;
			}
			.nav-pills>li:first-child{
				border-top: 1px solid #ddd;
			}
			.nav-pills>li{
				border-bottom: 1px solid #ddd;
			}
			.breadcrumb{
				border-radius: 0px;
			}
			.the-box{
				background-color: #37BC9B;
			}
			.the-box h4{
				color: #fff;
			}
		</style>
	</head>
 
	<body id="top" class="tooltips">
	
		<!--
		===========================================================
		BEGIN PAGE
		===========================================================
		-->
		
		<nav class="navbar square navbar-inverse navbar-fixed-top" role="navigation">
		  <div class="container">
				<?php echo $navbar; ?>
		  </div><!-- /.container-fluid -->
		</nav>
		
		<div class="header">
			<div class="container">
				<?php echo $header;?>
			</div><!-- /.container -->
		</div><!-- /.header -->
		
		<div class="page-content">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<?php echo $sidebar;?>
					</div><!-- /.col-sm-3 -->
					<div class="col-sm-9">
						<?php echo $content;?>
					</div><!-- /.col-sm-9 -->
					
				</div><!-- /.row -->
							
				
				<hr />
				
			</div><!-- /.container -->
		</div><!-- /.page-content -->

		
		
		<footer style="padding:0">
			<div class="footer">
			<?php
/*
				$awal = microtime(true);
				// --- bagian yang akan dihitung execution time --
				$bil = 2;
				$hasil = 1;

				for ($i=1; $i<=10000000; $i++)

				{
				$hasil .= $bil;

				}

				// --- bagian yang akan dihitung execution time --

				$akhir = microtime(true);

				$lama = $akhir - $awal;

				echo "<p>Lama eksekusi script adalah: ".$lama." detik</p>";
*/
			?>
			<center>
				<?php
					$ip = $_SERVER['REMOTE_ADDR'];
					echo"Anda berkunjung dengan IP Address $ip</center>";
				?>
			</center>
			&copy; 2014 SiMonTA
			</div>
		</footer>
	
		<!--
		===========================================================
		END PAGE
		===========================================================
		-->
		
		<!--
		===========================================================
		Placed at the end of the document so the pages load faster
		===========================================================
		-->
		<!-- DATA TABES SCRIPT -->
        <script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		<!-- PLUGINS AND NDOBOOST JS-->
		<script src="<?=base_url();?>assets/plugins/prettify/prettify.js"></script>
		<script src="<?=base_url();?>assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="<?=base_url();?>assets/plugins/owl-carousel/owl.carousel.js"></script>
		<script src="<?=base_url();?>assets/js/ndoboost.min.js"></script>
		
		<script>
		$(document).ready(function(){

			
			var Owltime = 7;
			  var $progressBar,
				  $bar, 
				  $elem, 
				  isPause, 
				  tick,
				  percentTime;
			 
				$("#owl-example-shop").owlCarousel({
				  slideSpeed : 500,
				  paginationSpeed : 500,
				  singleItem : true,
				  afterInit : progressBar,
				  afterMove : moved,
				  startDragging : pauseOnDragging,
				  transitionStyle: "fadeUp"
				});

					 
				function progressBar(elem){
				  $elem = elem;
				  buildProgressBar();
				  start();
				}
			 
				function buildProgressBar(){
				  $progressBar = $("<div>",{
					id:"OwlprogressBar"
				  });
				  $bar = $("<div>",{
					id:"Owlbar"
				  });
				  $progressBar.append($bar).prependTo($elem);
				}
			 
				function start() {
				  percentTime = 0;
				  isPause = false;
				  tick = setInterval(interval, 10);
				};
			 
				function interval() {
				  if(isPause === false){
					percentTime += 1 / Owltime;
					$bar.css({
					   width: percentTime+"%"
					 });
					if(percentTime >= 100){
					  $elem.trigger('owl.next')
					}
				  }
				}
			 
				function pauseOnDragging(){
				  isPause = true;
				}
			 
				function moved(){
				  clearTimeout(tick);
				  start();
				}
			});
			
		</script>
	</body>
</html>