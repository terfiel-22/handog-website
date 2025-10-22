<?php

use Http\Services\DashboardService;

$result = DashboardService::summary();

view(
    "admin/dashboard/index.view.php"
);
