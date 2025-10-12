<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\EventForm;
use Http\Models\Event;

// Check if gallery image exists
$origEvent = App::resolve(Event::class)->fetchEventById($_POST["id"]);

// Add image
$existing = json_decode($_POST['existing_images'], true);
$_POST["image"] = $existing[0] ?? $_FILES["images"]["name"][0];

// Validate Form
EventForm::validate($_POST);

// Handle new upload image
$existingImage = json_decode($_POST["existing_images"]);
if (reset($existingImage) != $_POST["image"]) {
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];
    $_POST["image"] = reset($fileuploadResult);

    // Delete old image
    App::resolve(FileUploadHandler::class)->deleteFile($origEvent["image"]);
} else {
    $_POST["image"] = $origEvent["image"];
}

/** START Update Event Data on Database **/
unset($_POST["_method"]);
unset($_POST["existing_images"]);
App::resolve(Event::class)->updateEvent($origEvent["id"], $_POST);
/** END Update Event Data on Database **/

redirect("/admin/events");
