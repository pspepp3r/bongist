<?php

$slug = $status;

?>

<div class="u-body">
  <div class="card mb-4">
    <header class="card-header">
      <h2 class="h3 card-header-title text-uppercase"><?= $slug; ?> Orders (<?= $type; ?>)</h2>
    </header>

    <div class="card-body">
      <div class="table-responsive">
        <?php

        if (isset($_POST['editOrder'])) {
          order::update($_POST['order_id'], $_POST['status'], $_POST['note'], $staff_id);
        }
        if (isset($_POST['removeOrder'])) {
          order::remove($_POST['id']);
        }

        $top = order::check_status($slug);
        $id = $top['id'];
        $status_id = $db->single("SELECT id FROM order_status WHERE slug = :slug", array('slug' => $status));
        $type_id = $db->single("SELECT id FROM order_type WHERE type = :type", array('type' => $type));
        $orders = order::status_orders($status_id, $type_id);

        if ($orders) {

          ?>

          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Order Id</th>
                <th scope="col">Customer</th>
                <th scope="col">Initial deposit</th>
                <th scope="col">Cost</th>
                <th scope="col">Type</th>
                <th scope="col">Date of delivery</th>

                <?php
                if ($role == 1) {
                  ?>
                  <th class="text-center" scope="col">Actions</th>
                  <?php
                }
                ?>
              </tr>
            </thead>
            <?php
            foreach ($orders as $order) {
              $id = $order['id'];
              $order_id = $order['order_id'];
              $customer = $order['customer_name'];
              $deposit = $order['initial_deposit'];
              $dod = $order['date_of_delivery'];
              $cost = $order['cost'];
              $status = $order['status_name'];
              $type = $order['type'];

              ?>
              <tr>
                <td><a href="admin/orders/<?= $order_id; ?>/details" class="btn btn-secondary"
                    style="text-transform: uppercase;"><?= $order_id; ?></a></td>
                <td><?= $customer; ?></td>
                <td><?= '₦' . number_format($deposit); ?></td>
                <td><?= '₦' . number_format($cost); ?></td>
                <td><?= $type; ?></td>
                <td><?= $dod; ?></td>

                <?php
                if ($role == 1) {
                  ?>
                  <td class="text-center">
                    <a id="actions1Invoker" class="link-muted" href="#!" aria-haspopup="true" aria-expanded="false"
                      data-toggle="dropdown">
                      <i class="fa fa-sliders-h"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right dropdown" style="width: 150px;"
                      aria-labelledby="actions1Invoker">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <a class="d-flex align-items-center link-muted py-2 px-3" data-toggle="modal" href="#editOrderModal"
                            onclick="$('.order_id').val('<?= $order_id; ?>'); $('.order_status').val('<?= $status; ?>');"><i
                              class="fa fa-plus mr-2"></i>Edit</a>
                        </li>
                        <li>
                          <a class="d-flex align-items-center link-muted py-2 px-3" data-toggle="modal"
                            href="#deleteOrderModal" onclick="$('.id').val('<?php echo $id; ?>');"><i
                              class="fa fa-minus mr-2"></i>Delete</a>
                        </li>
                      </ul>
                    </div>
                  </td>
                  <?php
                }
                ?>
              </tr>
              <?php
            }
            ?>
            <tbody>
            </tbody>
          </table>
          <?php

        } else {
          respond::alert('info', '', 'No ' . $type . 'order under ' . $status);
        }
        ?>
      </div>
    </div>
  </div>
</div>