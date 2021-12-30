<style type="text/css">
	.minh-620{min-height: 669px !important;}
</style>

<div class="container-fluid">
	<div class="panel panel-profile">
		<div class="clearfix">
			<!-- LEFT COLUMN -->
			<div class="profile-left">
				<!-- PROFILE HEADER -->
				<div class="profile-header">
					<div class="overlay"></div>
					<div class="profile-main">
						<a href="<?php echo (!empty($user_data['image'])?$user_data['image']:DEFULT_USER_IMG); ?>" class="image-link"><img src="<?php echo (!empty($user_data['image'])?$user_data['image']:DEFULT_USER_IMG); ?>" style="width: 156px;" class="img-circle" alt="Avatar"></a>
						<h3 class="name"><?php echo $user_data["name"]; ?></h3>
						<span class="online-status status-available">
							<?php
								if($user_data["login_status"] ==1)
								{
								 	echo  "Available";
								}else
								{
									echo "Offline";
								}
							?>
						</span>
					</div>
					<div class="profile-stat">
						<!-- <div class="row">
							<div class="col-md-4 stat-item">
								0 <span>Live Tours</span>
							</div>
							<div class="col-md-4 stat-item">
								0 <span>Complete Tours</span>
							</div>
							<div class="col-md-4 stat-item">
								0 <span>Cancel Tours</span>
							</div>
						</div> -->
					</div>
				</div>
				<!-- END PROFILE HEADER -->
				<!-- PROFILE DETAIL -->
				<div class="profile-detail">
					<div class="profile-info">
						<h4 class="heading">Candidate Info</h4>
						<ul class="list-unstyled list-justify">
							<li>Registration Id  <span><?php echo $user_data["reg_id"]; ?></span></li>
							<li>Mobile <span><?php echo $user_data["mobile_no"]; ?></span></li>
							<li>Email <span><?php echo $user_data["email"]; ?></span></li>
						</ul>
					</div>
					
					<div class="profile-info">
						<h4 class="heading">Address</h4>
						<p><?php echo nl2br($user_data["address"]); ?></p>
					</div>
					<div class="text-center"><a href="<?php echo base_url() ?>admin/adduser/<?php echo $user_data['id']; ?>" class="btn btn-primary">Edit Profile</a></div>
				</div>
				<!-- END PROFILE DETAIL -->
			</div>
			<!-- END LEFT COLUMN -->
			<!-- RIGHT COLUMN -->
			<div class="profile-right minh-620">
				<h4 class="heading"><?php echo $user_data["name"]." Profile"; ?></h4>
				<!-- AWARDS -->
				<div class="awards">
					<div class="row">
						<table class="table table-hover" id="view_user_tour">
							<thead>
								<tr>
									<th>#</th>
									<th>S NO</th>
									<th>Last Name</th>
									<th>Username</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
					
				</div>
				<!-- END AWARDS -->
			</div>
			
			<!-- END RIGHT COLUMN -->
		</div>
	</div>
</div