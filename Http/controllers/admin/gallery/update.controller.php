<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\GalleryImageForm;
use Http\Models\GalleryImage;

// Check if gallery image exists
$origGalleryImage = App::resolve(GalleryImage::class)->fetchGalleryImageById($_POST["id"]);

// Add image
$existing = json_decode($_POST['existing_images'], true);
$_POST["image"] = $existing[0] ?? $_FILES["images"]["name"][0];

// Validate Form
GalleryImageForm::validate($_POST);

// Handle new upload image
$existingImage = json_decode($_POST["existing_images"]);
if (reset($existingImage) != $_POST["image"]) {
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];
    $_POST["image"] = reset($fileuploadResult);

    // Delete old image
    App::resolve(FileUploadHandler::class)->deleteFile($origGalleryImage["image"]);
} else {
    $_POST["image"] = $origGalleryImage["image"];
}

/** START Update GalleryImage Data on Database **/
unset($_POST["_method"]);
unset($_POST["existing_images"]);
App::resolve(GalleryImage::class)->updateGalleryImage($origGalleryImage["id"], $_POST);
/** END Update GalleryImage Data on Database **/

redirect("/admin/gallery");
