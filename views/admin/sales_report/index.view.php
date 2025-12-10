<?php
$pageName = "Sales Report"
?>

<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<!-- Head Tag -->
<?php view("admin/partials/head.partial.php", [
    'title' => "Handog Admin | " . $pageName
]) ?>

<body>

    <!-- Sidebar -->
    <?php view("admin/partials/sidebar.partial.php") ?>

    <!-- Main Section -->
    <main class="dashboard-main">

        <!-- Sidebar -->
        <?php view("admin/partials/navbar.partial.php") ?>


        <div class="dashboard-main-body">

            <!-- Breadcrumbs -->
            <?php view("admin/partials/breadcrumb.partial.php", compact('pageName')) ?>

            <!-- Filter -->
            <div class="card mb-3">
                <div class="card-body py-1">
                    <form class="mb-3">
                        <div class="row align-items-end">
                            <div class="col-12 col-md-3">
                                <label class="form-label" for="start_date">From</label>
                                <input type="text" name="start_date" id="start_date" class="form-control" value="<?= $start_date ?? date("Y-m-d") ?>">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label" for="end_date">To</label>
                                <input type="text" name="end_date" id="end_date" class="form-control" value="<?= $end_date ?? date("Y-m-d") ?>">
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-between mt-3">
                                <button type="submit" class="btn btn-secondary">Filter</button>
                                <button type="button" id="printBtn" class="btn btn-primary">Print</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Facility Table & Sales Chart -->
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-start mb-20">
                                <h6 class="mb-2 fw-bold text-lg mb-0">Top 5 Facilities</h6>
                            </div>
                            <div>
                                <?php if (empty($salesReport["top_facilities"])): ?>
                                    <p>No data available</p>
                                <?php else: ?>
                                    <?php foreach ($salesReport["top_facilities"] as $topFacility): ?>
                                        <div class="d-flex align-items-center justify-content-between gap-3 mb-20">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="<?= handleFilePath($topFacility['facility_image']) ?>" alt="<?= $topFacility['facility_name'] ?>" class="w-40-px h-40-px radius-8 flex-shrink-0">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-medium"><?= $topFacility['facility_name'] ?></h6>
                                                </div>
                                            </div>
                                            <span class="text-secondary">Reservations: <span class="text-primary-light text-md fw-medium"><?= $topFacility["total_reservations"] ?></span></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div id="sales_chart" class="pt-28 apexcharts-tooltip-style-1"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="card basic-data-table">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Payments Table</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Came From</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($salesReport["payments"] as $payments): ?>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600"><?= $payments['id'] ?></a></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="text-md mb-0 fw-medium flex-grow-1"><?= ucfirst($payments["came_from"]) ?></h6>
                                            </div>
                                        </td>
                                        <td><?= ucfirst($payments["came_from_name"]) ?></td>
                                        <td><?= formatDatetimeToReadable($payments["created_at"]) ?></td>
                                        <td><?= moneyFormat($payments["amount"]) ?></td>
                                        <td><?= ucfirst($payments["payment_status"]) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

    <?php view("admin/shared/delete-modal.php") ?>


    <!-- Print -->
    <script>
        $(document).ready(function() {
            $('#start_date, #end_date').flatpickr({
                dateFormat: "Y-m-d",
            });

            $("#printBtn").on('click', function() {
                const start_date = $("#start_date").val();
                const end_date = $("#end_date").val();

                const url = `/admin/sales-report/print?start_date=${start_date}&end_date=${end_date}`;
                window.open(url, "_blank");
            });
        });
    </script>

    <!-- Sales Chart -->
    <script>
        $(document).ready(function() {
            const salesChart = <?= json_encode($salesReport["sales_chart"]) ?>;
            var areaOptions = {
                series: [{
                    name: 'Sales',
                    data: salesChart.sales,
                }, ],
                chart: {
                    type: 'area',
                    width: '100%',
                    height: 360,
                    sparkline: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    },
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 4,
                    colors: ['#487fff'],
                    lineCap: 'round'
                },
                grid: {
                    show: true,
                    borderColor: '#D1D5DB',
                    strokeDashArray: 1,
                    position: 'back',
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: true
                        }
                    },
                    row: {
                        colors: undefined,
                        opacity: 0.5
                    },
                    column: {
                        colors: undefined,
                        opacity: 0.5
                    },
                },
                fill: {
                    type: 'gradient',
                    colors: ['#487fff'],
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.5,
                        gradientToColors: ['#487fff00'],
                        inverseColors: false,
                        opacityFrom: .6,
                        opacityTo: 0.3,
                        stops: [0, 100],
                    },
                },
                markers: {
                    colors: ['#487fff'],
                    strokeWidth: 3,
                    size: 0,
                    hover: {
                        size: 10
                    }
                },
                xaxis: {
                    categories: salesChart.dates,
                    tooltip: {
                        enabled: false,
                    },
                    labels: {
                        rotate: -45,
                        style: {
                            fontSize: "12px",
                        },
                    },
                    axisBorder: {
                        show: false,
                    },
                    crosshairs: {
                        show: true,
                        width: 20,
                        stroke: {
                            width: 0,
                        },
                        fill: {
                            type: "solid",
                            color: "#487FFF40",
                        },
                    },
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return "₱ " + value.toLocaleString();
                        },
                    },
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };
            new ApexCharts(document.querySelector("#sales_chart"), areaOptions).render();
        });
    </script>

    <!-- Payments DataTable -->
    <script>
        let table = new DataTable('#dataTable');
    </script>
</body>

</html>