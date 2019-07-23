<?php
$year = date("Y");
$months = array(
    'jan',
    'feb',
    'mar',
    'apr',
    'may',
    'jun',
    'jul',
    'aug',
    'sep',
    'oct',
    'nov',
    'dec',
);
$data1 = array();
$data1 = $months;
$data2 = [];
$data3 = [];
foreach($months as $key => $value)
{
    $results = $db->query("SELECT id FROM orders WHERE month = :month AND year = :year", array('month' => $value, 'year' => $year));
    $count = count($results);
    $data2[] = $count;

    $results2 = $db->query("SELECT id FROM customers WHERE month = :month AND year = :year", array('month' => $value, 'year' => $year));
    $count2 = count($results2);
    $data3[] = $count2;

}
?>
<div class="u-body">
  <!-- Doughnut Chart -->
  <div class="row">
    <div class="col-sm-6 col-xl-3 mb-4">
      <div class="card">
        <div class="card-body media align-items-center px-xl-3">

          <div class="media-body" style="text-align: center;">
            <h5 class="h6 text-muted text-uppercase mb-2">
              Total Income
            </h5>
            <span class="h2 mb-0">
                <?php
                $tot = order::totalSales();
                if($tot){
                    foreach($tot as $total){
                        $total_qty = $total['SUM(cost)'];
                    ?>
                        <?= '₦' . number_format($total_qty); ?>
                <?php
                    }
                }
                ?>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3 mb-4">
      <div class="card">
        <div class="card-body media align-items-center px-xl-3">

          <div class="media-body" style="text-align: center;">
            <h5 class="h6 text-muted text-uppercase mb-2">
              Customers
            </h5>
            <span class="h2 mb-0"><?= count(customer::all()); ?></span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3 mb-4">
      <div class="card">
        <div class="card-body media align-items-center px-xl-3">

          <div class="media-body" style="text-align: center;">
            <h5 class="h6 text-muted text-uppercase mb-2">
              Orders
            </h5>
            <span class="h2 mb-0"><?= count(order::all()); ?></span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3 mb-4">
      <div class="card">
        <div class="card-body media align-items-center px-xl-3">

          <div class="media-body" style="text-align: center;">
            <h5 class="h6 text-muted text-uppercase mb-2">
              Expenses
            </h5>
            <span class="h2 mb-0">
                <?php
                $tot = expense::totalExpense();
                if($tot){
                    foreach($tot as $total){
                        $total_qty = $total['SUM(cost)'];
                        ?>
                        <?= '₦' . number_format($total_qty); ?>
                        <?php
                    }
                }
                ?>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Doughnut Chart -->

  <!-- Overall Income -->
  <div class="card mb-4">
    <!-- Card Header -->
    <header class="card-header d-md-flex align-items-center">
      <h2 class="h3 card-header-title">Overall Count</h2>

      <!-- Nav Tabs -->
      <ul id="overallIncomeTabsControl" class="nav nav-tabs card-header-tabs ml-md-auto mt-3 mt-md-0">
        <li class="nav-item mr-4">
          <a class="nav-link active" href="#overallIncomeTab1" role="tab" aria-selected="true" data-toggle="tab">
<!--            <span class="d-none d-md-inline">Last</span>-->
<!--            7 days-->
          </a>
        </li>
      </ul>
      <!-- End Nav Tabs -->
    </header>
    <!-- End Card Header -->

    <!-- Card Body -->
    <div class="card-body">
      <div class="tab-content" id="overallIncomeTabs">
        <!-- Tab Content -->
        <div class="tab-pane fade show active" id="overallIncomeTab1" role="tabpanel">
          <div class="row">
            <!-- Chart -->
            <div class="col-md-9 mb-4 mb-md-0" style="min-height: 300px;">
              <canvas class="js-overall-income-chart" width="1000" height="300"></canvas>
            </div>
            <!-- End Chart -->

            <div class="col-md-3">
                <!-- Active Users -->
                <div>
                    <div class="media align-items-center">
                        <div class="media-body d-flex align-items-baseline">
                            <span class="u-indicator u-indicator--xxs bg-primary mr-2"></span>
                            <h5 class="h6 text-muted text-uppercase mb-1">Total Orders</h5>
                        </div>
                    </div>

                    <span class="h3 mb-0"><?= count(order::all()); ?></span>
                </div>
                <!-- End Active Users -->
                <hr>
              <!-- Total Installs -->
              <div>
                <div class="media align-items-center">
                  <div class="media-body d-flex align-items-baseline">
                    <span class="u-indicator u-indicator--xxs bg-secondary mr-2"></span>
                    <h5 class="h6 text-muted text-uppercase mb-1">Total Customers</h5>
                  </div>
                </div>

                <span class="h3 mb-0"><?= count(customer::all()); ?></span>
              </div>
              <!-- End Total Installs -->

            </div>
          </div>
        </div>
        <!-- End Tab Content -->
      </div>
    </div>
    <!-- End Card Body -->
  </div>
  <!-- End Overall Income -->

  <!-- Current Projects -->
  <div class="row">
    <!-- Current Projects -->
    <div class="col-md-7 mb-4 mb-md-0">
      <div class="card h-100">
        <header class="card-header d-flex align-items-center">
          <h2 class="h3 card-header-title">Latest Orders</h2>
        </header>

        <div class="card-body">
          <div class="d-flex justify-content-between mb-4">
            <div>
                <span class="d-none d-lg-block text-muted small text-uppercase mb-1">Total Orders</span>
                <span class="h4 text-primary"><?= count(order::all()); ?></span>
            </div>

            <div class="divider divider-vertical mx-2"></div>

            <div>
              <span class="d-none d-lg-block text-muted small text-uppercase mb-1">Pending</span>
              <span class="h4 text-info">
                  <?php
                  $id = 1;
                  echo count(order::get_status_orders($id));
                  ?>
              </span>
            </div>

            <div class="divider divider-vertical mx-2"></div>

            <div>
              <span class="d-none d-lg-block text-muted small text-uppercase mb-1">Finishing</span>
              <span class="h4 text-warning">
                  <?php
                  $id = 4;
                  echo count(order::get_status_orders($id));
                  ?>
              </span>
            </div>

            <div class="divider divider-vertical mx-2"></div>

            <div>
              <span class="d-none d-lg-block text-muted small text-uppercase mb-1">Delivered</span>
              <span class="h4 text-success">
                  <?php
                  $id = 5;
                  echo count(order::get_status_orders($id));
                  ?>
              </span>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-active text-muted">
              <tr class="small text-muted text-uppercase">
                <th>Customer Name</th>
                <th>Timestamp</th>
                <th>Budget</th>
                <th>Status</th>
              </tr>
              </thead>

              <tbody>
              <?php
              $orders = order::all();
              if($orders)
              {
                  foreach(array_slice($orders, 0, 4) as $order)
                  {
                      $name = $order['customer_name'];
                      $cost = $order['cost'];
                      $photo = $order['photo'];
                      $time = $order['timestamp'];
                      $status = $order['status_name'];

              ?>
                  <tr>
                    <td class="align-middle">
                      <div class="media align-items-center">
                        <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="">
                        <div class="media-body">
                          <h4 class="mb-0"><?= $name; ?></h4>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle font-weight-semibold"><?= request::timeago($time); ?>
                    </td>
                    <td class="align-middle font-weight-semibold"><?= '₦' . number_format($cost); ?></td>
                      <?php
                      if($status == 'Pending')
                      {
                          ?>
                          <td class="align-middle font-weight-semibold"><a class="badge badge-soft-info" href="#"><?= $status; ?></a></td>
                          <?php
                      }elseif($status == 'Digitalizing') {
                          ?>
                          <td class="align-middle font-weight-semibold"><a class="badge badge-soft-secondary" href="#"><?= $status; ?></a></td>
                          <?php
                      }elseif($status == 'Machine Processing')
                      {
                          ?>
                          <td class="align-middle font-weight-semibold"><a class="badge badge-soft-warning" href="#"><?= $status; ?></a></td>
                          <?php
                      }elseif($status == 'Finishing')
                      {
                          ?>
                          <td class="align-middle font-weight-semibold"><a class="badge badge-soft-primary" href="#"><?= $status; ?></a></td>
                          <?php
                      }elseif($status = 'Delivered')
                      {
                          ?>
                          <td class="align-middle font-weight-semibold"><a class="badge badge-soft-success" href="#"><?= $status; ?></a></td>
                          <?php
                      }
                      ?>
                  </tr>
              <?php
                  }
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>

        <footer class="card-footer">
          <a class="u-link u-link--primary" href="admin/orders">All Orders</a>
        </footer>
      </div>
    </div>
    <!-- End Current Projects -->

    <!-- Comments -->
    <div class="col-md-5">
      <div class="card h-100">
        <header class="card-header d-md-flex align-items-center">
          <h2 class="h3 card-header-title">Activities</h2>

          <!-- Nav Tabs -->
          <!-- End Nav Tabs -->
        </header>

        <div class="card-body p-0 m-0">
          <div class="tab-content" id="commentsTabs">
            <!-- Tabs Content -->
            <div class="tab-pane fade show active" id="commentsTab1" role="tabpanel">
              <div class="list-group list-lg-group list-group-flush">
                <!-- Comment -->
                  <?php
                  $activities = activity::all();

                  foreach(array_slice($activities,0,5) as $activity) {
                      $order_id = $activity['order_id'];
                      $category_id = $activity['category_id'];
                      $name = $activity['name'];
                      $photo = $activity['photo'];
                      $comment = $activity['comment'];
                      $timestamp = $activity['timestamp'];

                      if ($category_id != 4) {
                          if($comment == config::noteActivity())
                          {
                              ?>
                              <a class="list-group-item list-group-item-action" href="admin/orders/<?= $order_id; ?>/details">
                                  <div class="media">
                                      <?php
                                      if(!empty($photo))
                                      {
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                          <?php
                                      }else{
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                          <?php
                                      }
                                      ?>
                                      <div class="media-body">
                                          <div class="d-md-flex align-items-center">
                                            <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New Note</span></h4>
                                              <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                          </div>

                                          <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                      </div>
                                  </div>
                              </a>
                              <?php
                          }elseif($comment == config::orderActivity())
                          {
                              ?>
                              <a class="list-group-item list-group-item-action" href="admin/orders/<?= $order_id; ?>/details">
                                  <div class="media">
                                      <?php
                                      if(!empty($photo))
                                      {
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                          <?php
                                      }else{
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                          <?php
                                      }
                                      ?>
                                      <div class="media-body">
                                          <div class="d-md-flex align-items-center">
                                              <h4 class="mb-1"><span class="badge badge-soft-primary mx-1">New Order</span></h4>
                                              <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                          </div>

                                          <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                      </div>
                                  </div>
                              </a>
                              <?php
                          }elseif($comment == config::customerActivity())
                          {
                              ?>
                              <a class="list-group-item list-group-item-action" href="admin/customers">
                                  <div class="media">
                                      <?php
                                      if(!empty($photo))
                                      {
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                          <?php
                                      }else{
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                          <?php
                                      }
                                      ?>
                                      <div class="media-body">
                                          <div class="d-md-flex align-items-center">
                                              <h4 class="mb-1"><span class="badge badge-soft-success mx-1">New Customer</span></h4>
                                              <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                          </div>

                                          <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                      </div>
                                  </div>
                              </a>
                              <?php
                          }elseif($comment == config::staffActivity())
                          {
                              ?>
                              <a class="list-group-item list-group-item-action" href="admin/account?name=<?= $name; ?>">
                                  <div class="media">
                                      <?php
                                      if(!empty($photo))
                                      {
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                          <?php
                                      }else{
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                          <?php
                                      }
                                      ?>
                                      <div class="media-body">
                                          <div class="d-md-flex align-items-center">
                                              <h4 class="mb-1"><span class="badge badge-soft-secondary mx-1">New Staff</span></h4>
                                              <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                          </div>

                                          <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                      </div>
                                  </div>
                              </a>
                              <?php
                          }elseif($comment == config::paymentActivity())
                          {
                              ?>
                              <a class="list-group-item list-group-item-action" href="admin/transactions/payment">
                                  <div class="media">
                                      <?php
                                      if(!empty($photo))
                                      {
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                          <?php
                                      }else{
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                          <?php
                                      }
                                      ?>
                                      <div class="media-body">
                                          <div class="d-md-flex align-items-center">
                                              <h4 class="mb-1"><span class="badge badge-soft-success mx-1">New Payment</span></h4>
                                              <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                          </div>

                                          <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                      </div>
                                  </div>
                              </a>
                              <?php
                          }elseif($comment == config::expenseActivity())
                          {
                              ?>
                              <a class="list-group-item list-group-item-action" href="#">
                                  <div class="media">
                                      <?php
                                      if(!empty($photo))
                                      {
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                          <?php
                                      }else{
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                          <?php
                                      }
                                      ?>
                                      <div class="media-body">
                                          <div class="d-md-flex align-items-center">
                                              <h4 class="mb-1"><span class="badge badge-soft-danger mx-1">New Expense</span></h4>
                                              <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                          </div>

                                          <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                      </div>
                                  </div>
                              </a>
                              <?php
                          }elseif($comment == config::orderUpdateActivity())
                          {
                              ?>
                              <a class="list-group-item list-group-item-action" href="admin/orders/<?= $order_id; ?>/details">
                                  <div class="media">
                                      <?php
                                      if(!empty($photo))
                                      {
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                          <?php
                                      }else{
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                          <?php
                                      }
                                      ?>
                                      <div class="media-body">
                                          <div class="d-md-flex align-items-center">
                                              <h4 class="mb-1"><span class="badge badge-soft-warning mx-1">New Order Update</span></h4>
                                              <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                          </div>

                                          <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                      </div>
                                  </div>
                              </a>
                              <?php
                          }elseif($comment == config::staffUpdateActivity())
                          {
                              ?>
                              <a class="list-group-item list-group-item-action" href="admin/account?name=<?= $name; ?>">
                                  <div class="media">
                                      <?php
                                      if(!empty($photo))
                                      {
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                          <?php
                                      }else{
                                          ?>
                                          <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                          <?php
                                      }
                                      ?>
                                      <div class="media-body">
                                          <div class="d-md-flex align-items-center">
                                              <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New staff Update</span></h4>
                                              <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                          </div>

                                          <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                      </div>
                                  </div>
                              </a>
                              <?php
                          }
                          if($role == 1)
                          {
                              if($category_id == 4)
                              {
                                  ?>
                                  <a class="list-group-item list-group-item-action" href="admin/account?name=admin">
                                      <div class="media">
                                          <?php
                                          if(!empty($photo))
                                          {
                                              ?>
                                              <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                              <?php
                                          }else{
                                              ?>
                                              <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                              <?php
                                          }
                                          ?>
                                          <div class="media-body">
                                              <div class="d-md-flex align-items-center">
                                                  <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New Salary Expense</span></h4>
                                                  <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                              </div>

                                              <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                          </div>
                                      </div>
                                  </a>
                                  <?php
                              }
                          }
                      }
                  }
                  ?>
                <!-- End Comment -->
              </div>
            </div>
            <!-- End Tabs Content -->
          </div>
        </div>

        <footer class="card-footer">
          <a class="u-link u-link--primary" href="admin/activities">All activities</a>
        </footer>
      </div>
    </div>
    <!-- End Comments -->
  </div>
  <!-- End Current Projects -->
</div>

