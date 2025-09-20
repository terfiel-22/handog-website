<?php

use Http\Enums\GuestType;

$guestTypes = GuestType::toArray();

view(
    "admin/settings/entrance_rates/create.view.php",
    compact('guestTypes')
);
