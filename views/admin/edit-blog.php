
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
				<h1>Edit Blog</h1>
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
			<?php
			
			$a = secureTxt($_GET['id']);

												if(isset($_POST['blogs'])){
													$title = secureTxt($_POST['title']);
													$blog = $_POST['blog'];
													$time = time();
													if(empty($_FILES['file']['name'])){
													$file = $_POST['pix'];
													$q = $conn->prepare("UPDATE blog SET title = :title, thumbnail =:file, blog=:blog WHERE id= :id");

													$q->bindParam(':title', $title);
													$q->bindParam(':file', $file);
													$q->bindParam(':blog', $blog);
													$q->bindParam(':id', $a);
								 
													if ($q->execute()) {
													  ?>
												<div class="alert alert-success" >
												  <strong>The article has been updated.</strong><br>
												  </div>
													<?php
													   
													} else {
														
														 ?>
												<div class="alert alert-danger" >
												  <strong>Sorry, there was an error updating this article.</strong><br>
												  </div>
													<?php
													}
													
													}
													else
													{
													$file = time().$_FILES['file']['name'];
													$target_dir = "../img/blog/";
													$target_file = $target_dir .time(). basename($_FILES["file"]["name"]);
													$uploadOk = 1;
													$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);               
												 // Check if image file is a actual image or fake image
												 
													  $check = getimagesize($_FILES["file"]["tmp_name"]);
													  if($check != false) {
														  
														  $uploadOk = 1;
													  } else {
														   ?>
												<div class="alert alert-danger" >
												  <strong>File is not an image.</strong><br>
												  </div>
													<?php
														  $uploadOk = 0;
													  }
												  
												// Check file size
												if ($_FILES["file"]["size"] > 5000000) {
												   
													 ?>
												<div class="alert alert-danger" >
												  <strong>Sorry, your file is too large.</strong><br>
												  </div>
													<?php
													$uploadOk = 0;
												}
												// Allow certain file formats
												if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
												&& $imageFileType != "gif" ) {
													
													 ?>
												<div class="alert alert-danger" >
												  <strong>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</strong><br>
												  </div>
													<?php

													$uploadOk = 0;
												}
												// Check if $uploadOk is set to 0 by an error
												if ($uploadOk == 0) {
												   
													?>
												<div class="alert alert-danger" >
												  <strong>Sorry, your file was not uploaded.</strong><br>
												  </div>
													<?php
												// if everything is ok, try to upload file


												} else {
													$q = $conn->prepare("UPDATE blog SET title =:title, thumbnail=:file, blog=:blog WHERE id = :id");

													$q->bindParam(':title', $title);
													$q->bindParam(':file', $file);
													$q->bindParam(':blog', $blog);
													$q->bindParam(':id', $a);
								 
													if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) && $q->execute()) {
													  ?>
												<div class="alert alert-success" >
												  <strong>The article has been uploaded.</strong><br>
												  </div>
													<?php
													   
													} else {
														
														 ?>
												<div class="alert alert-danger" >
												  <strong>Sorry, there was an error update this article</strong><br>
												  </div>
													<?php
													}
												}
													}
												}


	$ab = $conn->prepare("SELECT * FROM blog WHERE id = ".$a."");
	$ab->execute();
	
	if ($ab->rowCount() > 0) {
		$read = $ab->fetch();
	}else{
		header("location: blog");
	}

												?>
				<div class="col-md-6 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div style="min-height:600px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Article</span>
								
							</div>
							<div class="actions">
								
							</div>
						</div>
						<div class="portlet-body form ">
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal form-row-stripped">
											
											<div class="form-body ">
											
											<div class="form-group">
													<label class="control-label col-md-3">Blog Title</label>
													<div class="col-md-8">
														<input type="text" value="<?php echo $read['title'];?>" name="title" required placeholder="Title of blog article...." class="form-control"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Thumbnail</label>
													<div class="col-md-8">
													<div class="fileinput fileinput-new input-group" data-provides="fileinput">
													<div class="form-control" data-trigger="fileinput">
													<i class="glyphicon glyphicon-file fileinput-exists"></i> 
													<span class="fileinput-filename"></span>
													</div>
													<span class="input-group-addon btn btn-primary btn-input  btn-file">
													<span class="fileinput-new">Photo</span>
													<span class="fileinput-exists">Change</span>
													<input type="file"  id="pic" name="file">
													<input type="hidden" value="<?php echo $read['thumbnail'];?>" id="pic" name="pix">
													</span>
													<a href="#" class="input-group-addon btn btn-primary btn-input fileinput-exists" data-dismiss="fileinput">Delete</a>
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Description</label>
													<div class="col-md-8">
															<textarea required name="blog" id="text" class="form-control summernote" rows="6"><?php echo $read['blog'];?></textarea>
										
													</div>
												</div>
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-8">
														<button type="submit" name="blogs" class="btn btn-block green"><i class="fa fa-check"></i> Submit</button>
													</div>
												</div>
											</div>
										</form>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
				<div class="col-md-6">
					<!-- BEGIN PORTLET-->
					<div style="height:600px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Content</span>
								
							</div>
							<div class="actions">
								
							</div>
						</div>
						<div class="portlet-body form ">
							<div class="scroller" style="height:400px; padding-top:10px" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								<div class="general-item-list">
								
									<div class="item media">
										<a class="pull-left" href="javascript:;">
											<img style="width:75px;height:60px" class="img-responsive img-rounded img-thumbnail" src="../img/blog/<?php echo $read['thumbnail'];?>">
											
										</a>
										<div class="media-body">
										<p class="media-heading"><a href="#" class="item-name primary-link"><?php echo $read['title'];?></a>
											<small class="pull-right"><span class="item-status"><span class="badge badge-empty badge-success"></span> Created <?php timeAgo($read['timestamp']);?></span></small>
										</p>
										<p>
										<?php echo $read['blog'];?>
										<div class="clearfix"></div>
										</p>
										
										
										
										<p class="btn-group">
										</p>
										</div>
									</div>
																		
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
