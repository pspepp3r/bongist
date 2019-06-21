<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/list.min.js" type="text/javascript"></script>
<script>
	$(document).ready( function() {
		var options = {
  valueNames: [ 'name' ]
};

var userList = new List('customers', options);
	});
</script>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Customers</h1>
			</div>
			<!-- END PAGE TITLE -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">

			<div class="portlet light">
				<div class="portlet-body">
					<div class="row inbox">
						<div class="col-sm-3 col-md-4" id="customers">
							<ul class="inbox-nav margin-bottom-10">
							<form action="#" style="margin-bottom: 10px; padding-right: 12px;">
									<div class="form-group">
										<input type="text" class="form-control search" placeholder="Search Customers...">
									</div>
								</form>
								
							</ul>
							<div class="scroller" style="max-height: 500px; overflow: auto; width: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-initialized="1">
								<ul class="general-item-list list" style="margin: 0px; padding: 0px;">
								<?php
								$users = user::all();

								if ($users) {
                                    foreach ($users as $user) {
										?>
										<li class="item todo-tasklist-item todo-tasklist-item-border-blue customer_load" style="cursor: pointer; padding: 8px; list-style: none;" data-name="<?php echo $user['fname'].' '.$user['lname']; ?>" data-email="<?php echo $user['email']; ?>" data-phone="<?php echo $user['phone']; ?>" data-city="<?php echo $user['city']; ?>" data-state="<?php echo $user['state']; ?>" data-address="<?php echo $user['address']; ?>">
										<div class="item-head">
											<div class="item-details">
												<img class="item-pic" style="height: 50px; width: 50px; object-fit: cover;" src="<?php echo config::baseUploadProfileUrl().$user['photo']; ?>">
												<span class="item-name name"><?php echo $user['fname'].' '.$user['lname']; ?></span>
                                                <br>
												Created: <span class="item-label"><?php echo request::timeAgo($user['timestamp']); ?></span>
											</div>
											<span class="item-status"> <?php echo count(user::orders($user['id'])) ?> Order(s)</span>
										</div>
									</li>
										<?php
									}
								}else{
									?>
									<div class="alert alert-info">
										No new customer
									</div>
									<?php
								}
								?>
								</ul>
							</div>
						</div>
						<div class="col-sm-9 col-md-8">
							
							<div class="table-responsive user_info" style="display: none;">
							<div class="inbox-header">
								<h3 class="pull-left user_name"></h3>
								
							</div>
								 <table class="table table-striped">
														<tr>
															<td>Email Address</td>
															<td><span class="user_email"></span></td>
														</tr>
														<tr>
															<td>Phone Number</td>
															<td><span class="user_phone"></span></td>
														</tr>
														<tr>
															<td>State</td>
															<td><span class="user_state"></span></td>
														</tr>
														<tr>
															<td>City</td>
															<td><span class="user_email"></span></td>
														</tr>
														<tr>
															<td>Address</td>
															<td><span class="user_address"></span></td>
														</tr>
													</table>
												</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
