<?php 
	include 'includes/config.php'; 

	session_start();

	if (empty($_SESSION['id']) && empty($_SESSION['username'])) {
		header("location: index.php");
	} 
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>DASHBOARD</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">


	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<!-- Stylesheets -->

	<link href="common-css/bootstrap.css" rel="stylesheet">

	<link href="common-css/ionicons.css" rel="stylesheet">


	<link href="layout-1/css/styles.css" rel="stylesheet">

	<link href="layout-1/css/responsive.css" rel="stylesheet">
	<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

</head>
<body >

	<header>
		<div class="container-fluid position-relative no-side-padding">

			<a href="dashboard.php" class="logo"><!--<img src="images/logo.png" alt="Logo Image">--> <div class="name"> <b>HAKIKA DEPOT MANAGEMENT SYSTEM</b></div></a>
			

			<!-- <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div> -->

			<!-- <ul class="main-menu visible-on-click" id="main-menu">
				<li><a href="#">Home</a></li>
				<li><a href="#">Categories</a></li>
				<li class="logout"><a href="#" target="">Blog</a></li>
			</ul> -->
			<!-- main-menu -->

			<ul class="nav navbar-right main-menu" style="float: right;">

				<li><a href="logout.php"><i class="ion-power"></i> Logout</a></li>
			</ul>

		<!--	<div class="src-area">
				<form>
					<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
					<input class="src-input" type="text" placeholder="Type of search">
				</form>
			</div>-->

		</div><!-- conatiner -->
	</header>
	
	

	<section class="blog-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="images/driver2.jpg" alt="Blog Image" width="500" height="400"></div>

							<!--<a class="avatar" href="#"><img src="images/icons8-team-355979.jpg" alt="Profile Image"></a>-->

							<div class="blog-info">

								<h6 class="title"><b>DRIVERS</b></h6>

								<ul class="post-footer">
									<li><a href="adddriver.php"><i class="ion-plus"></i>ADD</a></li>
									<li><a href="driverview.php"><i class="ion-eye"></i>VIEW</a></li>
								</ul>
							</div>
						</div>
						
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="card h-80">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="images/cargo2.jfif" alt="Blog Image" width="368" height="207"></div>

							

							<div class="blog-info">
								<h6 class="title"><b>TRIPS </b></h6>

								<ul class="post-footer">
									<li><a href="addtrip.php"><i class="ion-plus"></i>ADD</a></li>
									<li><a href="tripview.php"><i class="ion-eye"></i>VIEW</a></li>
								</ul>
							</div>
						</div>
						

					</div>
				</div>
				
				<!-- <div class="col-lg-4 col-md-6">
					<div class="card h-80">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="images/reports.jfif" alt="Blog Image"></div>
						
								<h6 class="title"><b> REPORTS</b></h6>

							<ul class="post-footer">
								 <li><a href="#"><i class="ion-heart"></i>57</a></li> -->
								<!-- <li><a href="generatereports.php"><i class="ion-printer"></i>GENERATE</a></li>
								 <li><a href="#"><i class="ion-eye"></i>138</a></li> 
							</ul>
						</div>
						
					</div>
				</div> --> 

				<div class="col-lg-4 col-md-6">
					<div class="card h-80">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="images/trips.jfif" alt="Blog Image"></div>
							

							
								<h6 class="title"><b> TRUCKS</b></h6>

							<ul class="post-footer">
								<li><a href="addtruck.php"><i class="ion-plus"></i>ADD</a></li>
								<li><a href="truckview.php"><i class="ion-eye"></i>VIEW</a></li>
							</ul>
						</div>
						
					</div>
				</div>
				
				
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- section -->




	<!-- SCIPTS -->

	<script src="common-js/jquery-3.1.1.min.js"></script>

	<script src="common-js/tether.min.js"></script>

	<script src="common-js/bootstrap.js"></script>

	<script src="common-js/scripts.js"></script>

</body>
</html>
  

