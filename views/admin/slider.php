
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Slider</h1>
            </div>
            <div class="page-title pull-right">
                <button class="btn btn-primary" data-target="#addModal" data-toggle="modal">New Slider</button>
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
                <div class="col-md-12 col-xs-12">
                    <?php
                    if(isset($_POST['add'])){
                        slider::add($_POST['title'], $_POST['link'], $_POST['description'], $_FILES['file']);
                    }
                    // add category

                    if(isset($_POST['edit'])){
                        slider::edit($_POST['id'], $_POST['title'], $_POST['link'], $_POST['description'], $_FILES['file']);
                    }
                    // Edit slider

                    if (isset($_POST['remove'])) {
                        slider::remove($_POST['id']);
                    }// Remove slider

                    ?>
                </div>
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div style="min-height:670px" class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject theme-font bold uppercase">Available Sliders</span>
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

                                                $sliders = slider::all();
                                                if ($sliders) {

                                                    foreach ( $sliders as $slider) {
                                                        $id = $slider['id'];
                                                        $title = $slider['title'];
                                                        $link = $slider['link'];
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-md-3 blog-img blog-tag-data">
                                                                <img src="<?php echo config::baseUploadSliderUrl().$slider['image']; ?>" alt="" style="max-height: 200px;" class="img-responsive">
                                                                <ul class="list-inline">
                                                                    <li>
                                                                        <i class="fa fa-calendar"></i>
                                                                        <a href="javascript:;">
                                                                            <?php
                                                                            echo date("F d, Y", $slider['timestamp']);
                                                                            ?>
                                                                        </a>
                                                                    </li>

                                                                </ul>

                                                            </div>
                                                            <div class="col-md-9 blog-article">
                                                                <h4 class="media-heading">
                                                                    <a href="<?php echo $slider['link']; ?>" target="_blank">
                                                                        <?php
                                                                        echo $slider['title'];
                                                                        ?>
                                                                    </a>
                                                                </h4>
                                                                <p>
                                                                    <?php
                                                                    echo substr($slider['description'],0,100);
                                                                    ?>
                                                                <div class="clearfix"></div>
                                                                </p>

                                                                <div class="btn-group">
                                                                    <button class="btn red" data-toggle="modal" data-target="#removeModal" onclick="$('.slider_id').val('<?php echo $id; ?>');">
                                                                        Delete
                                                                    </button>
                                                                    <button class="btn green" data-target="#editModal" onclick="$('.slider_title').val('<?php echo $title; ?>'); $('.slider_link').val('<?php echo $link; ?>'); $('.slider_description').load('include/load_description.php', {'id': <?php echo $id; ?>, 'table': 'sliders'}); $('.slider_id').val('<?php echo $id; ?>');" data-toggle="modal">
                                                                        Edit <i class="m-icon-swapright m-icon-white"></i>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <hr>
                                                        <?php
                                                    }

                                                }else {
                                                    respond::alert('info', '', 'No slider has been created');
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


    <!-- Add Slider Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">New Slider</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ">Title</label>
                                    <input type="text" name="title" required placeholder="Slider Title" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ">Link</label>
                                    <input type="url" name="link" placeholder="Link to direct button to" class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input type="file" required id="pic" class="form-control btn btn-primary" name="file">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea required name="description" id="text" placeholder="Description of slider" class="form-control" rows="6"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="add">Add Slider</button>
                        <button type="button" class="btn red" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Slider Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><span id="category_title"></span> Category</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" class="slider_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ">Title</label>
                                    <input type="text" name="title" required placeholder="Slider Title" class="form-control slider_title"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ">Link</label>
                                    <input type="url" name="link" placeholder="Link to direct button to" class="form-control slider_link"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input type="file" id="pic" class="form-control btn btn-primary" name="file">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea required name="description" placeholder="Description of category" class="form-control slider_description" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="edit">Save Changes</button>
                        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Remove Slider Modal -->
    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Remove Slider</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" class="slider_id">
                        <p align="center">Are you sure you want to remove this slider?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="remove">Remove Slider</button>
                        <button type="button" class="btn red" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>