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
				<h1>New Blog <small>write a new article</small></h1>
			</div>
			<!-- END PAGE TITLE -->
			
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
		<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row margin-top-10">
				<div class="col-md-6 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div style="height:670px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Latest Blog Articles</span>
								<span class="caption-helper hide">weekly stats...</span>
							</div>
							<div class="actions">
							<div style="height:auto; text-align:center;background:#d6e9c6;padding:5px; width:auto;display:none" class="notif"></div>
							
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 550px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								
							<div class="row">
						<div class="col-md-12 blog-page">
							<div class="row">
								<div class="col-md-12 col-sm-12 article-block">
									<h1 style="margin-top:0px"></h1>
									<?php
									$per_page = 6;
									$pages_query = $conn->query("SELECT COUNT('id') FROM blog");
									$pages = ceil($pages_query->fetchColumn()/$per_page);
									$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;
									$start = ($pg - 1) * $per_page;
			  
									$bg = $conn->prepare("SELECT * FROM blog ORDER BY id DESC LIMIT ".$start.",".$per_page."");
									$bg->execute();
									while($blog = $bg->fetch()){
									?>
									<div class="row it<?php echo $blog['id'];?>">
										<div class="col-md-3 blog-img blog-tag-data">
											<img src="./assets/admin/pages/media/blog/<?php echo $blog['thumbnail'];?>" alt="" class="img-responsive">
											<ul class="list-inline">
												<li>
													<i class="fa fa-calendar"></i>
													<a href="javascript:;">
														<?php
															echo date("F d, Y", $blog['timestamp']);
														?>
													</a>
												</li>
												
											</ul>
											
										</div>
										<div class="col-md-9 blog-article">
											<h4 class="media-heading">
											<a href="javascript:;">
											<?php
												echo $blog['title'];
											?>
											</a>
											</h4>
											<p>
												<?php
													echo substr($blog['blog'],0,700);
												?>
												<div class="clearfix"></div>
											</p>
											<div class="btn-group">
											<a class="btn red blogDel" id="<?php echo $blog['id'];?>" href="javascript:;">
											Delete
											</a>
											<a class="btn green" href="edit-blog?id=<?php echo $blog['id'];?>">
											Edit <i class="m-icon-swapright m-icon-white"></i>
											</a>
											</div>
										</div>
										
									</div>
									<hr class="it<?php echo $blog['id'];?>">
									<?php }?>
									
								
								</div>
								<!--end col-md-9-->
								
							</div>
							<?php
							/*
							
							<ul class="pagination pull-right">
								<li class="<?php if($pg == 1){echo "disabled";}?>">
									<a href="blog<?php if($pg > 1){ echo "?pg=",$pg - 1;} else{}?>">
									<i class="fa fa-angle-left"></i>
									</a>
								</li>
								<?php 
									if($pages >= 1 && $pg <= $pages){
										for($x=1;$x<=$pages;$x++){
											echo ($x==$pg) ? '<li class="active"><a href="?pg='.$x.'" >'.$x.'</a></li>' : '<li><a href="?pg='.$x.'" class="">'.$x.'</a></li>';
								  
										}
									}
								?>
								<li>
									<a href="blog<?php if($pg){ echo "?pg=",$pg + 1;}else{}?>">
									<i class="fa fa-angle-right"></i>
									</a>
								</li>
							</ul>
							*/
							?>
						</div>
					</div>
						</div>
					</div>
					</div>
					<!-- END PORTLET-->
				</div>
					<div class="col-md-6 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div style="height:670px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Blog Article</span>
								
							</div>
							<div class="actions">
								
							</div>
						</div>
						<div class="portlet-body form ">
						<div class="scroller" style="height: 600px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
							
						<div class="col-md-12">
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal form-row-stripped">
											
											<div class="form-body ">
											
											<div class="form-group">
												<?php
												if(isset($_POST['blogs'])){
													$title = secureTxt($_POST['title']);
													$blog = $_POST['blog'];
													$file = time().$_FILES['file']['name'];
													$target_dir = "assets/admin/pages/media/blog/";
													$time = time();
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
													$q = $conn->prepare("INSERT INTO blog (title, thumbnail, blog, timestamp) VALUES (:title, :file, :blog, :date)");

													$q->bindParam(':title', $title);
													$q->bindParam(':file', $file);
													$q->bindParam(':blog', $blog);
													$q->bindParam(':date', $time);
								 
													if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) && $q->execute()) {
													  ?>
												<div class="alert alert-success" >
												  <strong>The file has been uploaded.</strong><br>
												  </div>
													<?php
													   
													} else {
														
														 ?>
												<div class="alert alert-danger" >
												  <strong>Sorry, there was an error uploading your file.</strong><br>
												  </div>
													<?php
													}
												}
												
												}?>
											</div>
										
											<div class="form-group">
													<label class="control-label ">Blog Title</label>
													<input type="text" name="title" required placeholder="Title of blog article...." class="form-control"/>
											</div>
												<div class="form-group">
													<label class="control-label">Thumbnail</label>
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
														<textarea required name="blog" class="form-control" rows="6"></textarea>
												</div>
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="">
														<button type="submit" name="blogs" class="btn green btn-lg btn-block"><i class="fa fa-check"></i> Submit</button>
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
