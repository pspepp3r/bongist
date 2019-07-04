
<!-- Footer -->
<footer class="u-footer d-md-flex align-items-md-center text-center text-md-left text-muted text-muted">
  <p class="h5 mb-2 mb-md-0">
    &copy; <?php echo date('Y'); ?> <a class="link-muted" href="/"><?php echo config::name(); ?></a>. All Rights Reserved.
  </p>
  <p class="h5 mb-0 ml-auto">Developed by <a class="link-muted" href="https://codekago.com" target="_blank">Codekago Interactive</a></p>

</footer>
<!-- End Footer -->
</div>
</main>


<?php

  include 'views/admin/modals/customers.php';
  include 'views/admin/modals/orders.php';
  include 'views/admin/modals/staffs.php';
  include 'views/admin/modals/expenses.php';

?>

<!-- Global Vendor -->
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
<script src="assets/vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/vendor/bootstrap/bootstrap.min.js"></script>

<!-- Plugins -->
<script src="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/vendor/chart.js/dist/Chart.min.js"></script>

<!-- Initialization  -->
<script src="assets/js/sidebar-nav.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/dashboard-page-scripts.js"></script>
</body>
</html>
