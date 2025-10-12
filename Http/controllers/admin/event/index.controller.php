<?php

use Core\App;
use Http\Models\Event;

$events = App::resolve(Event::class)->fetchEvents();

view(
    "admin/event/index.view.php",
    compact('events')
);
