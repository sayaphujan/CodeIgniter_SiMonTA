<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/stmik.png">
		<title><?php echo $title;?> |SimonTa</title>
 
		<!-- MAIN CSS -->
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/ndoboost.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/datepicker/rfnet.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/gaya.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- PLUGINS CSS -->
		<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/plugins/weather-icon/css/weather-icons.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/plugins/prettify/prettify.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/plugins/pnotify/pnotify.custom.min.css" rel="stylesheet">
		
		<!-- MAIN CSS -->
		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
		<link href="<?php echo base_url();?>assets/css/admin.css" rel="stylesheet">
 
 		<!-- MAIN JAVASRCIPT  -->
		<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/datepicker/datetimepicker_css.js"></script>
		<script  type="text/javascript" src="<?php echo base_url();?>assets/js/tinymce/tinymce.min.js"></script>
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
			.modal-header{
				background-color: #37BC9B;
			}
			.modal-header p{
				color:#fff;
			}
			th .hide_me, td .hide_me{
				display: none;
			}
			.form-horizontal .control-label {
				text-align: left !important;
			}
			.the-box{
				padding: 15px 20px 10px 10px !important;
			}
		</style>
	</head>
 
	<body id="top" class="tooltips">
	
		<!--
		===========================================================
		BEGIN PAGE
		===========================================================
		-->
		<nav class="navbar square navbar-primary navbar-fixed-top" role="navigation">
		  <div class="container-fluid">
			<?php echo $navbar;?>
		  </div><!-- /.container-fluid -->
		</nav>
		
		
		<div class="page-wrapping">
			
			
			<div class="content-page">
				<?php echo $content; ?>
			</div><!-- /.content-page -->
			<div class="sidebar">
				<?php echo $sidebar;?>
			</div>
		</div><!-- /.page-wrapping -->
		
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
		<script src="<?php echo base_url();?>assets/plugins/prettify/prettify.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/pnotify/pnotify.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/owl-carousel/owl.carousel.js"></script>
		<script src="<?php echo base_url();?>assets/js/ndoboost.min.js"></script>
		
		<script src="<?php echo base_url();?>assets/plugins/scroll/jquery.nicescroll.js"></script>
		<!-- page script -->
		<script>
			$(document).ready(function(){
				
				/** BUTTON SHOW / HIDDEN SIDEBAR **/
				$(".btn-sidebar-collapse").click(function(){
					$(".sidebar").toggleClass("collapse-sidebar");
					$(".content-page").toggleClass("collapse-content");
				});
				
				
				/** NICE SCROLL FUNCTION FOR SIDEBAR MENU **/
				if ($(window).width() > 767) {
					$(".sidebar").addClass("sidebar-nicescroller");
				}
				else {
					$(".sidebar").removeClass("sidebar-nicescroller");
				}
				
				$(".sidebar-nicescroller").niceScroll({
					cursorcolor: "#000",
					cursorborder: "0px solid #fff",
					cursorborderradius: "0px",
					cursorwidth: "5px"
				});
				$(".sidebar-nicescroller").getNiceScroll().resize();
				
				
				/** SIDEBAR MENU **/
				$('.sidebar ul.stacked-menu li a').click(function() {
					$('.sidebar li').removeClass('active');
					$(this).closest('li').addClass('active');	
					var checkElement = $(this).next();
						if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
							$(this).closest('li').removeClass('active');
							checkElement.slideUp('fast');
						}
						if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
							$('.sidebar ul.stacked-menu ul:visible').slideUp('fast');
							checkElement.slideDown('fast');
						}
						if($(this).closest('li').find('ul').children().length == 0) {
							return true;
							} else {
							return false;	
						}		
				});
			});
		</script>
	</body>
</html>