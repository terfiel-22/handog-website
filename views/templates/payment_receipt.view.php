<!DOCTYPE html>
<html>

<head>
    <title>Payment Receipt</title>
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
        <div style="font-size:11px; color:#555;"><?= WEBSITE_ADDRESS ?> • <?= WEBSITE_NUMBER ?></div>
        <a href="mailto:<?= WEBSITE_EMAIL ?>" style="font-size:11px; color:#555;">Email: <?= WEBSITE_EMAIL ?></a>
    </div>

    <hr />

    <!-- Reservation Details -->
    <h2 style="margin-bottom:5px; margin-top:5px; font-weight:bold; border-bottom:1px solid #ccc; padding-bottom:5px;">Reservation Details</h2>
    <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
        <tr>
            <td style="width:50%; padding:5px;"><strong>Name:</strong> <?= $reservation["contact_person"] ?></td>
            <td style="width:50%; padding:5px;"><strong>Check-in:</strong> <?= formatDatetimeToReadable($reservation["check_in"]) ?></td>
        </tr>
        <tr>
            <td style="padding:5px;"><strong>Contact Number:</strong> <?= $reservation["contact_no"] ?></td>
            <td style="padding:5px;"><strong>Check-out:</strong> <?= formatDatetimeToReadable($reservation["check_out"]) ?></td>
        </tr>
        <tr>
            <td style="padding:5px;"><strong>Contact Email:</strong> <?= $reservation["contact_email"] ?></td>
            <td></td>
        </tr>
        <tr>
            <td style="padding:5px;"><strong>Contact Address:</strong> <?= $reservation["contact_address"] ?></td>
            <td></td>
        </tr>
    </table>

    <!-- Payment Breakdown -->
    <h2 style="margin-bottom:5px; font-weight:bold; border-bottom:1px solid #ccc; padding-bottom:5px;">Payment Breakdown</h2>
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background-color:#f2f2f2;">
                <th style="padding:8px; border:1px solid #ccc; text-align:left;">Description</th>
                <th style="padding:8px; border:1px solid #ccc; text-align:right;">Amount (&#x20B1;)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding:8px; border:1px solid #ccc;">Facility Rate (<?= $reservation["facility_name"] ?>) (<?= $reservation["time_range"] ?>)</td>
                <td style="padding:8px; border:1px solid #ccc; text-align:right;"><?= \Http\Services\RatesService::getFacilityRate($reservation["time_range"], $reservation["facility_id"]) ?></td>
            </tr>
            <?php if ($reservation["discounted_value"] > 0): ?>
                <tr>
                    <td style="padding:8px; border:1px solid #ccc;">Discounted Value</td>
                    <td style="padding:8px; border:1px solid #ccc; text-align:right; color: #822"><?= $reservation["discounted_value"] ?></td>
                </tr>
            <?php endif; ?>
            <?php foreach ($guests as $i => $guest): ?>
                <tr>
                    <td style="padding:8px; border:1px solid #ccc;">Guest #<?= $i + 1 ?> (Name: <?= $guest["guest_name"] ?>, Age: <?= $guest["guest_age"] ?> <?= $guest["senior_pwd"] == \Http\Enums\YesNo::YES ? ', Senior/PWD' : '' ?>)</td>
                    <td style="padding:8px; border:1px solid #ccc; text-align:right;"><?= \Http\Services\RatesService::getGuestRate($reservation["check_in"], $guest["guest_age"], $guest["senior_pwd"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr style="font-weight:bold;">
                <td style="padding:8px; border:1px solid #ccc;">Total</td>
                <td style="padding:8px; border:1px solid #ccc; text-align:right;"><?= $reservation["total_price"] ?></td>
            </tr>
            <tr>
                <td style="padding:8px; border:1px solid #ccc;">50% Deposit</td>
                <td style="padding:8px; border:1px solid #ccc; text-align:right; color:#0d6efd;"><?= ($reservation["total_price"] / 2) ?></td>
            </tr>
            <tr>
                <td style="padding:8px; border:1px solid #ccc;">Paid Amount</td>
                <td style="padding:8px; border:1px solid #ccc; text-align:right; color:#0d6efd;"><?= $reservation["paid_amount"] ?></td>
            </tr>
            <tr>
                <td style="padding:8px; border:1px solid #ccc;">Balance</td>
                <td style="padding:8px; border:1px solid #ccc; text-align:right; color:#0d6efd;"><?= ($reservation["total_price"] - $reservation["paid_amount"]) ?></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>