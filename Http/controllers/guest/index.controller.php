<?php

use Core\App;
use Http\Models\Event;

$events = App::resolve(Event::class)->fetchEvents();

view(
    "guest/index.view.php",
    compact('events')
);
