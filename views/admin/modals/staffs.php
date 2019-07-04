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
                            <option value="1" selected>Tailor</option>
                            <option value="2" >designer</option>
                            <option value="3" >manager</option>
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
                    <div class="col-md-12 form-group mb-3">
                        <label for="">Address</label>
                        <input type="text" name="address" placeholder="Address" class="staff_address form-control">
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