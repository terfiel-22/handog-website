<!DOCTYPE html>
<html>

<head>
    <title>Income Reports</title>
    <meta charset="UTF-8">

    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-weight: normal;
            font-style: normal;
            src: url('<?= $fontPath ?>/DejaVuSans.ttf') format('truetype');
        }

        @font-face {
            font-family: 'DejaVu Sans';
            font-weight: bold;
            font-style: normal;
            src: url('<?= $fontPath ?>/DejaVuSans-Bold.ttf') format('truetype');
        }

        body,
        table,
        * {
            font-family: 'DejaVu Sans', sans-serif !important;
        }
    </style>
</head>

<body style="font-family:Arial,sans-serif; font-size:12px; color:#333; padding:20px;">

    <!-- Header -->
    <div style="text-align:center; margin-bottom:15px;">
        <img src="<?= $logo ?>" alt="Logo" style="height:70px; object-fit:contain; margin-bottom:10px;">
        <div style="font-weight:bold; font-size:16px;"><?= WEBSITE_NAME ?></div>
        <div style="font-size:11px; color:#555;"><?= \Http\Services\ContactDetailService::getContactDetails()["address"] ?> • <?= \Http\Services\ContactDetailService::getContactDetails()["contact_no"] ?></div>
        <a href="mailto:<?= \Http\Services\ContactDetailService::getContactDetails()["email"] ?>" style="font-size:11px; color:#555;">Email: <?= \Http\Services\ContactDetailService::getContactDetails()["email"] ?></a>
    </div>

    <hr />

    <!-- Income Details -->
    <h2 style="margin-bottom:5px; margin-top:5px; font-weight:bold; border-bottom:1px solid #ccc; padding-bottom:5px;">Income Reports</h2>
    <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
        <tr>
            <td style="width:50%; padding:5px;"><strong>Date Range:</strong> <?= formatDateToReadable($start_date) ?> - <?= formatDateToReadable($end_date) ?></td>
        </tr>
        <tr>
            <td style="width:50%; padding:5px;"><strong>Total Income:</strong> <?= moneyFormat($incomeReports["total_income"]) ?></td>
        </tr>
        <tr>
            <td style="padding:5px;"><strong>Payment Count:</strong> <?= $incomeReports["payment_count"] ?></td>
        </tr>
    </table>

    <!-- Payment Table -->
    <h2 style="margin-bottom:5px; font-weight:bold; border-bottom:1px solid #ccc; padding-bottom:5px;">Payments</h2>
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background-color:#f2f2f2;">
                <th style="padding:8px; border:1px solid #ccc; text-align:left;">ID</th>
                <th style="padding:8px; border:1px solid #ccc; text-align:left;">Came From</th>
                <th style="padding:8px; border:1px solid #ccc; text-align:left;">Name</th>
                <th style="padding:8px; border:1px solid #ccc; text-align:left;">Date Created</th>
                <th style="padding:8px; border:1px solid #ccc; text-align:left;">Amount (&#x20B1;)</th>
                <th style="padding:8px; border:1px solid #ccc; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($incomeReports["payments"] as $payments): ?>
                <tr>
                    <td style="padding:8px; border:1px solid #ccc;"><?= $payments['id'] ?></td>
                    <td style="padding:8px; border:1px solid #ccc;">Client</td>
                    <td style="padding:8px; border:1px solid #ccc;">Taki Fimito</td>
                    <td style="padding:8px; border:1px solid #ccc;"><?= formatDatetimeToReadable($payments["created_at"]) ?></td>
                    <td style="padding:8px; border:1px solid #ccc;"><?= moneyFormat($payments["amount"]) ?></td>
                    <td style="padding:8px; border:1px solid #ccc;"><?= ucfirst($payments["payment_status"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>