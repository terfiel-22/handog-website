<?php

use Http\Services\IncomeReportService;

// Example date
$start_date = "2025-11-20";
$end_date =  "2025-11-21";

$incomeReports = IncomeReportService::summary($start_date, $end_date);
dd($incomeReports);
