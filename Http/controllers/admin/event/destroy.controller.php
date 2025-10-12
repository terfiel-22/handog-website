<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Models\Event;

$event = App::resolve(Event::class)->fetchEventById($_POST["item_id"]);

// Delete Image Files 
App::resolve(FileUploadHandler::class)->deleteFile($event["image"]);

App::resolve(Event::class)->deleteEvent($event["id"]);

redirect("/admin/events");
