<?php

$reservations = [];

view(
    "admin/reservation/index.view.php",
    compact('reservations')
);
