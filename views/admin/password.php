 <?php
  if (isset($_SESSION['logged_staff'])) {
	   ?> 
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1><small>security & password</small></h1>
			</div>
			<!-- END PAGE TITLE -->
			
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			<!-- BEGIN PAGE BREADCRUMB -->
			
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row margin-top-10">
			<div class="col-md-6 col-sm-12">
					
					<!-- BEGIN PORTLET-->
					
					<div style="height:500px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Security</span>
								<span class="caption-helper hide">weekly stats...</span>
							</div>
							<div class="actions">
							
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 350px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								<div class="general-item-list">
									
								<div style="auto" class="item">
								<img style="margin:auto;width:300px" class="img-responsive" src="../img/lock.png">
											
										
										
									</div>
																		
									</div>	
									</div>	
							
						</div>
					</div>
					
					<!-- END PORTLET-->
					
				</div>
				<div class="col-md-6">
					<!-- BEGIN PORTLET-->
					<div style="min-height:500px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Change Password</span>
								
							</div>
							<div class="actions">
							<div style="height:auto; text-align:center;background:#d6e9c6;padding:5px; width:auto;display:none" class="notif"></div>
							</div>
						</div>
						<div class="portlet-body form ">
						<div class="scroller" style="height: 350px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								
						<div class="col-md-12">
							<form action="" method="post" class="form-horizontal form-row-stripped">
											
											<div class="form-body ">
											<div class="form-group">
												<?php
												if(isset($_POST['blogs'])){
													$pass = securePwd($_POST['pass']);
													$npass = securePwd($_POST['npass']);
													$cpass = securePwd($_POST['cpass']);
													
													$c = $conn->prepare("SELECT * FROM staff");
													$c->execute();
													$check = $c->fetch();
													if($check['password'] !== $pass){ ?>
													
													<div class="alert alert-warning" >
												    <strong>Current Password is inaccurate...</strong><br>
												    </div>
													
													<?php 
													}else if($npass !== $cpass){?>
													<div class="alert alert-warning" >
												    <strong>Confirm Password does not match...</strong><br>
												    </div>
													<?php } else{
													$q = $conn->prepare("UPDATE staff SET password = :pas");

													$q->bindParam(':pas', $npass);
													if ($q->execute()) {
													  ?>
												<div class="alert alert-success" >
												  <strong>Password successfully changed...</strong><br>
												  </div>
													<?php
													   
													} else {
														
														 ?>
												<div class="alert alert-warning" >
												  <strong>Unable to change password..</strong><br>
												  </div>
													<?php
													}
												}
												}
												?>
											</div>
											<div class="form-group">
											<label>Current Password</label>
											<input type="password" name="pass" value="<?php if(isset($_POST['pass'])){echo $_POST['pass'];}?>" class="form-control">
											</div>
											<div class="form-group">
											<label>New Password</label>
											<input type="password" name="npass" value="<?php if(isset($_POST['npass'])){echo $_POST['npass'];}?>" class="form-control">
											</div>
											<div class="form-group">
											<label>Confirm Password</label>
											<input type="password" name="cpass" value="<?php if(isset($_POST['cpass'])){echo $_POST['cpass'];}?>" class="form-control">
											</div>
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="">
														<button type="submit" name="blogs" class="btn btn-block btn-lg green"><i class="fa fa-check"></i> Submit</button>
													</div>
												</div>
											</div>
										</form>
										
								</div>
							</div>
						</div>
						
					</div>
					<!-- END PORTLET-->
				</div>
				
						</div>
		<!-- END QUICK SIDEBAR -->
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<?php
                }else{
                    header("location: login"); 
                    ?>
                      
                    <?php
                }
                ?>
