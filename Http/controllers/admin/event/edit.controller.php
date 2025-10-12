<?php

use Core\App;
use Core\Session;
use Http\Models\Event;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$event = App::resolve(Event::class)->fetchEventById($id);
$readableImagePaths[] = handleImage($event["image"]);

view(
    "admin/event/edit.view.php",
    compact('event', 'readableImagePaths', 'errors')
);
