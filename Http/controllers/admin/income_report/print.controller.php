<?php

use Http\Services\IncomeReportService;
use Http\Services\PDFService;
use Http\Services\SettingService;

$recordDates = IncomeReportService::getPaymentFirstAndLastRecordDates();
$start_date = $_GET["start_date"] ?? $recordDates["first"];
$end_date =  $_GET["end_date"] ?? $recordDates["last"];
$incomeReports = IncomeReportService::summary($start_date, $end_date);

$logo = base64Image(SettingService::getLogo()["logo"]);
$fontPath = public_html_path("/assets/general/fonts");

ob_start();
view(
    "templates/income_reports.view.php",
    compact('incomeReports', 'start_date', 'end_date', 'logo', 'fontPath')
);
$html = ob_get_clean();

PDFService::generatePDF($html, "Income Reports $start_date - $end_date.pdf", "reports", true);

die();
