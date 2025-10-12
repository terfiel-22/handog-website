<?php

$events = [];

view(
    "admin/event/index.view.php",
    compact('events')
);
