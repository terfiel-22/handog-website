<?php

use Core\App;
use Core\Session;
use Http\Models\Faq;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$event = App::resolve(Faq::class)->fetchFaqById($id);
$readableImagePaths[] = handleImage($event["image"]);

view(
    "admin/event/edit.view.php",
    compact('event', 'readableImagePaths', 'errors')
);
