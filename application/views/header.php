<!doctype html>
<html lang="en">

<head>
	<title>Cricwarm</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/chartist/css/chartist-custom.css">
	
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/apple-icon.png">
	<!-- <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/img/favicon.png"> -->

	<!-- DataTables css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/responsive.bootstrap.min.css">

    <!-- Display toast message -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/toastr/toastr.min.css">

    <!-- for date picker-->

    <!-- for  toggle switch -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css">
    
	<!-- Javascript -->
	<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDc3rlwwWUHNOFL-jOOk9WilLBmhHtNDHU"></script>

	
	<script type="text/javascript">
		const baseurl = "<?php echo base_url(); ?>";
	</script>

</head>
<style type="text/css">
img.logo {
    width: 100px;
}
.navbar-default .brand {
    padding: 22px 59px;
}
</style>

<body>
	<?php  $user_data = $this->session->userdata("tour_admin"); ?>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="<?php echo base_url(); ?>admin/dashboard"><img src="<?php echo base_url();?>uploads/weblogo.png" alt="Tourguys Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div class="navbar-btn navbar-btn-right"></div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<?php if(!empty($user_data["image"])){ ?>
									<img src="<?php echo $user_data["image"]; ?>" class="img-circle"> 
								<?php }else{ ?>
									<img src="<?php echo base_url(); ?>assets/img/user.png" class="img-circle"> 
								<?php } ?>
								<span>Samuel</span> <i class="icon-submenu lnr lnr-chevron-down"></i>
							</a>
							<ul class="dropdown-menu">
								<!-- <li><a href="<?php echo base_url(); ?>admin/myprofile"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="<?php echo base_url(); ?>admin/settings"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> -->
								<li><a href="<?php echo base_url(); ?>admin/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?php echo base_url(); ?>admin/dashboard" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<!-- <li><a href="<?php echo base_url(); ?>admin/tourList" class=""><i class="lnr lnr-home"></i> <span>Tour Management</span></a></li> -->
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>User Management</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="<?php echo base_url(); ?>admin/adduser" class="">Add User</a></li>
									<li><a href="<?php echo base_url(); ?>admin/userlist" class="">User List</a></li>
								</ul>
							</div>
						</li>
						<!-- <li>
							<a href="#subPagesDestinations" data-toggle="collapse" class="collapsed"><i class="lnr lnr-home"></i> <span>Destinations</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPagesDestinations" class="collapse ">
								<ul class="nav">
									<li><a href="<?php echo base_url(); ?>admin/TouristicPlaces" class="">Touristic Place</a></li>
									<li><a href="<?php echo base_url(); ?>admin/DestinationPlaces" class="">Destination</a></li>
									<li><a href="<?php echo base_url(); ?>admin/Items" class="">Items</a></li>

								</ul>
							</div>
						</li> -->
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				
		     <?php $msgs = $this->session->flashdata('cricwarm_success'); ?>
		     <?php $msge = $this->session->flashdata('cricwarm_error'); ?>
		     <?php if(!empty($msgs)){ ?>
		     <div class="container-fluid">
				<div class="panel panel-headline">
					<div class="panel-body">
						<div class="row">
						  <!-- class="col-md-12 wow fadeIn" data-wow-delay="0.3s" -->
						  	<div class="col-md-12">
						     	<div class="alert-message alert-success">
							        <?php echo $msgs; ?>
						     	</div>
						    </div>
						</div>
					</div>
				</div>
			</div>
	     	<?php } if(!empty($msge)){ ?>
	     	<div class="container-fluid">
				<div class="panel panel-headline">
					<div class="panel-body">
						<div class="row">
						  <!-- class="col-md-12 wow fadeIn" data-wow-delay="0.3s" -->
						  	<div class="col-md-12">
						     	<div class="alert-message alert-danger">
							        <?php echo $msge; ?>
						     	</div>
	     					</div>
						</div>
					</div>
				</div>
			</div>
	     	<?php } ?>
							  	
