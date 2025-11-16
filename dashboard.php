<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Patient  | Dashboard</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		<style>
		/* ===== Custom Aesthetic Color Palette ===== */
		:root {
		    --sage: #769382;
		    --linen: #c0c3b9;
		    --sage-dark: #5a6e5c;
		    --offwhite: #F3EFE3;
		    --primary: var(--sage);
		    --secondary: var(--linen);
		    --accent: var(--sage-dark);
		    --light: var(--offwhite);
		    --footer-gradient: linear-gradient(90deg, var(--sage) 0%, var(--linen) 100%);
		    --button: var(--sage);
		    --button-hover: var(--sage-dark);
		    --main-bg: #c0c3b9; /* Use your main color for everything */
		    --main-text: #355144;
		    --main-accent: #769382;
		    --main-white: #f3efe3;
		}
		body, .app-content, .main-content, .container, .container-fluid {
		    background: var(--main-bg) !important;
		    color: var(--main-text) !important;
		}
		.navbar, .navbar-default, .navbar-header, .navbar-brand, .navbar-collapse {
		    background: var(--footer-gradient) !important;
		    color: var(--accent) !important;
		    border: none !important;
		    box-shadow: 0 2px 8px rgba(118,147,130,0.08);
		}
		.navbar .navbar-brand h2, .navbar .navbar-right h2 {
		    color: var(--accent) !important;
		    font-weight: 900;
		    letter-spacing: 2px;
		}
		.sidebar, .sidebar-container {
		    background: var(--linen) !important;
		    color: var(--main-text) !important;
		    border-right: 1px solid var(--sage);
		}
		.sidebar .main-navigation-menu > li > a, .sidebar .item-inner, .sidebar .item-media i {
		    color: var(--main-text) !important;
		    font-weight: 600;
		    transition: all 0.2s;
		}
		.sidebar .main-navigation-menu > li.active > a, .sidebar .main-navigation-menu > li > a:hover {
		    background: var(--sage) !important;
		    color: #fff !important;
		    border-radius: 8px;
		    margin: 2px 8px;
		}
		.panel.panel-white {
		    background: var(--offwhite) !important;
		    border-radius: 18px;
		    box-shadow: 0 4px 24px rgba(118,147,130,0.18);
		    border: 1px solid var(--linen);
		    transition: box-shadow 0.2s;
		}
		.panel.panel-white:hover {
		    box-shadow: 0 8px 32px rgba(118,147,130,0.28);
		}
		.panel .panel-body {
		    color: var(--main-text) !important;
		}
		.StepTitle {
		    color: var(--sage) !important;
		    font-weight: 700;
		    font-size: 1.2em;
		}
		.breadcrumb, .breadcrumb li, .breadcrumb li.active {
		    background: transparent !important;
		    color: var(--main-text) !important;
		}
		a, .links a, .cl-effect-1 a {
		    color: var(--sage) !important;
		    font-weight: 600;
		    transition: color 0.2s;
		}
		a:hover, .links a:hover, .cl-effect-1 a:hover {
		    color: var(--sage-dark) !important;
		    text-decoration: underline;
		}
		.footer-inner {
		    background: var(--footer-gradient) !important;
		    color: var(--accent) !important;
		    border-radius: 0 0 18px 18px;
		    padding: 12px 24px;
		    box-shadow: 0 2px 12px rgba(118,147,130,0.08);
		}
		.text-bold, .text-uppercase {
		    color: var(--accent) !important;
		    font-weight: 900 !important;
		    letter-spacing: 1px;
		}
		.go-top i {
		    color: var(--accent) !important;
		}
		.mainTitle {
		    color: var(--sage) !important;
		    font-weight: 700;
		    font-size: 2em;
		    margin-bottom: 10px;
		}
		.fa-stack .fa-square {
		    color: var(--sage) !important;
		}
		.fa-stack .fa-inverse {
		    color: var(--offwhite) !important;
		}
		::-webkit-scrollbar-thumb {
		    background: var(--sage);
		    border-radius: 8px;
		}
		::-webkit-scrollbar {
		    background: var(--linen);
		    width: 8px;
		}
		::-webkit-scrollbar-thumb:hover {
		    background: var(--sage-dark);
		}
		</style>

	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Patient | Dashboard</h1>
								</div>
							
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
							<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">My Profile</h2>
											
											<p class="links cl-effect-1">
												<a href="edit-profile.php">
													Update Profile
												</a>
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">My Appointments</h2>
										
											<p class="cl-effect-1">
												<a href="appointment-history.php">
													View Appointment History
												</a>
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle"> Book My Appointment</h2>
											
											<p class="links cl-effect-1">
												<a href="book-appointment.php">
													Book Appointment
												</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			<>
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
