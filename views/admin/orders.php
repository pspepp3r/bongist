<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Orders</h1>
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
			
			<div class="portlet light">
				<div class="portlet-body">
								<div class="row">
								<div class="col-xs-12">
<?php
if (isset($_POST['delete'])) {
                  $id = secureTxt($_POST['form_remove']);
                  $q = $conn->prepare("DELETE FROM orders WHERE order_id = :numb");
                  $q->bindParam(':numb', $id);

                  if ($q->execute()) {
                    ?>
                <div class="alert alert-success">
                  <strong>Order has been successfully removed</strong><br>
                  </div>
                    <?php
                  }else{
                ?>
                <div class="alert alert-danger">
                  <strong>Unable to remove order</strong><br>
                  </div>
                    <?php
                  }

                }
?>
			</div>
									<div class="col-md-4 col-sm-3">
										<div class="slimScrollDiv" style="position: relative; overflow: auto; width: auto; height: 800px;"><div class="scroller" style="max-height: 800px; overflow: hidden; width: auto; height: 800px;" data-always-visible="0" data-rail-visible="0" data-handle-color="#dae3e7" data-initialized="1">
											<div class="todo-tasklist">
											<?php

                                            $orders = order::all();
                                            
                                            if ($orders) {

                                                foreach ($orders as $order) {
                                                    $order_id = $order['order_id']
                                                    ?>
                                                <div class="order-item todo-tasklist-item todo-tasklist-item-border-<?php
                                                if ($order['status'] == 1) {
                                                    echo 'blue';
                                                }else{
                                                    echo 'red';
                                                }
                                                ?>" data-id="<?php echo $order_id; ?>" data-role="<?php echo $staff_role; ?>" onclick="$(this).removeClass('todo-tasklist-item-border-red'); $(this).addClass('todo-tasklist-item-border-blue');">
                                                    <i class="fa fa-shopping-cart pull-left" style="font-size: 20px; margin-top: 5px;"></i>
                                                    <div class="todo-tasklist-item-title">

                                                        <span style="color: #fd6600; text-transform: uppercase;"><?php echo $order['order_id']; ?></span> <span class="pull-right" style="font-size: 12px; font-weight: 200;"><?php echo request::timeAgo($order['timestamp']); ?></span>

                                                    </div>
                                                    <div class="todo-tasklist-item-text">
                                                        <?php echo $order['email']; ?>
                                                    </div>
                                                    <div class="todo-tasklist-controls pull-left">
														<span class="todo-tasklist-date"><i class="fa fa-calendar"></i> <?php
                                                            echo date("F d, Y h:i A", $order['timestamp']);
                                                            ?> </span>
                                                        <span class="todo-tasklist-badge badge badge-roundless"><?php echo $order['fname'].' '.$order['lname']; ?></span>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                                
                                            }else {
                                                respond::alert('info', '', 'No customer order has been created');
                                            }
											
											?>
												
											</div>
										</div>
                    <div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 555.074px; background: rgb(218, 227, 231);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
									</div>
									<div class="todo-tasklist-devider">
									</div>
									<div class="col-md-8 col-sm-7">
										<div class="order-response"></div>
										
										<div id="order_load"></div>

									</div>
								</div>
							</div>



			</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>

	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<script>

</script>
