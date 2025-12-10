<?php

use Http\Services\SalesReportService;

$recordDates = SalesReportService::getPaymentFirstAndLastRecordDates();
$start_date = $_GET["start_date"] ?? $recordDates["first"];
$end_date =  $_GET["end_date"] ?? $recordDates["last"];

$salesReport = SalesReportService::summary($start_date, $end_date);

view(
    "admin/sales_report/index.view.php",
    compact('salesReport', 'start_date', 'end_date')
);
