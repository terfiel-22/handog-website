<?php

$title = "Booking Complete!";
$subtitle = "Thank you for choosing us! Your payment went through, and we can't wait to welcome you soon.";

view(
    "guest/booking/show.view.php",
    compact('title', 'subtitle')
);
