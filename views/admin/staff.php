<?php
if ($staff_role == 0) {
	header("location: products");
}
?>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Staff</h1>
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
								<div class="row">
								<div class="col-md-12">
									<?php

if (isset($_POST['name'])) {
	$name = secureTxt($_POST['name']);
	$phone = secureTxt($_POST['phone']);
	$email = secureTxt($_POST['email']);
	$role = secureTxt($_POST['role']);
	$address = secureTxt($_POST['address']);
	$password = securePwd($_POST['password']);
	$username = secureTxt($_POST['username']);

	$check = $conn->prepare("SELECT * FROM staff WHERE username = :user");
	$check->bindParam(':user', $username);
	$check->execute();

	if ($check->rowCount() > 0) {
		?>
		<div class="alert alert-warning">
		Staff username already exist
		</div>
			<?php
	}else{
		$q = $conn->prepare("INSERT INTO staff (name, phone, email, role, address, password, username, timestamp) VALUES (:name, :phone, :email, :role, :address, :password, :username, :now)");
		$q->bindParam(':name', $name);
		$q->bindParam(':phone', $phone);
		$q->bindParam(':email', $email);
		$q->bindParam(':role', $role);
		$q->bindParam(':address', $address);
		$q->bindParam(':password', $password);
		$q->bindParam(':username', $username);
		$q->bindParam(':now', $now);

		if ($q->execute()) {
			?>
			<div class="alert alert-success">
			Staff account successfully created
			</div>
			<?php
		}else{
			?>
			<div class="alert alert-danger">
			Unable to create staff. Please try again later
			</div>
			<?php
		}

	}

}
//Adding new staff

if(isset($_POST['r_staff_id'])) {

    $id = secureTxt($_POST['r_staff_id']);

    $q = $conn->prepare("DELETE FROM staff WHERE id = :id");
    $q->bindParam(':id', $id);

    if($q->execute()) {
        ?>
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
			<span>
			<strong>Staff account successfully removed</strong></span>
        </div>
        <?php
    }else{
        ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
			<span>
			<strong>Unable to remove staff account</strong></span>
        </div>
        <?php
    }

}
// Remove staff


if(isset($_POST['approve'])) {
    $id = secureTxt($_POST['id']);

    $q = $conn->prepare("UPDATE staff SET suspend = 0 WHERE id = :id");
    $q->bindParam(':id', $id);

    if($q->execute()){
        ?>
        <div class="alert alert-success">
            <strong>Account successfully approved</strong>
        </div>
        <?php
    }else{
        ?>
        <div class="alert alert-danger">
            <strong>Unable to approve account</strong>
        </div>
        <?php
    }

}elseif(isset($_POST['suspend'])) {
    $id = secureTxt($_POST['id']);

    $q = $conn->prepare("UPDATE staff SET suspend = 1 WHERE id = :id");
    $q->bindParam(':id', $id);

    if($q->execute()){
        ?>
        <div class="alert alert-success">
            <strong>Account successfully suspended</strong>
        </div>
        <?php
    }else{
        ?>
        <div class="alert alert-danger">
            <strong>Unable to suspend account</strong>
        </div>
        <?php
    }

}
// Approve and Suspend account

if (isset($_POST['e_staff_name'])) {

	$name = secureTxt($_POST['e_staff_name']);
	$phone = secureTxt($_POST['e_staff_phone']);
	$email = secureTxt($_POST['e_staff_email']);
	$role = secureTxt($_POST['e_staff_role']);
	$address = secureTxt($_POST['e_staff_address']);
	$id = secureTxt($_POST['e_staff_id']);

	$q = $conn->prepare("UPDATE staff SET name = :name, phone = :phone, email = :email, role = :role, address = :address WHERE id = :id");
	$q->bindParam(':name', $name);
	$q->bindParam(':phone', $phone);
	$q->bindParam(':email', $email);
	$q->bindParam(':address', $address);
	$q->bindParam(':role', $role);
	$q->bindParam(':id', $id);

	if ($q->execute()) {
		?>
		<div class="alert alert-success">
		Staff account successfully updated
		</div>
		<?php
	}else{
		?>
		<div class="alert alert-danger">
		Unable to update staff account
		</div>
		<?php
	}
	
}
// Edit staff account

?>
								</div>
									<div class="col-md-5 col-sm-4">
										<div class="slimScrollDiv" style="position: relative; overflow: auto; width: auto; height: 800px;"><div class="scroller" style="max-height: 800px; overflow: hidden; width: auto; height: 800px;" data-always-visible="0" data-rail-visible="0" data-handle-color="#dae3e7" data-initialized="1">
											<div class="todo-tasklist">
											<?php
											if ($_SESSION['logged_staff'] == 'admin') {
												$q = $conn->prepare("SELECT * FROM staff WHERE username != 'admin' ORDER BY id DESC");
											}else{
												$q = $conn->prepare("SELECT * FROM staff WHERE username != 'admin' AND id != :staff_id ORDER BY id DESC");
												$q->bindParam(':staff_id', $staff_id);
											}
											$q->execute();
											if ($q->rowCount() > 0) {
												while ($row = $q->fetch()) {
													$name = $row['name'];
													$phone = $row['phone'];
													$email = $row['email'];
													$address = $row['address'];
													$id = $row['id'];
													$role = $row['role'];
													?>
												<div class="todo-tasklist-item todo-tasklist-item-border-<?php
                      if($row['suspend'] == 1) {
                        echo 'red';
                      }else{
                      	echo "blue";
                      }
                      ?>">
												
													<div class="todo-tasklist-item-title">
														 <?php echo $row['name']; 
														 if ($role == 1) {
														 	echo "<small style='font-style: italic; margin-left: 5px;'>(Administrator)</small>";
														 }else{
														 	echo "<small style='font-style: italic; margin-left: 5px;'>(Staff)</small>";
														 }
														 ?> <small class="text-muted pull-right"> <?php echo timeAgo($row['timestamp']); ?></small>
													</div>
													<div class="todo-tasklist-item-text">
														 <?php echo limit_words($row['address'], 8); ?>
													</div>
													<div class="todo-tasklist-controls pull-left">
														<span class="todo-tasklist-date"><i class="fa fa-calendar"></i> <?php
															echo date("F d, Y h:i A", $row['timestamp']);
														?> </span>
														<span class="todo-tasklist-badge badge badge-roundless"><?php echo $row['email']; ?></span>
													</div>
													<div class="btn-group" style="margin-top: 10px;">
											
											<?php
                              if($staff_role == 2) {
                                  ?>
                                  <a class="btn red" href="#removeStaff" data-toggle="modal" onclick="$('#r_staff_id').val('<?php echo $id; ?>');">
											Remove <i class="fa fa-trash m-t-xs"></i>
											</a>
											<a class="btn green" href="#editStaff" onclick="$('#ee_staff_name').text('<?php echo $name; ?>'); $('#e_staff_address').val('<?php echo $address; ?>'); $('#e_staff_id').val('<?php echo $id; ?>'); $('#e_staff_phone').val('<?php echo $phone; ?>'); $('#e_staff_email').val('<?php echo $email; ?>'); $('#e_staff_name').val('<?php echo $name; ?>');" data-toggle="modal">
											Edit <i class="fa fa-edit"></i>
											</a>
                                  <form class="inline" action="" method="post">
                                      <?php
                                      if($row['suspend'] == 0) {
                                          ?>
                                          <button type="submit" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" name="suspend" value="1" class="inline btn btn-md yellow m-t-xs"> Suspend <i class="fa fa-ban m-t-xs"></i></button>
                                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                          <?php
                                      }else{
                                          ?>
                                          <button type="submit" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" name="approve" value="1" class="inline btn btn-md dark m-t-xs"> Approve <i class="fa fa-check m-t-xs"></i></button>
                                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                          <?php
                                      }
                                      ?>
                                  </form>
                                  <?php
                              }
                              ?>
											</div>
												</div>
													<?php
												}
											}else{
												?>
												<div class="todo-tasklist-item todo-tasklist-item-border-green">
													<div class="todo-tasklist-item-title">
														 No staff account created
													</div>
												</div>
												<?php
											}
											?>
												
											</div>
										</div>
                    <div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 555.074px; background: rgb(218, 227, 231);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
									</div>
									<div class="todo-tasklist-devider">
									</div>
									<div class="col-md-7 col-sm-8">
										<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;"><div class="scroller" style="max-height: 800px; overflow: hidden; width: auto; height: 800px;" data-always-visible="0" data-rail-visible="0" data-handle-color="#dae3e7" data-initialized="1">
											<form action="" method="POST" class="form-horizontal staff-form">
											<h3>Add New Staff</h3>
											<div class="staff-response"></div>
												<div class="form-group">
													<div class="col-md-12">
														<input type="text" class="form-control todo-taskbody-tags" required id="name" name="name" placeholder="Full Name">
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12">
														<input type="text" class="form-control todo-taskbody-tags" required id="username" name="username" placeholder="Username">
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12">
														<input type="password" class="form-control todo-taskbody-tags" required id="password" name="password" placeholder="Password">
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12">
														<input type="email" class="form-control todo-taskbody-tags" id="email" name="email" placeholder="Email Address">
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12">
														<input type="text" class="form-control todo-taskbody-tags" id="phone" name="phone" placeholder="Phone Number">
													</div>
												</div>
												<div class="form-group">
														<div class="col-md-12">
															<textarea class="form-control todo-taskbody-taskdesc" name="address" id="address" rows="3" placeholder="Address"></textarea>
														</div>
													</div>
												<div class="form-group">
													<div class="col-md-12">
														<label for="role">Administrative Role</label>
														<select name="role" id="role" class="form-control">
															<option value="1">Administrator</option>
															<option value="0">Staff</option>
														</select>
													</div>
												</div>
												<div class="form-actions right todo-form-actions">
														<button type="submit" class="btn btn-circle btn-md blue">Add Staff</button>
                            <button type="reset" onclick="$('#name').focus()" class="btn btn-circle btn-md btn-default green-haze">Reset</button>
													</div>
											</form>
										</div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 583.942px; background: rgb(218, 227, 231);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
									</div>
								</div>
							</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
