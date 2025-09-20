<?php

use Core\App;
use Http\Models\EntranceRates;

$rates = App::resolve(EntranceRates::class)->fetchEntranceRates();

view(
    "admin/settings/entrance_rates/index.view.php",
    compact('rates')
);
