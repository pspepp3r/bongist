<!-- Footer -->
<footer class="u-footer d-md-flex align-items-md-center text-center text-md-left text-muted text-muted">
    <p class="h5 mb-2 mb-md-0">
        &copy; <?php echo date('Y'); ?> <a class="link-muted" href="/"><?php echo config::name(); ?></a>. All Rights
        Reserved.
    </p>
    <p class="h5 mb-0 ml-auto">Developed by <a class="link-muted" href="https://codekago.com" target="_blank">Codekago
            Interactive</a></p>

</footer>
<!-- End Footer -->
</div>
</main>


<?php

require_once 'views/admin/modals/customers.php';
require_once 'views/admin/modals/orders.php';
require_once 'views/admin/modals/staffs.php';
require_once 'views/admin/modals/expenses.php';
require_once 'views/admin/modals/payments.php';
require_once 'views/admin/modals/invoices.php';
require_once 'views/admin/modals/receipts.php';

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
<script>
    $(document).on('ready', function () {
        $('.js-overall-income-chart').each(function (i, el) {
            var chart = new Chart(el, {
                type: 'line',
                data: {
                    labels: <?= json_encode($data1); ?>,
                    datasets: [{
                        label: 'Total Orders',
                        borderColor: 'rgba(107,21,182,0.6)',
                        backgroundColor: 'rgba(107,21,182,0.6)',
                        data: <?= json_encode($data2); ?>
                    }, {
                        label: 'Total Customers',
                        borderColor: 'rgba(41,114,250,0.6)',
                        backgroundColor: 'rgba(41,114,250,0.6)',
                        data: <?= json_encode($data3); ?>
                    }
                        // , {
                        //     label: 'Total Orders',
                        //     borderColor: 'rgba(97,200,167,0.6)',
                        //     backgroundColor: 'rgba(97,200,167,0.6)',
                        //     data: [3500, 2700, 3800, 17000, 8000, 5500, 3200, 6000, 8500, 4000, 2600, 2500]
                        // }, {
                        //     label: 'Total Expenses',
                        //     borderColor: 'rgba(251,65,67,0.6)',
                        //     backgroundColor: 'rgba(251,65,67,0.6)',
                        //     data: [0, 2000, 3500, 4000, 3500, 2000, 2100, 5500, 15000, 5500, 2000, 2100]
                        // }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    elements: {
                        point: {
                            radius: 0
                        },
                        line: {
                            borderWidth: 1
                        }
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                borderDash: [8, 8],
                                color: '#eaf2f9'
                            },
                            ticks: {
                                fontFamily: 'Open Sans',
                                fontColor: '#6e7f94'
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                borderDash: [8, 8],
                                color: '#eaf2f9'
                            },
                            ticks: {
                                fontFamily: 'Open Sans',
                                fontColor: '#6e7f94'
                            }
                        }]
                    },
                    tooltips: {
                        enabled: false,
                        intersect: 0,
                        custom: function (tooltipModel) {
                            // Tooltip Element
                            var tooltipEl = document.getElementById('overallIncomeChartTooltip' + i);

                            // Create element on first render
                            if (!tooltipEl) {
                                tooltipEl = document.createElement('div');
                                tooltipEl.id = 'overallIncomeChartTooltip' + i;
                                tooltipEl.className = 'u-chart-tooltip';
                                tooltipEl.innerHTML = '<div class="u-tooltip-body"></div>';
                                document.body.appendChild(tooltipEl);
                            }

                            // Hide if no tooltip
                            if (tooltipModel.opacity === 0) {
                                tooltipEl.style.opacity = 0;
                                return;
                            }

                            // Set caret Position
                            tooltipEl.classList.remove('above', 'below', 'no-transform');
                            if (tooltipModel.yAlign) {
                                tooltipEl.classList.add(tooltipModel.yAlign);
                            } else {
                                tooltipEl.classList.add('no-transform');
                            }

                            function getBody(bodyItem) {
                                return bodyItem.lines;
                            }

                            // Set Text
                            if (tooltipModel.body) {
                                var titleLines = tooltipModel.title || [],
                                    bodyLines = tooltipModel.body.map(getBody),
                                    innerHtml = '<h4 class="u-chart-tooltip__title">';

                                titleLines.forEach(function (title) {
                                    innerHtml += title;
                                });

                                innerHtml += '</h4>';

                                bodyLines.forEach(function (body, i) {
                                    var colors = tooltipModel.labelColors[i];
                                    innerHtml += '<div class="u-chart-tooltip__value">' + body + '</div>';
                                });

                                var tableRoot = tooltipEl.querySelector('.u-tooltip-body');
                                tableRoot.innerHTML = innerHtml;
                            }

                            // `this` will be the overall tooltip
                            var $self = this,
                                position = $self._chart.canvas.getBoundingClientRect(),
                                tooltipWidth = $(tooltipEl).outerWidth(),
                                tooltipHeight = $(tooltipEl).outerHeight();

                            // Display, position, and set styles for font
                            tooltipEl.style.opacity = 1;
                            tooltipEl.style.left = (position.left + tooltipModel.caretX - tooltipWidth / 2) + 'px';
                            tooltipEl.style.top = (position.top + tooltipModel.caretY - tooltipHeight - 15) + 'px';

                            $(window).on('scroll', function () {
                                var position = $self._chart.canvas.getBoundingClientRect(),
                                    tooltipWidth = $(tooltipEl).outerWidth(),
                                    tooltipHeight = $(tooltipEl).outerHeight();

                                // Display, position, and set styles for font
                                tooltipEl.style.left = (position.left + tooltipModel.caretX - tooltipWidth / 2) + 'px';
                                tooltipEl.style.top = (position.top + tooltipModel.caretY - tooltipHeight - 15) + 'px';
                            });
                        }
                    }
                }
            });
        });
    })
</script>
</body>

</html>