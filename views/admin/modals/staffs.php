<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>New Staff</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">

                    <div class="col-md-12 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" required placeholder="Customer Name" class="form-control">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="">Email Address</label>
                        <input type="email" name="email" placeholder="Email Address" class="form-control">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="">Phone Number</label>
                        <input type="number" name="phone" required placeholder="Phone Number" class="form-control">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="">Address</label>
                        <textarea placeholder="Address" name="address" class="form-control" rows="1"></textarea>
                    </div>


                    <div class="col-md-6 form-group mb-3">
                        <label for="">Role</label>
                        <select name="role" id="" class="form-control">
                            <?php
                            $roles = staff::role();

                            foreach($roles as $role)
                            {
                                $role_id = $role['id'];
                                $name = $role['role_type'];
                                ?>
                                <option value="<?= $role_id; ?>"><?= $name; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <input type="password" name="password" placeholder="password" class="form-control">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <input type="file" name="photo" class="form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" name="addStaff" class="btn btn-dark">Add Staff</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Edit Staff-->

<div class="modal fade" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Edit Staff</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="id" class="staff_id">
                    <div class="col-md-12 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" required placeholder="Staff Name" class="staff_name form-control">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label for="">Email Address</label>
                        <input type="email" name="email" placeholder="Email Address" class="staff_email form-control">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="">Phone Number</label>
                        <input type="number" name="phone" required placeholder="Phone Number" class="staff_phone form-control">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="">Address</label>
                        <input type="text" name="address" placeholder="Address" class="staff_address form-control">
                    </div>
                    <div class="col-md-6 form-group mb-3">
<!--                        <label for="">Address</label>-->
                        <input type="file" name="photo" class="staff_photo form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" name="editStaff" class="btn btn-dark">Save Changes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Remove Staff Modal -->
<div class="modal fade" id="removeStaffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="hidden" name="id" class="staff_id">
                            <p class="text-center">
                                Are you sure you want to remove this Staff?
                            </p>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" name="removeStaff" class="btn btn-dark">Remove Staff</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="newPassword">New Password*</label>
            <input type="password" class="form-control" name="newPassword" required id="newPassword" placeholder="Enter New Password">
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password*</label>
            <input type="password" class="form-control" name="confirmPassword" required id="confirmPassword" placeholder="Enter Confirm Password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="changePassword" class="btn btn-dark">Update Password</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
