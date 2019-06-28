<div class="u-body">
  <h1 class="h2 font-weight-semibold mb-4 float-left">Staff Accounts</h1>
  <div class="float-right">
    <a class="btn btn-dark btn-block" href="#addStaff" data-toggle="modal">New Staff</a>
  </div>

  <div class="card mb-4" style="clear: both;">
    <header class="card-header">
      <h2 class="h3 card-header-title">Latest Staff</h2>
    </header>

    <div class="card-body">
      <?php

      if (isset($_POST['addCustomer'])) {
        customer::add($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address']);
      }

      if (isset($_POST['editCustomer'])) {
        customer::edit($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address']);
      }

      if (isset($_POST['removeCustomer'])) {
        customer::remove($_POST['id']);
      }

      $customers = customer::all();

      if ($customers) {
        ?>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Email Address</th>
              <th scope="col">Phone Number</th>
              <th scope="col">No of Order(s)</th>
              <th scope="col">Date Added</th>
              <th class="text-center" scope="col">Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php

            foreach ($customers as $customer) {
              $id = $customer['id'];
              $name = $customer['name'];
              $email = $customer['email'];
              $phone = $customer['phone'];
              $address = $customer['address'];
              ?>
              <tr>
                <td><?php echo $name; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo count(customer::orders($id)); ?></td>
                <td>
                  <span class="badge badge-dark"><?php echo request::timeago($customer['timestamp']); ?></span>
                </td>
                <td class="text-center">
                  <a id="actions1Invoker" class="link-muted" href="#!" aria-haspopup="true" aria-expanded="false"
                     data-toggle="dropdown">
                    <i class="fa fa-sliders-h"></i>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right dropdown" style="width: 150px;" aria-labelledby="actions1Invoker">
                    <ul class="list-unstyled mb-0">
                      <li>
                        <a class="d-flex align-items-center link-muted py-2 px-3" data-toggle="modal" href="#editCustomer" onclick="$('.customer_id').val('<?php echo $id; ?>'); $('.customer_email').val('<?php echo $email; ?>'); $('.customer_phone').val('<?php echo $phone; ?>'); $('.customer_name').val('<?php echo $name; ?>'); $('.customer_address').val('<?php echo $address; ?>');">
                          <i class="fa fa-plus mr-2"></i> Edit Customer
                        </a>
                      </li>
                      <li>
                        <a class="d-flex align-items-center link-muted py-2 px-3" data-toggle="modal" href="#removeCustomer" onclick="$('.customer_id').val('<?php echo $id; ?>');">
                          <i class="fa fa-minus mr-2"></i> Remove
                        </a>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
              <?php
            }

            ?>
            </tbody>
          </table>
        </div>
        <?php
      }else {
        respond::alert('info', '', 'No customer account has been created');
      }
      ?>
    </div>
  </div>


</div>


