<div class="u-body">
  <!-- Doughnut Chart -->
  <div class="row">
    <div class="col-sm-6 col-xl-3 mb-4">
      <div class="card">
        <div class="card-body media align-items-center px-xl-3">
          <div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
            <canvas class="js-doughnut-chart" width="70" height="70"
                    data-set="[65, 35]"
                    data-colors='[
                              "#2972fa",
										          "#f6f9fc"
										        ]'></canvas>

            <div class="u-doughnut__label text-info">65</div>
          </div>

          <div class="media-body">
            <h5 class="h6 text-muted text-uppercase mb-2">
              Total Sales <i class="fa fa-arrow-up text-success ml-1"></i>
            </h5>
            <span class="h2 mb-0">
                <?php
                $tot = order::totalSales();
                if($tot){
//                    $total_qty = 0;
                    foreach($tot as $total){
                        $total_qty = $total['SUM(cost)'];
                    ?>
                        <a href=""><?php echo $total_qty; ?></a>
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
          <div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
            <canvas class="js-doughnut-chart" width="70" height="70"
                    data-set="[35, 65]"
                    data-colors='[
                              "#fab633",
										          "#f6f9fc"
										        ]'></canvas>

            <div class="u-doughnut__label text-warning">35</div>
          </div>

          <div class="media-body">
            <h5 class="h6 text-muted text-uppercase mb-2">
              Customers <i class="fa fa-arrow-down text-danger ml-1"></i>
            </h5>
            <span class="h2 mb-0"><?php echo count(customer::all()); ?></span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3 mb-4">
      <div class="card">
        <div class="card-body media align-items-center px-xl-3">
          <div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
            <canvas class="js-doughnut-chart" width="70" height="70"
                    data-set="[60, 40]"
                    data-colors='[
                              "#0dd157",
										          "#f6f9fc"
										        ]'></canvas>

            <div class="u-doughnut__label text-success">60</div>
          </div>

          <div class="media-body">
            <h5 class="h6 text-muted text-uppercase mb-2">
              Orders <i class="fa fa-arrow-up text-success ml-1"></i>
            </h5>
            <span class="h2 mb-0"><?php echo count(order::all()); ?></span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3 mb-4">
      <div class="card">
        <div class="card-body media align-items-center px-xl-3">
          <div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
            <canvas class="js-doughnut-chart" width="70" height="70"
                    data-set="[25, 85]"
                    data-colors='[
                              "#fb4143",
										          "#f6f9fc"
										        ]'></canvas>

            <div class="u-doughnut__label text-danger">25</div>
          </div>

          <div class="media-body">
            <h5 class="h6 text-muted text-uppercase mb-2">
              Cancels <i class="fa fa-arrow-up text-danger ml-1"></i>
            </h5>
            <span class="h2 mb-0">$3,400</span>
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
      <h2 class="h3 card-header-title">Overall Income</h2>

      <!-- Nav Tabs -->
      <ul id="overallIncomeTabsControl" class="nav nav-tabs card-header-tabs ml-md-auto mt-3 mt-md-0">
        <li class="nav-item mr-4">
          <a class="nav-link active" href="#overallIncomeTab1" role="tab" aria-selected="true" data-toggle="tab">
            <span class="d-none d-md-inline">Last</span>
            7 days
          </a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="#overallIncomeTab2" role="tab" aria-selected="false" data-toggle="tab">
            <span class="d-none d-md-inline">Last</span>
            30 days
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#overallIncomeTab3" role="tab" aria-selected="false" data-toggle="tab">
            <span class="d-none d-md-inline">Last</span>
            90 days
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
              <!-- Total Income -->
              <div>
                <div class="media align-items-center">
                  <div class="media-body d-flex align-items-baseline">
                    <span class="u-indicator u-indicator--xxs bg-primary mr-2"></span>
                    <h5 class="h6 text-muted text-uppercase mb-1">Total Income</h5>
                  </div>

                  <div class="d-flex align-items-center h4 text-success">
                    <span>+9.5%</span>
                    <span class="small">
															<i class="fa fa-arrow-up ml-2"></i>
														</span>
                  </div>
                </div>
                <span class="h3 mb-0">$6,400</span>
              </div>
              <!-- End Total Income -->

              <hr>

              <!-- Total Installs -->
              <div>
                <div class="media align-items-center">
                  <div class="media-body d-flex align-items-baseline">
                    <span class="u-indicator u-indicator--xxs bg-secondary mr-2"></span>
                    <h5 class="h6 text-muted text-uppercase mb-1">Total Installs</h5>
                  </div>

                  <div class="d-flex align-items-center h4 text-success">
                    <span>+7.5%</span>
                    <span class="small">
															<i class="fa fa-arrow-up ml-2"></i>
														</span>
                  </div>
                </div>

                <span class="h3 mb-0">1,346,600</span>
              </div>
              <!-- End Total Installs -->

              <hr>

              <!-- Active Users -->
              <div>
                <div class="media align-items-center">
                  <div class="media-body d-flex align-items-baseline">
                    <span class="u-indicator u-indicator--xxs bg-info mr-2"></span>
                    <h5 class="h6 text-muted text-uppercase mb-1">Active Users</h5>
                  </div>

                  <div class="d-flex align-items-center h4 text-danger">
                    <span>-3.5%</span>
                    <span class="small">
															<i class="fa fa-arrow-down ml-2"></i>
														</span>
                  </div>
                </div>

                <span class="h3 mb-0">896,200</span>
              </div>
              <!-- End Active Users -->

              <hr>

              <a class="btn btn-block btn-outline-primary" href="#">Learn More</a>
            </div>
          </div>
        </div>
        <!-- End Tab Content -->

        <!-- Tab Content -->
        <div class="tab-pane fade" id="overallIncomeTab2" role="tabpanel">
          <div class="row">
            <!-- Chart -->
            <div class="col-md-9 mb-4 mb-md-0" style="min-height: 300px;">
              <canvas class="js-overall-income-chart" width="1000" height="300"></canvas>
            </div>
            <!-- End Chart -->

            <div class="col-md-3">
              <!-- Total Income -->
              <div>
                <div class="media align-items-center">
                  <div class="media-body d-flex align-items-baseline">
                    <span class="u-indicator u-indicator--xxs bg-primary mr-2"></span>
                    <h5 class="h6 text-muted text-uppercase mb-1">Total Income</h5>
                  </div>

                  <div class="d-flex align-items-center h4 text-success">
                    <span>+10.4%</span>
                    <span class="small">
															<i class="fa fa-arrow-up ml-2"></i>
														</span>
                  </div>
                </div>
                <span class="h3 mb-0">$48,650</span>
              </div>
              <!-- End Total Income -->

              <hr>

              <!-- Total Installs -->
              <div>
                <div class="media align-items-center">
                  <div class="media-body d-flex align-items-baseline">
                    <span class="u-indicator u-indicator--xxs bg-secondary mr-2"></span>
                    <h5 class="h6 text-muted text-uppercase mb-1">Total Installs</h5>
                  </div>

                  <div class="d-flex align-items-center h4 text-success">
                    <span>+7.9%</span>
                    <span class="small">
															<i class="fa fa-arrow-up ml-2"></i>
														</span>
                  </div>
                </div>

                <span class="h3 mb-0">5,169,854</span>
              </div>
              <!-- End Total Installs -->

              <hr>

              <!-- Active Users -->
              <div>
                <div class="media align-items-center">
                  <div class="media-body d-flex align-items-baseline">
                    <span class="u-indicator u-indicator--xxs bg-info mr-2"></span>
                    <h5 class="h6 text-muted text-uppercase mb-1">Active Users</h5>
                  </div>

                  <div class="d-flex align-items-center h4 text-danger">
                    <span>-2.5%</span>
                    <span class="small">
															<i class="fa fa-arrow-down ml-2"></i>
														</span>
                  </div>
                </div>

                <span class="h3 mb-0">389,545</span>
              </div>
              <!-- End Active Users -->

              <hr>

              <a class="btn btn-block btn-outline-primary" href="#">Learn More</a>
            </div>
          </div>
        </div>
        <!-- End Tab Content -->

        <!-- Tab Content -->
        <div class="tab-pane fade" id="overallIncomeTab3" role="tabpanel">
          <div class="row">
            <!-- Chart -->
            <div class="col-md-9 mb-4 mb-md-0" style="min-height: 300px;">
              <canvas class="js-overall-income-chart" width="1000" height="300"></canvas>
            </div>
            <!-- End Chart -->

            <div class="col-md-3">
              <!-- Total Income -->
              <div>
                <div class="media align-items-center">
                  <div class="media-body d-flex align-items-baseline">
                    <span class="u-indicator u-indicator--xxs bg-primary mr-2"></span>
                    <h5 class="h6 text-muted text-uppercase mb-1">Total Income</h5>
                  </div>

                  <div class="d-flex align-items-center h4 text-success">
                    <span>+12.8%</span>
                    <span class="small">
															<i class="fa fa-arrow-up ml-2"></i>
														</span>
                  </div>
                </div>
                <span class="h3 mb-0">$112,800</span>
              </div>
              <!-- End Total Income -->

              <hr>

              <!-- Total Installs -->
              <div>
                <div class="media align-items-center">
                  <div class="media-body d-flex align-items-baseline">
                    <span class="u-indicator u-indicator--xxs bg-secondary mr-2"></span>
                    <h5 class="h6 text-muted text-uppercase mb-1">Total Installs</h5>
                  </div>

                  <div class="d-flex align-items-center h4 text-success">
                    <span>+8.1%</span>
                    <span class="small">
															<i class="fa fa-arrow-up ml-2"></i>
														</span>
                  </div>
                </div>

                <span class="h3 mb-0">9,151,304</span>
              </div>
              <!-- End Total Installs -->

              <hr>

              <!-- Active Users -->
              <div>
                <div class="media align-items-center">
                  <div class="media-body d-flex align-items-baseline">
                    <span class="u-indicator u-indicator--xxs bg-info mr-2"></span>
                    <h5 class="h6 text-muted text-uppercase mb-1">Active Users</h5>
                  </div>

                  <div class="d-flex align-items-center h4 text-danger">
                    <span>-1.5%</span>
                    <span class="small">
															<i class="fa fa-arrow-down ml-2"></i>
														</span>
                  </div>
                </div>

                <span class="h3 mb-0">3252,191</span>
              </div>
              <!-- End Active Users -->

              <hr>

              <a class="btn btn-block btn-outline-primary" href="#">Learn More</a>
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
                <span class="h4 text-primary"><?php echo count(order::all()); ?></span>
            </div>

            <div class="divider divider-vertical mx-2"></div>

            <div>
              <span class="d-none d-lg-block text-muted small text-uppercase mb-1">Tasks</span>
              <span class="h4 text-info">2,800</span>
            </div>

            <div class="divider divider-vertical mx-2"></div>

            <div>
              <span class="d-none d-lg-block text-muted small text-uppercase mb-1">Complete</span>
              <span class="h4 text-success">1,050</span>
            </div>

            <div class="divider divider-vertical mx-2"></div>

            <div>
              <span class="d-none d-lg-block text-muted small text-uppercase mb-1">In Progress</span>
              <span class="h4 text-warning">1,750</span>
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
                  foreach($orders as $order)
                  {
                      $name = $order['name'];
                      $cost = $order['cost'];
                      $time = $order['timestamp'];
                      $status = $order['status_name'];

              ?>
              <tr>
                <td class="align-middle">
                  <div class="media align-items-center">
                    <div class="u-icon u-icon--sm bg-success text-white rounded-circle mr-3">
                      <i class="fab fa-spotify"></i>
                    </div>

                    <div class="media-body">
                      <h4 class="mb-0"><?php echo $name; ?></h4>
                    </div>
                  </div>
                </td>
                <td class="align-middle font-weight-semibold"><?php echo request::timeago($time); ?>
                </td>
                <td class="align-middle font-weight-semibold">₦ <?php echo $cost; ?></td>
                <td class="align-middle">
                    <a class="badge badge-soft-info" href="#"><?php echo $status; ?></a>
<!--                  <div class="progress" style="height: 6px; border-radius: 3px;">-->
<!--                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                  </div>-->
                </td>
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
          <ul id="commentsTabsControl" class="nav nav-tabs card-header-tabs ml-md-auto mt-4 mt-md-0">
            <li class="nav-item">
              <a class="nav-link active" href="#commentsTab1" role="tab" aria-selected="true"
                 data-toggle="tab">Pending
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#commentsTab2" role="tab" aria-selected="false"
                 data-toggle="tab">Approved
              </a>
            </li>
          </ul>
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

                  foreach($activities as $activity)
                  {
                      $name = $activity['name'];
                      $comment = $activity['comment'];
                      $timestamp = $activity['timestamp'];

                  ?>
                <a class="list-group-item list-group-item-action" href="#">
                  <div class="media">
                    <img class="u-avatar rounded-circle mr-3" src="assets/img/avatars/img1.jpg" alt="Image description">

                    <div class="media-body">
                      <div class="d-md-flex align-items-center">
                        <h4 class="mb-1">
                          <?php echo $name; ?> <span class="badge badge-soft-secondary mx-1">Pro</span>
                        </h4>
                        <small class="text-muted ml-md-auto"><?php echo request::timeago($timestamp); ?></small>
                      </div>

                      <p class="mb-0"><?php echo $name . ' ' . $comment ?></p>
                    </div>
                  </div>
                </a>
                  <?php
                  }
                  ?>
                <!-- End Comment -->
              </div>
            </div>
            <!-- End Tabs Content -->

            <!-- Tabs Content -->
            <div class="tab-pane fade" id="commentsTab2" role="tabpanel">
              <div class="list-group list-lg-group list-group-flush">
                <!-- Comment -->
                <a class="list-group-item list-group-item-action" href="#">
                  <div class="media">
                    <img class="u-avatar rounded-circle mr-3" src="assets/img/avatars/img2.jpg" alt="Image description">

                    <div class="media-body">
                      <div class="d-md-flex align-items-center">
                        <h4 class="mb-1">
                          Jane Ortega <span class="badge badge-soft-warning mx-1">Light</span>
                        </h4>
                        <small class="text-muted ml-md-auto">18 Jan 2018</small>
                      </div>

                      <p class="mb-0">Forget Ebay and other forms of advertising for your property</p>
                    </div>
                  </div>
                </a>
                <!-- End Comment -->

                <!-- Comment -->
                <a class="list-group-item list-group-item-action" href="#">
                  <div class="media">
                    <img class="u-avatar rounded-circle mr-3" src="assets/img/avatars/img3.jpg" alt="Image description">

                    <div class="media-body">
                      <div class="d-md-flex align-items-center">
                        <h4 class="mb-1">
                          Brandon Baldwin <span class="badge badge-soft-info mx-1">Basic</span>
                        </h4>
                        <small class="text-muted ml-md-auto">15 Jan 2018</small>
                      </div>

                      <p class="mb-0">I wanna discuss about two things that are quite important to me</p>
                    </div>
                  </div>
                </a>
                <!-- End Comment -->

                <!-- Comment -->
                <a class="list-group-item list-group-item-action" href="#">
                  <div class="media">
                    <img class="u-avatar rounded-circle mr-3" src="assets/img/avatars/img1.jpg" alt="Image description">

                    <div class="media-body">
                      <div class="d-md-flex align-items-center">
                        <h4 class="mb-1">
                          Chad Cannon <span class="badge badge-soft-secondary mx-1">Pro</span>
                        </h4>
                        <small class="text-muted ml-md-auto">15 Jan 2018</small>
                      </div>

                      <p class="mb-0">We've just done the project. What's gonna be next?</p>
                    </div>
                  </div>
                </a>
                <!-- End Comment -->

                <!-- Comment -->
                <a class="list-group-item list-group-item-action" href="#">
                  <div class="media">
                    <img class="u-avatar rounded-circle mr-3" src="assets/img/avatars/img4.jpg" alt="Image description">

                    <div class="media-body">
                      <div class="d-md-flex align-items-center">
                        <h4 class="mb-1">
                          Htmlstream <span class="badge badge-soft-secondary mx-1">Pro</span>
                        </h4>
                        <small class="text-muted ml-md-auto">12 Jan 2018</small>
                      </div>

                      <p class="mb-0">Adwords Keyword research for beginners</p>
                    </div>
                  </div>
                </a>
                <!-- End Comment -->

                <!-- Comment -->
                <a class="list-group-item list-group-item-action" href="#">
                  <div class="media">
                    <img class="u-avatar rounded-circle mr-3" src="assets/img/avatars/user-unknown.jpg" alt="Image description">

                    <div class="media-body">
                      <div class="d-md-flex align-items-center">
                        <h4 class="mb-1">
                          Stella Hoffman <span class="badge badge-soft-danger mx-1">Start</span>
                        </h4>
                        <small class="text-muted ml-md-auto">05 Jan 2018</small>
                      </div>

                      <p class="mb-0">When the release date is expexted for the advacned settings?</p>
                    </div>
                  </div>
                </a>
                <!-- End Comment -->
              </div>
            </div>
            <!-- End Tabs Content -->
          </div>
        </div>

        <footer class="card-footer">
          <a class="u-link u-link--primary" href="#!">All activities</a>
        </footer>
      </div>
    </div>
    <!-- End Comments -->
  </div>
  <!-- End Current Projects -->
</div>
