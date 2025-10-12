<?php

use Core\App;
use Http\Models\Event;

$id = $_GET["id"] ?? 0;
$event = App::resolve(Event::class)->fetchEventById($id);
$upcomingEvents = App::resolve(Event::class)->fetchUpcomingEvents();

view(
    "guest/event.view.php",
    compact('event', 'upcomingEvents')
);
