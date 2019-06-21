
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Products</h1>
			</div>
			<!-- END PAGE TITLE -->
            <div class="page-title pull-right">
                <button class="btn btn-primary" data-target="#addModal" data-toggle="modal">New Product</button>
            </div>
			
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
		<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row margin-top-10">
			<div class="col-md-12 col-xs-12">
            <?php

            if (isset($_POST['edit'])) {
                if (!isset($_POST['category'])) {
                    respond::alert('warning', '', 'Product category is required');
                }else {
                    product::edit($_POST['id'], $_POST['title'], $_POST['category'], $_POST['price'], $_POST['c_price'], $_POST['discount'], $_FILES['file'], $_POST['description']);
                }
            }// Edit product

            if(isset($_POST['add'])){
                if (!isset($_POST['category'])) {
                    respond::alert('warning', '', 'Product category is required');
                }else {
                    product::add($_POST['title'], $_POST['category'], $_POST['price'], $_POST['c_price'], $_POST['discount'], $_FILES['file'], $_POST['description']);
                }
            }// Add new product

            if (isset($_POST['remove'])) {
                product::remove($_POST['id']);
            }// Remove product

            if (isset($_POST['addGallery'])) {

                if (!isset($_FILES['files'])) {
                    respond::alert('warning', '', 'An image must be selected to add to product gallery');
                }else {
                    gallery::add($_POST['id'], $_FILES['files']);
                }

            }// Add image to gallery

            if (isset($_POST['removeImage'])) {
                gallery::remove($_POST['id']);
            }// Remove image gallery

            ?>
            </div>
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div style="min-height:670px" class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">Available products</span>
								<span class="caption-helper hide">weekly stats...</span>
							</div>
							<div class="actions">
							<div style="height:auto; text-align:center;background:#d6e9c6;padding:5px; width:auto;display:none" class="notif"></div>
							
							</div>
						</div>
						<div class="portlet-body">
							<div data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								
							<div class="row">
						<div class="col-md-12 blog-page">
							<div class="row">
								<div class="col-md-12 col-sm-12 article-block">
									<h1 style="margin-top:0px"></h1>
									<?php

                                    $products = product::all();

                                    if ($products) {

//                                        $per_page = 10;
//                                        $pages_query = $db->query("SELECT COUNT('id') FROM products");
//                                        $pages = ceil(count($pages_query)/$per_page);
//                                        $pg = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
//                                        $start = ($pg - 1) * $per_page;

                                        foreach ($products as $product) {
                                            $id = $product['id'];
                                            $name = $product['name'];
                                            $discount = $product['discount'];
                                            $description = $product['description'];
                                            $cost_price = $product['cost_price'];
                                            $price = $product['price'];
                                            ?>
                                            <div class="row">
                                                <div class="col-md-3 blog-img blog-tag-data">
                                                    <img src="<?php echo config::baseUploadProductUrl().$product['thumbnail']; ?>" alt="" style="max-height: 200px;" class="img-responsive">
                                                    <ul class="list-inline">
                                                        <li>
                                                            <i class="fa fa-calendar"></i>
                                                            <span>
														<?php
                                                        echo date("F d, Y", $product['timestamp']);
                                                        ?>
													</span>
                                                        </li>

                                                    </ul>

                                                </div>
                                                <div class="col-md-9 blog-article">
                                                    <h4 class="media-heading">
                                                        <a href="../shop/product/<?php echo $product['slug']; ?>" target="_blank">
                                                            <?php
                                                            echo $product['name'];
                                                            ?>
                                                        </a>
                                                        <?php
                                                        if ($discount != 0) {
                                                            echo "<span style='margin-left: 20px;' class='label label-warning'>".$discount."% discount</span>";
                                                        }
                                                        ?>
                                                    </h4>
                                                    <p>
                                                        <?php
                                                        echo substr($description,0,100);
                                                        ?>
                                                    <div class="clearfix"></div>
                                                    </p>
                                                    <p>
                                                        <?php

                                                        $categories = $db->query("SELECT * FROM product_category WHERE product_id = :id", array('id' => $id));

                                                        if ($categories) {

                                                            ?>
                                                            <?php
                                                            $i = 0;
                                                            $count = count($categories);

                                                            foreach ($categories as $category) {
                                                                $i++;
                                                                $cat = $db->query("SELECT id, name FROM categories WHERE id = :id", array('id' => $category['category_id']), false);

                                                                ?>
                                                                <a href="../shop?cat=<?php echo $cat['id']; ?>" style="font-size: 14px; font-weight: bold;"><?php echo $cat['name']; ?></a>
                                                                <?php if ($i != $count) {
                                                                    echo ", ";
                                                                } ?>
                                                                <?php

                                                            }
                                                        }
                                                        ?>
                                                    </p>
                                                    <p>&#x20A6;<?php echo number_format($price); if ($cost_price != 0) {
                                                            echo "<del style='margin-left: 20px; color: #606060;'>&#x20A6;".number_format($cost_price)."</del>";
                                                        }?></p>
                                                    <div class="row">
                                                        <?php

                                                        $galleries = gallery::all($id);

                                                        if ($galleries) {

                                                            foreach ($galleries as $gallery) {
                                                                $gallery_id = $gallery['id'];
                                                                ?>
                                                                <div class="col-xs-4 col-md-2" style="margin-bottom: 20px;">
                                                                    <a href="<?php echo config::baseUploadProductGalleryUrl().$gallery['image']; ?>" data-lightbox="gallery<?php echo $id; ?>">
                                                                        <img class="thumbnail" src="<?php echo config::baseUploadProductGalleryUrl().$gallery['image']; ?>" alt="<?php echo $product['name']; ?>" style="margin-bottom: 0px; height: 100px; width: 100px; object-fit: scale-down;">
                                                                    </a>
                                                                    <button class="btn red btn-xs" style="width: 100px;" data-toggle="modal" data-target="#removeGalleryModal" onclick="$('.gallery_id').val('<?php echo $gallery_id; ?>');">
                                                                        Remove <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                                <?php
                                                            }

                                                        }else {
                                                            respond::alert('info', '', 'No image has been added to gallery');
                                                        }

                                                        ?>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button class="btn blue" data-toggle="modal" data-target="#addGalleryModal" onclick="$('.product_id').val('<?php echo $id; ?>');">
                                                            Add Image <i class="fa fa-image"></i>
                                                        </button>
                                                        <button class="btn green" data-toggle="modal" data-target="#editModal" onclick="$('.product_id').val('<?php echo $id; ?>'); $('#name').val('<?php echo $name; ?>'); $('#description').load('include/load_description.php', {'id': <?php echo $id; ?>, 'table': 'products'}); $('#category').load('include/load_categories.php', {'id': <?php echo $id; ?>}); $('#price').val('<?php echo $price; ?>'); $('#cost_price').val('<?php echo $cost_price; ?>'); $('#discount').val('<?php echo $discount; ?>');">
                                                            Edit <i class="m-icon-swapright m-icon-white"></i>
                                                        </button>
                                                        <button class="btn red" data-toggle="modal" data-target="#removeModal" onclick="$('.product_id').val('<?php echo $id; ?>');">
                                                            Delete <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr>
                                            <?php
                                        }

                                        ?>
<!--                                        <ul class="pagination pull-right">-->
<!--                                            <li class="--><?php //if($pg == 1){echo "disabled";}?><!--">-->
<!--                                                <a href="admin/products--><?php //if($pg > 1){ echo "?page=",$pg - 1;} else{}?><!--">-->
<!--                                                    <i class="fa fa-angle-left"></i>-->
<!--                                                </a>-->
<!--                                            </li>-->
<!--                                            --><?php
//                                            if($pages >= 1 && $pg <= $pages){
//                                                for($x=1;$x<=$pages;$x++){
//                                                    echo ($x==$pg) ? '<li class="active"><a href="?page='.$x.'" >'.$x.'</a></li>' : '<li><a href="?page='.$x.'" class="">'.$x.'</a></li>';
//
//                                                }
//                                            }
//                                            ?>
<!--                                            <li>-->
<!--                                                <a href="admin/products--><?php //if($pg){ echo "?page=",$pg + 1;}else{}?><!--">-->
<!--                                                    <i class="fa fa-angle-right"></i>-->
<!--                                                </a>-->
<!--                                            </li>-->
<!--                                        </ul>-->
                                    <?php

                                    }else {
                                        respond::alert('info', '', 'No product has been added');
                                    }

									?>


								</div>
								<!--end col-md-9-->

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



    <!-- Add Product Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">New Product</h4>
                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label class="control-label ">Product Title</label>
                            <input type="text" name="title" required placeholder="Product Title" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Product Category</label>
                            <br>
                            <?php
                            $categories = category::all();
                            if ($categories) {
                                foreach ( $categories as $category) {
                                    $id = $category['id'];
                                    $name = $category['name'];
                                    ?>
                                    <label style="font-weight: lighter;">
                                        <input type="checkbox" name="category[]" value="<?php echo $id; ?>"><?php echo $name; ?></label><br>
                                    <?php
                                }
                            }else{
                                respond::alert('info', '', 'Create a category before adding product');
                            }
                            ?>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ">Selling Price</label>
                                    <input type="number" min="1" required name="price" placeholder="Unit price" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ">Cost Price</label>
                                    <input type="number" name="c_price" placeholder="Cost price" class="form-control"/>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label ">Discount</label>
                            <input type="number" name="discount" placeholder="Percentage discount" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Product Image</label>
                            <input type="file" required class="form-control btn btn-primary" name="file">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea required name="description" id="text" class="form-control" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="add">Add Product</button>
                        <button type="button" class="btn red" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Product</h4>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" class="product_id" name="id">

                        <div class="form-group">
                            <label class="control-label ">Product Title</label>
                            <input type="text" id="name" name="title" required placeholder="Product Title" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Product Category</label>
                            <br>
                            <div id="category"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ">Selling Price</label>
                                    <input type="number" id="price" min="1" required name="price" placeholder="Unit price" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ">Cost Price</label>
                                    <input type="number" id="cost_price" name="c_price" placeholder="Cost price" class="form-control"/>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label ">Discount</label>
                            <input type="number" id="discount" name="discount" placeholder="Percentage discount" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Product Image</label>
                            <input type="file" class="form-control btn btn-primary" name="file">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea required name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="edit">Save Changes</button>
                        <button type="button" class="btn red" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Remove Product Modal -->
    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Remove Product</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" class="product_id">
                        <p align="center">Are you sure you want to remove this product?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="remove">Remove Product</button>
                        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Remove Product Gallery Image Modal -->
    <div class="modal fade" id="removeGalleryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Remove Image</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" class="gallery_id">
                        <p align="center">Are you sure you want to remove this image from gallery?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="removeImage">Remove Image</button>
                        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Product Gallery Add Modal -->
    <div class="modal fade" id="addGalleryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Product Gallery</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" class="product_id">
                        <div class="form-group">
                            <label class="control-label">Gallery Images</label>
                            <input type="file" multiple class="form-control btn btn-primary" name="files[]" required>
                            <p>Multiple images can be selected</p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="addGallery">Add Image(s)</button>
                        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>