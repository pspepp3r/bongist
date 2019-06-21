 <?php
  if (isset($_SESSION['logged_staff'])) {
	$uid = secureTxt($_GET['id']);
	$q2 = $conn->prepare("SELECT * FROM accounts WHERE id = :id");
	$q2->bindValue(":id", $uid);
	$q2->execute();
	$read = $q2->fetch();
	$q4 = $conn->prepare("SELECT * FROM subscription WHERE user_id = :id");
	$q4->bindValue(":id", $uid);
	$q4->execute();
	$col = $q4->fetch();
	$gid = $col['gymplan_id'];
	$q5 = $conn->prepare("SELECT * FROM gymplans WHERE id = :id");
	$q5->bindValue(":id", $gid);
	$q5->execute();
	$collect = $q5->fetch();
	
    ?> 
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1><small>subscription activation</small></h1>
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
					
					<div style="height:450px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase"> <?php if($q4->rowCount() > 0){echo $collect['name'];}else{echo "NOT SUBSCRIBED TO A PLAN";}?></span>
								<span class="caption-helper hide">weekly stats...</span>
							</div>
							<div class="actions">
								<?php if($q4->rowCount() > 0){?><small class="pull-right"><span class="item-status"><span class="badge badge-empty badge-success"></span> subscribed <?php timeAgo($col['timestamp']);?></span></small><?php }?>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 350px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								<div class="general-item-list">
									
								<div style="margin:60px auto" class="item media it<?php echo $read['id'];?>">
										<a class="pull-left" href="javascript:;">
											<img style="width:100px;height:100px" class="img-responsive img-circle img-thumbnail" src="../images/profile/<?php echo $read['image'];?>">
											
										</a>
										<div class="media-body">
										<p class="media-heading"><a href="javascript:;" class="item-name primary-link"><?php echo $read['name_user'];?></a>
											<small class="pull-right"><span class="item-status"><span class="badge badge-empty badge-success"></span> joined <?php timeAgo($read['timestamp']);?></span></small>
										</p>
										<p>
										 email: <b><?php echo $read['email'];?></b>
										</p>
										<p> phone: <?php echo $read['phone'];?>
										</p>
										<p>
										 state: <?php echo $read['state'];?> </p>
										 <p>city: <?php echo $read['city'];?></p>
										<p>
										 status: <?php if($read['verify'] == 1){ echo "<span class='label label-success'>Verified</span>";} else{ echo "<span class='label label-warning'>Unverified</span>";}?>
										</p>
										<p class="btn-group pull-right">
										<a href="activity?id=<?php echo $read['id'];?>" class="btn btn-default btn-xs">Activity</a>
										<?php
										$w = $conn->prepare("SELECT * FROM subscription WHERE user_id = ".$read['id']."");
										$w->execute();
										if($w->rowCount() > 0){
										$term = $w->fetch();
										?>
										<a href="javascript:;" id="<?php echo $term['id']?>" class="activo btn green btn-xs" title="Remove this plan">Deactivate</a>
										<?php 
										}else{?>
										<a href="activate?id=<?php echo $read['id'];?>" class="btn btn-success btn-xs" title="Activate a gym plan">Activate</a>
										<?php }?>
										<a id="<?php echo $read['id'];?>" href="javascript:;" class="deluser btn btn-danger btn-xs">Delete</a>
										<?php 
											if($read['suspend'] == 1){
										?>
										<a id="<?php echo $read['id'];?>" href="javascript:;" class="unsus btn btn-warning btn-xs">Suspended</a>
										<?php
										} else{?>
										<a id="<?php echo $read['id'];?>" href="javascript:;" class="sususer btn btn-primary btn-xs">Suspend</a>
										<?php 
										}?></p>
										</div>
									</div>
																		
									</div>	
									</div>	
							
						</div>
					</div>
					
					<!-- END PORTLET-->
					
				</div>
				<div class="col-md-6">
					<!-- BEGIN PORTLET-->
					<div style="min-height:450px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Subscription Activation</span>
								
							</div>
							<div class="actions">
								
							</div>
						</div>
						<div class="portlet-body form ">
						<div class="scroller" style="height: 350px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								
						<div class="col-md-12">
							<form style="margin:60px auto" action="" method="post" class="form-horizontal form-row-stripped">
											
											<div class="form-body ">
											<div class="form-group">
												<?php
												if(isset($_POST['act'])){
													$pid = $_POST['plan'];
													$date = time();
																										
													$q = $conn->prepare("INSERT INTO subscription (user_id, gymplan_id, timestamp) VALUES (:uid, :pid, :tim)");

													$q->bindParam(':uid', $uid);
													$q->bindParam(':pid', $pid);
													$q->bindParam(':tim', $date);
								 
													if ($q->execute()) {
													  ?>
												<div class="alert alert-success" >
												  <strong>Activation successful...</strong><br>
												  </div>
													<?php
													   
													} else {
														
														 ?>
												<div class="alert alert-warning" >
												  <strong>Unable to activate..</strong><br>
												  </div>
													<?php
													}
												}
												?>
											</div>
											<div class="form-group">
											<label>Choose a plan</label>
												<select name="plan" class="form-control">
												<option value="">--select--</option>
												<?php 
												$p = $conn->prepare("SELECT * FROM gymplans ORDER BY id DESC");
												$p->execute();
												while($plan = $p->fetch()){
												?>
												<option value="<?php echo $plan['id'];?>"><?php echo $plan['name'];?></option>
												<?php 
												}
												?>
												</select>
											</div>
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="">
														<button type="submit" name="act" class="btn btn-block btn-lg green"><i class="fa fa-check"></i> Activate</button>
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
