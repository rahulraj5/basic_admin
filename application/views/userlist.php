<style type="text/css">
	.user_image{
		width: 50px;
	}
</style>
<div class="container-fluid">
	<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">User List</h3>
			<!-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> -->
		</div>
		<div class="panel-body table-responsive">
			<table class="table table-hover" id="user_list_tab">
				<thead>
					<tr>
						<th>S.no.</th>
						<th>Register Id</th>
						<th>Logo</th>
						<th>Name</th>
						<th>Email</th>
						<th>Mobile no.</th>
						<th>User Status</th>
						<th>Status</th>
						<th>Reg. Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($user_list)){ ?>
					<?php $sn = 1; foreach($user_list as $ul){ ?>
					<tr>
						<td><?php echo $sn; ?></td>
						<td><?php echo $ul["reg_id"]; ?></td>
						<td><a href="<?php echo (!empty($ul['image'])?$ul['image']:DEFULT_USER_IMG); ?>" class="image-link"><img src="<?php echo (!empty($ul['image'])?$ul['image']:DEFULT_USER_IMG); ?>" class="user_image"></a></td>
						<td><?php echo $ul["name"]; ?></td>
						<td><?php echo $ul["email"]; ?></td>
						<td><?php echo $ul["mobile_no"]; ?></td>
						<td>
							<?php if($ul["login_status"] == 1){ ?>
								<button class="btn btn-success" type="button" disabled>Online</button>
							<?php }else{ ?>
								<button class="btn btn-danger" type="button" disabled>Ofline</button>
							<?php } ?>
						</td>
						<td>
							<?php if($ul["status"] == 1){ ?>
								<button class="btn btn-primary" type="button" disabled>Enable</button>
							<?php }else{ ?>
								<button class="btn btn-danger" type="button" disabled>Disable</button>
							<?php } ?>
						</td>
						<td><?php echo setDateFormat($ul["create_date"]); ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/viewuser/<?php echo $ul['id']; ?>" title="View User"><i class="fa fa-eye" aria-hidden="true"></i></a>
							&nbsp;
							<a href="<?php echo base_url() ?>admin/adduser/<?php echo $ul['id']; ?>" title="Edit User"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
							&nbsp;
							<?php if($ul['status'] == 1){ ?>
                                <a href="javascript:void(0)" href-status="0" href-role="2"  href-id="<?php echo $ul['id']?>" href-act="Disable" class="user_status" title="Disable User"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                &nbsp;
                        	<?php }else{ ?>
                                <a href="javascript:void(0)" href-status="1" href-role="2"  href-id="<?php echo $ul['id']?>" href-act="Enable" class="user_status"  title="Enable User"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                                &nbsp;
                            <?php } ?>	

                            <a href="javascript:void(0)" href-status="3" href-role="2" href-id="<?php echo $ul['id']?>" href-act="Delete" class="user_status" title="Delete User"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						</td>
					</tr>
					<?php $sn++; } }else{ ?>
					<tr>
						<td colspan="10">No User available.</td>
					</tr>	
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
 
