<?php

dd($_POST);

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\GalleryImageForm;
use Http\Models\GalleryImage;

$_POST["image"] = $_FILES["images"]["name"][0];
GalleryImageForm::validate($_POST);
unset($_POST["image"]);

$fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];

App::resolve(GalleryImage::class)->createGalleryImage([
    "name" => $_POST["name"],
    "description" => $_POST["description"],
    "image" => reset($fileuploadResult)
]);

redirect("/admin/gallery");
