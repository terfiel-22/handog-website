<!DOCTYPE html>
<html>

<head>
    <title>Payment Receipt</title>

    <link rel="stylesheet" href="/assets/guest/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/guest/css/main.css">
</head>

<body style="padding: 1rem">
    <div>
        <div class="flex-column border-bottom-0 pb-0">
            <div class="w-100 text-center">
                <img src="<?= $logo ?>" alt="Resort Logo"
                    style="height: 70px; object-fit: contain;" class="print-logo">

                <h5 class="mt-2 mb-0 fw-bold"><?= WEBSITE_NAME ?></h5>
                <p class="mb-0 text-muted small">
                    <?= WEBSITE_ADDRESS ?> • <?= WEBSITE_NUMBER ?>
                </p>
                <a href="mailto:<?= WEBSITE_EMAIL ?>" class="mb-0 text-muted small">Email: <?= WEBSITE_EMAIL ?></a>
            </div>

            <!-- Divider -->
            <hr class="w-100 mt-3 mb-0">

        </div>
        <div>
            <!-- Customer Info -->
            <div class="mb-4">
                <h6 class="fw-bold text-secondary border-bottom pb-2">Reservation Details</h6>
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Name:</strong> <?= $reservation["contact_person"] ?></p>
                        <p class="mb-1"><strong>Contact Number:</strong> <?= $reservation["contact_no"] ?></p>
                        <p class="mb-1"><strong>Contact Email:</strong> <?= $reservation["contact_email"] ?></p>
                        <p class="mb-1"><strong>Contact Address:</strong> <?= $reservation["contact_address"] ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Check-in:</strong> <?= formatDatetimeToReadable($reservation["check_in"]) ?></p>
                        <p class="mb-1"><strong>Check-out:</strong> <?= formatDatetimeToReadable($reservation["check_out"]) ?></p>
                    </div>
                </div>
            </div>

            <!-- Payment Breakdown Table -->
            <h6 class="fw-bold text-secondary pb-2">Payment Breakdown</h6>
            <div class="payment-breakdown-table-container">
                <table class="table table-bordered table-striped mb-3 ">
                    <thead class="table-light">
                        <tr>
                            <th>Description</th>
                            <th class="text-end">Amount (₱)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Facility Rate</td>
                            <td class="text-end"><?= \Http\Services\RatesService::getFacilityRate($reservation["time_range"], $reservation["facility_id"]) ?></td>
                        </tr>
                        <?php foreach ($guests as $i => $guest): ?>
                            <tr>
                                <td>Guest #<?= $i ?> (Name: <?= $guest["guest_name"] ?>, Age: <?= $guest["guest_age"] ?> <?= $guest["senior_pwd"] == \Http\Enums\YesNo::YES ? ', Senior/PWD' : '' ?>)</td>
                                <td class="text-end"><?= \Http\Services\RatesService::getGuestRate($reservation["check_in"], $guest["guest_age"], $guest["senior_pwd"]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td>Total</td>
                            <td class="text-end"><?= $reservation["total_price"] ?></td>
                        </tr>
                        <tr>
                            <td>50% Deposit</td>
                            <td class="text-end text-primary"><?= ((float) $reservation["total_price"] / 2) ?></td>
                        </tr>
                        <tr>
                            <td>Paid Amount</td>
                            <td class="text-end text-primary"><?= $reservation["paid_amount"] ?></td>
                        </tr>
                        <tr>
                            <td>Balance</td>
                            <td class="text-end text-primary"><?= $reservation["total_price"] - $reservation["paid_amount"] ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>

</html>