<?php
$pageName = "Dashboard"
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

            <!-- Top Cards -->
            <div class="row mt-24 gy-0">
                <div class="col-xxl-3 col-sm-6 pe-0">
                    <div
                        class="card-body p-20 bg-base border h-100 d-flex flex-column justify-content-center border-end-0">
                        <div
                            class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                            <div>
                                <span
                                    class="mb-12 w-44-px h-44-px bg-purple border border-primary-light-white flex-shrink-0 d-flex justify-content-center align-items-center radius-8 h6 mb-12">
                                    <iconify-icon
                                        icon="fa-solid:calendar"
                                        class="icon text-white"></iconify-icon>
                                </span>
                                <span class="mb-1 fw-medium text-secondary-light text-md">Reservation Today</span>
                                <h6 class="fw-semibold text-primary-light mb-1"><?= $result["reservations_today"] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6 px-0">
                    <div
                        class="card-body p-20 bg-base border h-100 d-flex flex-column justify-content-center border-end-0">
                        <div
                            class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                            <div>
                                <span
                                    class="mb-12 w-44-px h-44-px text-yellow bg-yellow-light border border-yellow-light-white flex-shrink-0 d-flex justify-content-center align-items-center radius-8 h6 mb-12">
                                    <iconify-icon
                                        icon="flowbite:users-group-solid"
                                        class="icon"></iconify-icon>
                                </span>
                                <span class="mb-1 fw-medium text-secondary-light text-md">Current Guests</span>
                                <h6 class="fw-semibold text-primary-light mb-1">
                                    <?= $result["current_guests"] ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6 px-0">
                    <div
                        class="card-body p-20 bg-base border h-100 d-flex flex-column justify-content-center border-end-0">
                        <div
                            class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                            <div>
                                <span
                                    class="mb-12 w-44-px h-44-px bg-cyan border border-lilac-light-white flex-shrink-0 d-flex justify-content-center align-items-center radius-8 h6 mb-12">
                                    <iconify-icon
                                        icon="gridicons:multiple-users"
                                        class="icon text-white"></iconify-icon>
                                </span>
                                <span class="mb-1 fw-medium text-secondary-light text-md">Total Visits</span>
                                <h6 class="fw-semibold text-primary-light mb-1"><?= $result["total_visits"] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6 ps-0">
                    <div
                        class="card-body p-20 bg-base border h-100 d-flex flex-column justify-content-center">
                        <div
                            class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                            <div>
                                <span
                                    class="mb-12 w-44-px h-44-px text-pink bg-pink-light border border-pink-light-white flex-shrink-0 d-flex justify-content-center align-items-center radius-8 h6 mb-12">
                                    <iconify-icon
                                        icon="solar:wallet-bold"
                                        class="icon"></iconify-icon>
                                </span>
                                <span class="mb-1 fw-medium text-secondary-light text-md">Today&apos;s Earnings</span>
                                <h6 class="fw-semibold text-primary-light mb-1">
                                    <?= moneyFormat($result["earnings_today"]) ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-4 mt-1">

                <!-- Earning Statistics -->
                <div class="col-xxl-6 col-xl-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <h6 class="text-lg mb-0">Earnings Statistic</h6>
                            </div>

                            <?php
                            $todayForecast = $result['earnings_analytics']['todayForecast'] ?? 0;
                            $growthPercent = $result['earnings_analytics']['growthPercent'] ?? 0;
                            $isGrowthPositive = $growthPercent >= 0;
                            $arrowIcon = $isGrowthPositive ? 'bxs:up-arrow' : 'bxs:down-arrow';
                            $badgeClass = $isGrowthPositive
                                ? 'bg-success-focus text-success-main br-success'
                                : 'bg-danger-focus text-danger-main br-danger';
                            $growthSign = $isGrowthPositive ? '+' : '';
                            ?>

                            <div class="d-flex flex-wrap align-items-center gap-2 mt-8">
                                <h6 class="mb-0"><?= moneyFormat($todayForecast, 2) ?></h6>
                                <span class="text-sm fw-semibold rounded-pill <?= $badgeClass ?> border px-8 py-2 d-flex gap-1">
                                    <?= $growthSign . $growthPercent ?>% <iconify-icon icon="<?= $arrowIcon ?>" class="text-xs"></iconify-icon>
                                </span>
                                <span class="text-xs fw-medium">
                                    <?= $growthSign ?><?= number_format(abs($todayForecast * ($growthPercent / 100)), 2) ?> per day
                                </span>
                            </div>

                            <div id="earningsChart" class="pt-28 apexcharts-tooltip-style-1"></div>
                        </div>
                    </div>
                </div>

                <!-- Current Week Guests -->
                <div class="col-xxl-3 col-xl-6">
                    <div class="card h-100 radius-8 border">
                        <div class="card-body p-24">
                            <h6 class="mb-12 fw-semibold text-lg mb-16">Current Week Guests</h6>

                            <div class="d-flex align-items-center gap-2 mb-20">
                                <h6 class="fw-semibold mb-0"><?= number_format($result["current_week_guests"]['total_guests']) ?></h6>
                                <p class="text-sm mb-0">
                                    <span class="bg-<?= $result["current_week_guests"]['growth_percent'] >= 0 ? 'success' : 'danger' ?>-focus border br-<?= $result["current_week_guests"]['growth_percent'] >= 0 ? 'success' : 'danger' ?> px-8 py-2 d-flex gap-1 rounded-pill fw-semibold text-<?= $result["current_week_guests"]['growth_percent'] >= 0 ? 'success' : 'danger' ?>-main text-sm d-inline-flex align-items-center gap-1">
                                        <?= abs($result["current_week_guests"]['growth_percent']) ?>%
                                        <iconify-icon icon="iconamoon:arrow-<?= $result["current_week_guests"]['growth_percent'] >= 0 ? 'up' : 'down' ?>-2-fill" class="icon"></iconify-icon>
                                    </span>

                                    <span class="text-xs fw-medium">
                                        <?= $result["current_week_guests"]['avg_guests_per_day'] ?> per day
                                    </span>
                                </p>
                            </div>

                            <div id="currentWeekGuestsChart"></div>
                        </div>
                    </div>
                </div>

                <!-- Reservation Status Breakdown -->
                <div class="col-xxl-3 col-xl-6">
                    <div class="card h-100 radius-8 border-0 overflow-hidden">
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg">Reservation Status Breakdown</h6>
                            </div>

                            <div id="reservationStatusBreakdownChart"></div>
                            <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                                <?php foreach ($result['reservation_status_breakdown']['legendData'] as $item): ?>
                                    <li class="d-flex align-items-center gap-2">
                                        <span class="w-12-px h-12-px radius-2" style="background-color: <?= $item['color'] ?>;"></span>
                                        <span class="text-secondary-light text-sm fw-normal">
                                            <?= htmlspecialchars($item['status']) ?>:
                                            <span class="text-primary-light fw-semibold"><?= number_format($item['total']) ?></span>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                    </div>
                </div>

                <!-- Facility Available/Unavailable -->
                <div class="col-xxl-9 col-xl-12">
                    <div class="card h-100">
                        <div class="card-body p-24">

                            <div class="d-flex flex-wrap align-items-center gap-1 justify-content-between mb-16">
                                <ul class="nav border-gradient-tab nav-pills mb-0" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link d-flex align-items-center active" id="pills-to-do-list-tab" data-bs-toggle="pill" data-bs-target="#pills-to-do-list" type="button" role="tab" aria-controls="pills-to-do-list" aria-selected="true">
                                            Facility Availability
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link d-flex align-items-center" id="pills-recent-leads-tab" data-bs-toggle="pill" data-bs-target="#pills-recent-leads" type="button" role="tab" aria-controls="pills-recent-leads" aria-selected="false" tabindex="-1">
                                            Facility Unavailability
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-to-do-list" role="tabpanel" aria-labelledby="pills-to-do-list-tab" tabindex="0">
                                    <div class="table-responsive scroll-sm">
                                        <table class="table bordered-table sm-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Current Available Units</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result["available_facilities"] as $avFac): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="text-md mb-0 fw-medium"><?= $avFac["name"] ?></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?= $avFac["unit"] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-recent-leads" role="tabpanel" aria-labelledby="pills-recent-leads-tab" tabindex="0">
                                    <div class="table-responsive scroll-sm">
                                        <table class="table bordered-table sm-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Current Unavailable Units</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result["unavailable_facilities"] as $unAvFac): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="text-md mb-0 fw-medium"><?= $unAvFac["name"] ?></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?= $unAvFac["unit"] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Occupancy Rate -->
                <div class="col-xxl-3 col-xl-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                <h6 class="mb-2 fw-bold text-lg mb-0">Occupancy Rate</h6>
                            </div>
                            <div class="mt-32">
                                <?php foreach ($result["occupancy_rate"] as $rate): ?>
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0 fw-medium"><?= $rate["facility_name"] ?></h6>
                                                <span class="text-sm text-secondary-light fw-medium">Total Units: <?= $rate["total_units"] ?></span><br />
                                                <span class="text-sm text-secondary-light fw-medium">Booked Units: <?= $rate["booked_units"] ?></span>
                                            </div>
                                        </div>
                                        <span class="text-primary-light text-md fw-medium"><?= $rate["occupancy_rate"] ?>%</span>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

    <!-- Earnings Statistic Chart -->
    <script>
        $(document).ready(function() {
            // --- Helpers ---
            const formatDateTime = (value) => {
                if (!value) return "N/A";
                const date = new Date(value);
                if (isNaN(date)) return "N/A";
                return date.toLocaleString("en-US", {
                    year: "numeric",
                    month: "short",
                    day: "numeric"
                });
            };

            // Assuming your PHP returns JSON to the frontend
            const forecastData = <?= json_encode($result["earnings_analytics"]) ?>;

            const historical = forecastData.historical || [];
            const forecast = forecastData.forecast || [];

            // Merge historical + forecast dates for continuous trend
            const labels = [
                ...historical.map(item => formatDateTime(item.date)),
                ...forecast.map(item => formatDateTime(item.date))
            ];

            const actualEarnings = historical.map(item => parseFloat(item.earnings));
            const predictedEarnings = forecast.map(item => parseFloat(item.predicted_earnings));

            // Create ApexCharts options
            var lineOptions = {
                series: [{
                        name: "Actual Earnings",
                        data: actualEarnings,
                    },
                    {
                        name: "Forecast",
                        data: Array(historical.length).fill(null).concat(predictedEarnings),
                    },
                ],
                chart: {
                    height: 264,
                    type: "line",
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: false,
                    },
                    dropShadow: {
                        enabled: true,
                        top: 6,
                        left: 0,
                        blur: 4,
                        color: "#000",
                        opacity: 0.1,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                    width: 3,
                    colors: ["#487FFF", "#10B981"],
                    dashArray: [0, 6],
                },
                markers: {
                    size: 0,
                    strokeWidth: 3,
                    hover: {
                        size: 8,
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: true,
                    },
                    y: {
                        formatter: function(value) {
                            return "₱ " + value.toLocaleString();
                        },
                    },
                },
                grid: {
                    row: {
                        colors: ["transparent", "transparent"],
                        opacity: 0.5,
                    },
                    borderColor: "#D1D5DB",
                    strokeDashArray: 3,
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return "₱ " + value.toLocaleString();
                        },
                        style: {
                            fontSize: "14px",
                        },
                    },
                },
                xaxis: {
                    categories: labels,
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
                legend: {
                    show: true,
                    position: "top",
                    horizontalAlign: "right",
                },
            };

            // Render chart
            new ApexCharts(document.querySelector("#earningsChart"), lineOptions).render();
        });
    </script>

    <!-- Current Week Guests Chart -->
    <script>
        $(document).ready(function() {
            const weekGuests = <?= json_encode($result["current_week_guests"]) ?>;

            const barOptions = {
                series: [{
                    name: "Guests",
                    data: weekGuests.daily_data.map(item => parseInt(item.total_guests)),
                }, ],
                chart: {
                    type: "bar",
                    height: 235,
                    toolbar: {
                        show: false
                    },
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        horizontal: false,
                        columnWidth: 24,
                        columnWidth: "52%",
                        endingShape: "rounded",
                    },
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: "gradient",
                    colors: ["#dae5ff"],
                    gradient: {
                        shade: "light",
                        type: "vertical",
                        shadeIntensity: 0.5,
                        gradientToColors: ["#dae5ff"],
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100],
                    },
                },
                grid: {
                    show: false,
                    borderColor: "#D1D5DB",
                    strokeDashArray: 4,
                    position: "back",
                    padding: {
                        top: -5,
                        right: -5,
                        bottom: -5,
                        left: -5,
                    },
                },
                xaxis: {
                    categories: weekGuests.daily_data.map(item => {
                        const date = new Date(item.date);
                        return date.toLocaleDateString('en-US', {
                            weekday: 'short'
                        });
                    }),
                },
                yaxis: {
                    show: false,
                },
            };

            new ApexCharts(document.querySelector("#currentWeekGuestsChart"), barOptions).render();
        });
    </script>

    <!-- Reservation Status Breakdown Chart -->
    <script>
        $(document).ready(function() {
            const statusData = <?= json_encode($result["reservation_status_breakdown"]['chartData']) ?>;
            const donutOptions = {
                series: statusData.map(item => item.value),
                chart: {
                    type: "donut",
                    height: 270,
                    sparkline: {
                        enabled: true,
                    },
                    margin: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0,
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0,
                    },
                },
                labels: statusData.map(item => item.label),
                colors: statusData.map(item => item.color),
                legend: {
                    show: false
                },
                stroke: {
                    width: 0,
                },
                dataLabels: {
                    enabled: false,
                },
                tooltip: {
                    y: {
                        formatter: val => val.toLocaleString()
                    }
                },
            };

            new ApexCharts(document.querySelector("#reservationStatusBreakdownChart"), donutOptions).render();
        });
    </script>
</body>

</html>