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
				<h1><small>Product</small></h1>
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
			<div class="col-xs-12">
				<?php
	$a = secureTxt($_GET['id']);
												if(isset($_POST['blogs'])){
													$title = secureTxt($_POST['title']);
													$blog = $_POST['blog'];
													$price = secureTxt($_POST['price']);
													$c_price = secureTxt($_POST['c_price']);
													$discount = secureTxt($_POST['discount']);
													$time = time();

				  
                  $d = $conn->prepare("DELETE FROM product_category WHERE product_id = :id");
                  $d->bindParam(':id', $_GET['id']);
                  $d->execute();

                  if (isset($_POST['category'])) {

                    foreach ($_POST['category'] as $key => $value) {

                      $q2 = $conn->prepare("INSERT INTO product_category (product_id, category_id) VALUES (:p_id, :cat_id)");
                      $q2->bindParam(':p_id', $_GET['id']);
                      $q2->bindParam(':cat_id', $value);
                      $q2->execute();

                    }

                  }

													if(empty($_FILES['file']['name'])){
													$file = $_POST['pix'];
													$q = $conn->prepare("UPDATE products SET name = :title, thumbnail =:file, description=:blog, price=:price, cost_price = :c_price, discount = :discount WHERE id= :id");

													$q->bindParam(':title', $title);
													$q->bindParam(':file', $file);
													$q->bindParam(':blog', $blog);
													$q->bindParam(':c_price', $c_price);
													$q->bindParam(':discount', $discount);
													$q->bindParam(':price', $price);
													$q->bindParam(':id', $a);
								 
													if ($q->execute()) {
													  ?>
												<div class="alert alert-success" >
												  <strong>Product has been successfully updated</strong><br>
												  </div>
													<?php
													   
													} else {
														
														 ?>
												<div class="alert alert-danger" >
												  <strong>Sorry, there was an error updating this product</strong><br>
												  </div>
													<?php
													}
													
													}
													else
													{
													$rand = rand(675437, 999009);
													$file = time(). $rand . ".jpg";
													$target_dir = "../img/product/";
													$target_file = $target_dir .$file;
													$uploadOk = 1;
													$imageFileType = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);               
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
													$q = $conn->prepare("UPDATE products SET name =:title, thumbnail=:file, description=:blog, price=:price, cost_price = :c_price, discount = :discount WHERE id = :id");

													$q->bindParam(':title', $title);
													$q->bindParam(':file', $file);
													$q->bindParam(':c_price', $c_price);
													$q->bindParam(':discount', $discount);
													$q->bindParam(':price', $price);
													$q->bindParam(':blog', $blog);
													$q->bindParam(':id', $a);
								 
													if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) && $q->execute()) {
													  ?>
												<div class="alert alert-success" >
												  <strong>Product has been successfully updated</strong><br>
												  </div>
													<?php
													   
													} else {
														
														 ?>
												<div class="alert alert-danger" >
												  <strong>Sorry, there was an error updating this product</strong><br>
												  </div>
													<?php
													}
												}
													}
												}

												$ab = $conn->prepare("SELECT * FROM products WHERE id = ".$a."");
	$ab->execute();
	$read = $ab->fetch();

												?>
			</div>
				<div class="col-md-6 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div style="height:670px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">product details</span>
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
									/*$per_page = 6;
									$pages_query = $conn->query("SELECT COUNT('id') FROM blog");
									$pages = ceil($pages_query->fetchColumn()/$per_page);
									$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;
									$start = ($pg - 1) * $per_page;*/?>
			  
								
									<div class="row it<?php echo $read['id'];?>">
										<div class="col-md-5 blog-img blog-tag-data">
											<img src="../img/product/<?php echo $read['thumbnail'];?>" alt="" class="img-responsive">
											<ul class="list-inline">
												<li>
													<i class="fa fa-calendar"></i>
													<span>
														<?php
															echo date("F d, Y", $read['timestamp']);
														?>
													</span>
												</li>
												
											</ul>
											
										</div>
										<div class="col-md-7 blog-article">
											<h4 class="media-heading">
											<a href="../product-details?id=<?php echo $read['id'];?>" target="_blank">
											<?php
												echo $read['name'];
											?>
											</a>
											<?php
											if ($read['discount'] != 0) {
												echo "<span style='margin-left: 20px;' class='label label-warning'>".$read['discount']."% discount</span>";
											}
											?>
											</h4>
											<p>
												<?php
													echo substr($read['description'],0,300);
												?>
												<div class="clearfix"></div>
											</p>
											
											<p>
											<?php

								$d = $conn->prepare("SELECT * FROM product_category WHERE product_id = :id");
								$d->bindParam(':id', $read['id']);
								$d->execute();

								if ($d->rowCount()) {

								?>
									<?php
									$i = 0;
									while ($cat = $d->fetch()) {
								$i++;
								$c = $conn->prepare("SELECT * FROM categories WHERE id = :id");
								$c->bindParam(':id', $cat['category_id']);
								$c->execute();
								$cc = $c->fetch();

								?>
								<a href="../shop?cat=<?php echo $cat['category_id']; ?>" style="font-size: 14px; font-weight: bold;" target="_blank"><?php echo $cc['name']; ?></a><?php if ($i != $d->rowCount()) {
									echo ", ";
								} ?>
								<?php

									}
								}
									 ?>
											</p>
											<h2>&#x20A6;<?php echo number_format($read['price']);  if ($read['cost_price'] != 0) {
												echo "<del style='margin-left: 20px; color: #606060;'>&#x20A6;".number_format($read['cost_price'])."</del>";
											}?></h2>
											</div>
										</div>
										
									</div>
									<hr class="it<?php echo $read['id'];?>">
									
									
								
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
				
					<div class="col-md-6 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div style="height:670px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Edit Product</span>
								
							</div>
							<div class="actions">
								
							</div>
						</div>
						<div class="portlet-body form ">
						<div class="scroller" style="height: 570px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
							
						<div class="col-md-12">
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal form-row-stripped">
											
											<div class="form-body ">
											
										
											<div class="form-group">
													<label class="control-label ">Product Title</label>
													<input type="text" name="title" required placeholder="Title...." value="<?php echo $read['name']?>" class="form-control"/>
											</div>
											<div class="form-group">
				<label>Product Category</label>
        <br>
<?php
$q2 = $conn->prepare("SELECT * FROM categories ORDER BY name ASC");
$q2->execute();

$p_cat = array();

while ($row2 = $q2->fetch()) {

  $q22 = $conn->prepare("SELECT * FROM product_category WHERE product_id = :id");
  $q22->bindParam(':id', $read['id']);
  $q22->execute();

while ($nm = $q22->fetch()) {
  array_push($p_cat, $nm['category_id']);
}

  $cc = array_unique($p_cat, SORT_REGULAR);

  ?>
  <label style="font-weight: lighter;">
      <input type="checkbox" name="category[]" <?php
      if(in_array($row2['id'], $cc)){
          echo "checked";
      }
       ?> value="<?php echo $row2['id']; ?>">
      <?php echo $row2['name']; ?>
    </label><br>
  <?php
}
//print_r($cc);
?>
				</div>

  				<div class="form-group">
													<label class="control-label ">Cost Price</label>
													<input type="number" min="1" name="c_price" placeholder="Cost price" value="<?php echo $read['cost_price']?>" class="form-control"/>
											</div>
											<div class="form-group">
													<label class="control-label ">Selling Price</label>
													<input type="number" min="1" name="price" required placeholder="Selling price" value="<?php echo $read['price']?>" class="form-control"/>
											</div>

											<div class="form-group">
													<label class="control-label ">Discount</label>
													<input type="number" min="1" name="discount" placeholder="Percentage discount" value="<?php echo $read['discount']?>" class="form-control"/>
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
													<input type="file" id="pic" name="file">
													<input type="hidden" id="pic" name="pix" value="<?php echo $read['thumbnail']?>">
													</span>
													<a href="#" class="input-group-addon btn btn-primary btn-input fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-trash"></span></a>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">Description</label>
														<textarea required name="blog" id="text" class="form-control" rows="6"><?php echo $read['description']?></textarea>
												</div>
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="">
														<button type="submit" name="blogs" class="btn green btn-lg btn-block"><i class="fa fa-check"></i> Save Changes</button>
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
