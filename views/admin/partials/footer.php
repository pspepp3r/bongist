<!-- Location Modal -->
<div class="modal fade" id="locationsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delivery Location</h4>

      </div>
      <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
      <center>
        <div class="alert alert-info" id="loc_notify" style="display: none;">Loading Delivery Locations...</div>
      </center>
      <span id="delivery_load"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-target="#addLocation" data-toggle="modal">Add Delivery Location</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Location Modal -->
                <div class="modal fade" id="addLocation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="include/add_location.php" class="location-form">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Delivery Location</h4>
      </div>
      <div class="modal-body">
      <span class="location-response"></span>
        <div class="form-group">
          <label for="location_name">Location Name</label>
          <input type="text" required id="location_name" placeholder="Delivery Location" class="form-control">
        </div>
        <div class="form-group">
          <label for="location_cost">Delivery Cost</label>
          <div class="input-icon">
                                <i style="font-style: normal; margin-top: 7px;">₦</i>
          <input type="number" required id="location_cost" placeholder="Cost of Delivery" class="form-control todo-taskbody-due">
                              </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Location</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Remove Location Modal -->
<div class="modal fade" id="removeLocation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remove Location</h4>

      </div>
      <div class="modal-body">
      <center>
        <p class="remove-response">Are you sure you want to remove this delivery location?</p>
      </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="removeBtn" class="btn btn-primary">Remove</button>
      </div>
    </div>
  </div>
</div>

<!-- Remove Order Modal -->
                <div class="modal fade bs-example-modal-sm" id="delOrder" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                <div class="modal-content" style="">

                <form action="" method="post">
                <div class="modal-header" style="padding: 5px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <center><h4 class="modal-title" id="mySmallModalLabel">Remove order</h4></center>
                </div>
                <div class="modal-body">
                <p>Are you sure you want to remove this order?</p>
                <input type="hidden" id="form_remove" name="form_remove" />
                <center>
                <button class="btn btn-primary" id="submitRemove" type="submit" name="delete">Yes</button> <button class="btn btn-danger" data-dismiss="modal">No</button>
                </center>
                </div>
                </form>

                </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
                </div>

                <!-- Remove Staff Modal -->
                <div class="modal fade bs-example-modal-sm" id="removeStaff" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                <div class="modal-content" style="">

                <form action="" method="post">
                <div class="modal-header" style="padding: 5px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <center><h4 class="modal-title" id="mySmallModalLabel">Remove staff</h4></center>
                </div>
                <div class="modal-body">
                <p>Are you sure you want to remove this staff?</p>
                <input type="hidden" id="r_staff_id" name="r_staff_id">
                <center>
                <button class="btn btn-primary" id="submitRemove" type="submit" name="delete">Yes</button> <button class="btn btn-danger" data-dismiss="modal">No</button>
                </center>
                </div>
                </form>

                </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
                </div>

                <!-- passwordModal -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="include/password.php" class="password-form">
      	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
      <span class="password-response"></span>
        <div class="form-group">
        <input type="hidden" id="pwd-user" value="<?php echo $user; ?>">
        	<label for="password">New Password</label>
        	<input type="password" required id="password" class="form-control">
        </div>
        <div class="form-group">
        	<label for="repeat_password">Repeat Password</label>
        	<input type="password" required id="repeat_password" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-block">Update Password</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit cat Modal -->
<div class="modal fade" id="editCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" enctype="multipart/form-data" method="POST">
      	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center>
		<h4 class="modal-title">Edit <span id="ee_title"></span></h4>
        </center>
      </div>
      <div class="modal-body">
        <div class="form-group">
        <input type="hidden" id="e_id" name="e_id">
													<label class="control-label ">Title</label>
													<input type="text" id="e_title" name="e_title" required placeholder="" class="form-control"/>
											</div>
											
												<div class="form-group">
													<label class="control-label">Image</label>
												<div class="fileinput fileinput-new input-group" data-provides="fileinput">
													<div class="form-control" data-trigger="fileinput">
													<i class="glyphicon glyphicon-file fileinput-exists"></i> 
													<span class="fileinput-filename"></span>
													</div>
													<span class="input-group-addon btn btn-primary btn-input  btn-file">
													<span class="fileinput-new">Photo</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" id="pic" name="file">
													</span>
													<a href="#" class="input-group-addon btn btn-primary btn-input fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-trash"></span></a>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">Description</label>
														<textarea required name="e_description" id="e_description" class="form-control" rows="6"></textarea>
												</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Edit staff Modal -->
<div class="modal fade" id="editStaff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" method="POST">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center>
    <h4 class="modal-title">Edit <span id="ee_staff_name"></span> account</h4>
        </center>
      </div>
      <div class="modal-body">
        <input type="hidden" id="e_staff_id" name="e_staff_id">
        <div class="form-group">
                            <input type="text" class="form-control todo-taskbody-tags" required id="e_staff_name" name="e_staff_name" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control todo-taskbody-tags" id="e_staff_email" name="e_staff_email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control todo-taskbody-tags" id="e_staff_phone" name="e_staff_phone" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                              <textarea class="form-control todo-taskbody-taskdesc" name="e_staff_address" id="e_staff_address" rows="3" placeholder="Address"></textarea>
                          </div>
                        <div class="form-group">
                            <label for="role">Administrative Role</label>
                            <select name="e_staff_role" id="e_staff_role" class="form-control">
                              <option value="1">Administrator</option>
                              <option value="0">Staff</option>
                            </select>
                        </div>
                      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Slider Modal -->
<div class="modal fade" id="sliderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" enctype="multipart/form-data" method="POST">
      	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center>
		<h4 class="modal-title">Edit Slider</h4>
        </center>
      </div>
      <div class="modal-body">
      <input type="hidden" name="slider_id" id="slider_id">
											
												<div class="form-group">
													<label class="control-label">Slider Image</label>
												<div class="fileinput fileinput-new input-group" data-provides="fileinput">
													<div class="form-control" data-trigger="fileinput">
													<i class="glyphicon glyphicon-file fileinput-exists"></i> 
													<span class="fileinput-filename"></span>
													</div>
													<span class="input-group-addon btn btn-primary btn-input  btn-file">
													<span class="fileinput-new">Photo</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" required id="pic" name="file">
													</span>
													<a href="#" class="input-group-addon btn btn-primary btn-input fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-trash"></span></a>
													</div>
												</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- add cat Modal -->
<div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" enctype="multipart/form-data" method="POST">
      	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center>
		<h4 class="modal-title">Add New Category</h4>
        </center>
      </div>
      <div class="modal-body">
        <div class="form-group">
													<label class="control-label ">Title</label>
													<input type="text" name="title" required placeholder="" class="form-control"/>
											</div>
											
												<div class="form-group">
													<label class="control-label">Image</label>
												<div class="fileinput fileinput-new input-group" data-provides="fileinput">
													<div class="form-control" data-trigger="fileinput">
													<i class="glyphicon glyphicon-file fileinput-exists"></i> 
													<span class="fileinput-filename"></span>
													</div>
													<span class="input-group-addon btn btn-primary btn-input  btn-file">
													<span class="fileinput-new">Photo</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" required id="pic" name="file">
													</span>
													<a href="#" class="input-group-addon btn btn-primary btn-input fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-trash"></span></a>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">Description</label>
														<textarea required name="cat_desc" id="text" class="form-control" rows="6"></textarea>
												</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Category</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- offer Modal -->
<div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" enctype="multipart/form-data" method="POST">
      	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center>
		<h4 class="modal-title">Update Offer</h4>
        </center>
      </div>
      <div class="modal-body">
        <div class="form-group">
				<label class="control-label ">Title</label>
				<input type="text" id="offer_title" name="title" required placeholder="" class="form-control"/>
				<input type="hidden" name="offer_id" id="offer_id" class="form-control"/>
		</div>
		<div class="form-group">
				<label class="control-label ">Title Colour</label>
				<input type="color" id="t_color" name="t_color" required placeholder="" class="form-control"/>
		</div>
        <div class="form-group">
				<label class="control-label ">Caption</label>
				<input type="text" id="offer_caption" name="caption" required placeholder="" class="form-control"/>
		</div>
		<div class="form-group">
				<label class="control-label ">Caption Colour</label>
				<input type="color" id="c_color" name="c_color" required placeholder="" class="form-control"/>
		</div>

		<div class="form-group">
				<label class="control-label ">Link</label>
				<input type="url" id="link" name="link" required placeholder="example: http://souvenirmartfze.com" class="form-control"/>
		</div>

		<div class="form-group" id="p_caption" style="display: none;">
				<label class="control-label ">Promotional caption</label>
				<input type="text" id="offer_plus" name="plus" placeholder="" class="form-control"/>
		</div>
											
		<div class="form-group">
			<label class="control-label">Image</label>
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
			<i class="glyphicon glyphicon-file fileinput-exists"></i> 
			<span class="fileinput-filename"></span>
			</div>
			<span class="input-group-addon btn btn-primary btn-input  btn-file">
			<span class="fileinput-new">Photo</span>
			<span class="fileinput-exists">Change</span>
			<input type="file" id="pic" name="file">
			</span>
			<a href="#" class="input-group-addon btn btn-primary btn-input fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-trash"></span></a>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="container">
		<?php echo date("Y");?> &copy; Developed by <a href="http://codekago.com" title="" target="_blank">Codekago Interactive</a>
	</div>
</div>
<div class="scroll-to-top">
	<i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="assets/admin/pages/scripts/ui-toastr.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/global/scripts/script.js" type="text/javascript"></script>
<script src="assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout2/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/index3.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/inbox.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/form-samples.js"></script>

<script src="assets/js/lightbox.min.js"></script>


<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/admin/pages/scripts/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="assets/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
   <!-- <script src="tinymce/js/tinymce/tinymce.min.js"></script> -->
<!--    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
<script>
$(document).ready(function() {
  $('.summernote').summernote({                // set editor height
  minHeight: 400                // set focus to editable area after initializing summernote
});
});

</script> -->
    <!-- <script>
      tinymce.init({
      selector: '#text',  // change this value according to your HTML
      theme:'modern',
      setup: function(editor){
      editor.on("change", function(){
      editor.save();
      })
      }
      });
    $(".fileinput").fileinput();
        
    </script> -->
<script>
jQuery(document).ready(function() {
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Login.init();
   Demo.init(); // init demo(theme settings page)
   QuickSidebar.init(); // init quick sidebar
   Index.init(); // init index page
   Tasks.initDashboardWidget(); // init tash dashboard widget
   FormSamples.init();
});
</script>
<!-- END JAVASCRIPTS -->
<script>
 
  $(".notif").hide();
  var del = $(".del");
  $.each(del, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("identifier");
	$(this).removeClass("btn-warning").addClass("btn-danger").prop("disabled", true).html("Deleting....");
	var url = "include/delete.php";
	var data = {gym:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			$(""+resp.data+"").delay(1000).fadeOut();
			$(".notif").fadeIn("slow").html(resp.message).delay(9000).fadeOut("slow");
		} else{
			$(".notif").fadeIn("slow").html(resp.message).delay(9000).fadeOut("slow");
		}
	});
  });
  });
  var bdel = $(".blogDel");
  $.each(bdel, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("id");
	$(this).addClass("btn-warning").prop("disabled", true).html("Deleting....");
	var url = "include/delete.php";
	var data = {blog:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			$(""+resp.data+"").delay(1000).fadeOut();
			$(".notif").fadeIn("slow").html(resp.message).delay(9000).fadeOut("slow");
		} else{
			$(".notif").fadeIn("slow").html(resp.message).delay(9000).fadeOut("slow");
		}
	});
  });
  });
    var bdel = $(".prodDel");
  $.each(bdel, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("id");
	$(this).addClass("btn-warning").prop("disabled", true).html("Deleting....");
	var url = "include/delete.php";
	var data = {prod:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			$(""+resp.data+"").delay(1000).fadeOut();
			$(".notif").fadeIn("slow").html(resp.message).delay(9000).fadeOut("slow");
		} else{
			$(".notif").fadeIn("slow").html(resp.message).delay(9000).fadeOut("slow");
		}
	});
  });
  });

  var cat = $(".catDel");
  $.each(cat, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("id");
	$(this).addClass("btn-warning").prop("disabled", true).html("Deleting....");
	var url = "include/delete.php";
	var data = {cat:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			$(""+resp.data+"").delay(1000).fadeOut();
			$(".notif").fadeIn("slow").html(resp.message).delay(9000).fadeOut("slow");
		} else{
			$(".notif").fadeIn("slow").html(resp.message).delay(9000).fadeOut("slow");
		}
	});
  });
  });

  var slider = $(".sliderDel");
  $.each(slider, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("id");
	$(this).addClass("btn-warning").prop("disabled", true).html("Deleting....");
	var url = "include/delete.php";
	var data = {slider:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			$(""+resp.data+"").delay(1000).fadeOut();
			$(".notif").fadeIn("slow").html(resp.message).delay(9000).fadeOut("slow");
		} else{
			$(".notif").fadeIn("slow").html(resp.message).delay(9000).fadeOut("slow");
		}
	});
  });
  });

  var deluser = $(".deluser");
   $.each(deluser, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("id");
	$(this).prop("disabled", true).html("Deleting....");
	var url = "include/delete.php";
	var data = {user:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			$(""+resp.data+"").delay(1000).fadeOut();
		} else{
			deluser.prop("disabled", true).html("unable to delete...").delay(5000).prop("disabled", false).html("Delete");
		}
	});
  });
  });
  var delorder = $(".delorder");
   $.each(delorder, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("id");
	$(this).prop("disabled", true).html("Deleting....");
	var url = "include/delete.php";
	var data = {order:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			$(""+resp.data+"").delay(1000).fadeOut();
		} else{
			delorder.prop("disabled", true).html("unable to delete...").delay(5000).prop("disabled", false).html("Delete");
		}
	});
  });
  });
    var sususer = $(".sususer");
   $.each(sususer, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("id");
	$(this).prop("disabled", true).html("Processing....");
	var item = $(this);
	var url = "include/delete.php";
	var data = {sus:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			location.reload();
		} else{
			item.prop("disabled", true).html("unable to suspend...").delay(5000).prop("disabled", false).html("Suspend");
		}
	});
  });
  });
  var unsus = $(".unsus");
   $.each(unsus, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("id");
	$(this).prop("disabled", true).html("Processing....");
	var item = $(this);
	var url = "include/delete.php";
	var data = {unsus:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			location.reload();
		} else{
			item.prop("disabled", true).html("unable to unsuspend...").delay(5000).prop("disabled", false).html("Suspended");
		}
	});
  });
  });
    var act = $(".activo");
   $.each(act, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("id");
	$(this).prop("disabled", true).html("Processing....");
	var item = $(this);
	var url = "include/delete.php";
	var data = {act:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			location.reload();
		} else{
			item.prop("disabled", true).html("unable to deactivate...").delay(5000).prop("disabled", false).html("Deactivate");
		}
	});
  });
  });
  var alt = $(".alertClose");
   $.each(alt, function(){
  $(this).click(function(e){
	e.preventDefault;
	var id = $(this).attr("id");
	$(this).prop("disabled", true).html("Processing....");
	var item = $(this);
	var url = "include/delete.php";
	var data = {alt:id};
	$.getJSON(url,data, function(resp){
		
		if(resp.status == 200){
			//console.log(resp.message);
			$(""+resp.data+"").delay(1000).fadeOut();
			$(".notif").fadeIn("slow").html(resp.message).delay(5000).fadeOut("slow");
		} else{
			$(".notif").fadeIn("slow").html(resp.message).delay(5000).fadeOut("slow");
		}
	});
  });
  });
</script>
</body>

<!-- END BODY -->
</html>