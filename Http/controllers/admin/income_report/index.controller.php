<?php

use Http\Services\IncomeReportService;

$recordDates = IncomeReportService::getPaymentFirstAndLastRecordDates();
$start_date = $_GET["start_date"] ?? $recordDates["first"];
$end_date =  $_GET["end_date"] ?? $recordDates["last"];

$incomeReports = IncomeReportService::summary($start_date, $end_date);

view(
    "admin/income_report/index.view.php",
    compact('incomeReports', 'start_date', 'end_date')
);
