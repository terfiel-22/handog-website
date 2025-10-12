<?php



use Core\App;
use Core\FileUploadHandler;
use Http\Forms\EventForm;
use Http\Models\Event;

$_POST["image"] = $_FILES["images"]["name"][0];
EventForm::validate($_POST);
unset($_POST["image"]);

$fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];

App::resolve(Event::class)->createEvent([
    "name" => $_POST["name"],
    "description" => $_POST["description"],
    "date" => $_POST["date"],
    "image" => reset($fileuploadResult)
]);

redirect("/admin/events");
