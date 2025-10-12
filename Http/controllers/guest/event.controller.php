<?php

use Core\App;
use Http\Models\Event;

$id = $_GET["id"] ?? 0;
$event = App::resolve(Event::class)->fetchEventById($id);

view(
    "guest/event.view.php",
    compact('event')
);
