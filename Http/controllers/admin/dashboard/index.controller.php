<?php

use Http\Services\DashboardService;

$result = DashboardService::summary();
// dd($result);
view(
    "admin/dashboard/index.view.php",
    compact('result')
);
