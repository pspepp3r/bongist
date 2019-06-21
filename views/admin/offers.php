<link rel="stylesheet" type="text/css" href="../style.css" />
<style>
	body {
		color: #333333;
    font-family: "Open Sans", sans-serif;
	}
</style>
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Offers <small>update promotional offers</small></h1>
			</div>
			<!-- END PAGE TITLE -->
			
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">

		<?php

		if(isset($_POST['offer_id'])){
				$id = secureTxt($_POST['offer_id']);
				$title = secureTxt($_POST['title']);
				$caption = secureTxt($_POST['caption']);
				$t_color = secureTxt($_POST['t_color']);
				$c_color = secureTxt($_POST['c_color']);
				$link = secureTxt($_POST['link']);
				$plus = secureTxt($_POST['plus']);
// echo $plus;

				if(empty($_FILES['file']['name'])){

				$q = $conn->prepare("UPDATE offers SET title = :title, caption = :caption, t_color = :t_color, c_color = :c_color, link = :link, plus = :plus WHERE id= :id");

				$q->bindParam(':title', $title);
				$q->bindParam(':caption', $caption);
				$q->bindParam(':t_color', $t_color);
				$q->bindParam(':link', $link);
				$q->bindParam(':c_color', $c_color);
				$q->bindParam(':plus', $plus);
				$q->bindParam(':id', $id);

				if ($q->execute()) {
				  ?>
			<div class="alert alert-success" >
			  <strong>Offer has been successfully updated</strong><br>
			  </div>
				<?php
				   
				} else {
					
					 ?>
			<div class="alert alert-danger" >
			  <strong>Sorry, there was an error updating this offer</strong><br>
			  </div>
				<?php
				}
				
				}
				else
				{
				$file = time().$_FILES['file']['name'];
				$target_dir = "../img/offers/";
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
			if ($_FILES["file"]["size"] > 50000000) {
			   
				 ?>
			<div class="alert alert-danger" >
			  <strong>Sorry, your file is too large.</strong><br>
			  Max size of 50mb.
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
				$q = $conn->prepare("UPDATE offers SET title = :title, caption = :caption, t_color = :t_color, c_color = :c_color, plus = :plus, link = :link, image = :image WHERE id= :id");

				$q->bindParam(':title', $title);
				$q->bindParam(':caption', $caption);
				$q->bindParam(':image', $file);
				$q->bindParam(':link', $link);
				$q->bindParam(':t_color', $t_color);
				$q->bindParam(':c_color', $c_color);
				$q->bindParam(':plus', $plus);
				$q->bindParam(':id', $id);

				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) && $q->execute()) {
				  ?>
			<div class="alert alert-success" >
			  <strong>Offer has been successfully updated</strong><br>
			  </div>
				<?php
				   
				} else {
					
					 ?>
			<div class="alert alert-danger" >
			  <strong>Sorry, there was an error updating this offer</strong><br>
			  </div>
				<?php
				}
			}
				}
			}

		$q = $conn->prepare("SELECT * FROM offers");
		$q->execute();

		$row = $q->fetchAll(PDO::FETCH_ASSOC);		

			?>

					<div class="row">
			<div class="col-sm-8 offers-left">
				<div class="row">
					<div class="single-offer offer-1 col-sm-6">
						<div class="offer-wrap">
							<a href="#offerModal" data-toggle="modal" class="offer-image" data-id="<?php echo $row[0]['id']; ?>" data-link="<?php echo $row[0]['link']; ?>" data-title="<?php echo $row[0]['title']; ?>" data-caption="<?php echo $row[0]['caption']; ?>" data-t_color="<?php echo $row[0]['t_color']; ?>" data-c_color="<?php echo $row[0]['c_color']; ?>" data-plus="<?php echo $row[0]['plus']; ?>">
							<div style="background-image: url(../img/offers/<?php echo $row[0]['image']; ?>); height: 282px; width: 100%; background-size: cover;"></div></a>
							<div class="offer-brief-1 fix">
								<h1 style="color: <?php echo $row[0]['t_color']; ?>"><?php echo $row[0]['title']; ?></h1>
								<p style="color: <?php echo $row[0]['c_color']; ?>"><?php echo $row[0]['caption']; ?></p>
							</div>
						</div>
					</div>
					<div class="single-offer offer-2 col-sm-6">
						<div class="offer-wrap">
							<a href="#offerModal" data-toggle="modal" class="offer-image" data-id="<?php echo $row[1]['id']; ?>" data-link="<?php echo $row[1]['link']; ?>" data-title="<?php echo $row[1]['title']; ?>" data-caption="<?php echo $row[1]['caption']; ?>" data-t_color="<?php echo $row[1]['t_color']; ?>" data-c_color="<?php echo $row[1]['c_color']; ?>" data-plus="<?php echo $row[1]['plus']; ?>">
							<div style="background-image: url(../img/offers/<?php echo $row[1]['image']; ?>); height: 282px; width: 100%; background-size: cover;"></div></a>
							<div class="offer-brief-2 fix">
								<h1 style="color: <?php echo $row[1]['t_color']; ?>"><?php echo $row[1]['title']; ?></h1>
								<p style="color: <?php echo $row[1]['c_color']; ?>"><?php echo $row[1]['caption']; ?></p>
							</div>
						</div>
					</div>
					<div class="single-offer offer-3 col-sm-12">
						<div class="offer-wrap">
							<a href="#offerModal" data-toggle="modal" class="offer-image" data-id="<?php echo $row[2]['id']; ?>" data-link="<?php echo $row[2]['link']; ?>" data-title="<?php echo $row[2]['title']; ?>" data-caption="<?php echo $row[2]['caption']; ?>" data-t_color="<?php echo $row[2]['t_color']; ?>" data-c_color="<?php echo $row[2]['c_color']; ?>" data-plus="<?php echo $row[2]['plus']; ?>">
							<div style="background-image: url(../img/offers/<?php echo $row[2]['image']; ?>); height: 282px; width: 100%; background-size: cover;"></div></a>
							<div class="offer-brief-3 fix">
								<h1 style="color: <?php echo $row[2]['t_color']; ?>"><?php echo $row[2]['title']; ?></h1>
								<h2 style="color: <?php echo $row[2]['c_color']; ?>"><?php echo $row[2]['caption']; ?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="single-offer offer-4 col-sm-4 offers-right">
				<div class="offer-wrap">
					<a href="#offerModal" data-toggle="modal" class="offer-image" data-id="<?php echo $row[3]['id']; ?>" data-link="<?php echo $row[3]['link']; ?>" data-title="<?php echo $row[3]['title']; ?>" data-caption="<?php echo $row[3]['caption']; ?>" data-t_color="<?php echo $row[3]['t_color']; ?>" data-c_color="<?php echo $row[3]['c_color']; ?>" data-plus="<?php echo $row[3]['plus']; ?>">
							<div style="background-image: url(../img/offers/<?php echo $row[3]['image']; ?>); height: 590px; width: 100%; background-size: cover;"></div></a>
					<div class="offer-brief-4 fix">
					<?php
					if ($row[3]['plus'] != '') {
						?>
					<span class="pro-label offer-label hot-deal "><?php echo $row[3]['plus']; ?></span>
						<?php
					}
					?>
						
						<h1 style="color: <?php echo $row[3]['t_color']; ?>"><?php echo $row[3]['title']; ?></h1>
						<p style="color: <?php echo $row[3]['c_color']; ?>"><?php echo $row[3]['caption']; ?></p>
					</div>
				</div>
			</div>
		</div>
				
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->