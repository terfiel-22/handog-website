<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\LogoForm;
use Http\Models\Logo;


$existingImage = json_decode($_POST['existing_images'], true);
$_POST["image"] = $existingImage[0] ?? $_FILES["images"]["name"][0];

// Validate form and image size
$logoForm = LogoForm::validate($_POST);
if (isset($_FILES['images']) && $_FILES['images']['error'][0] === 0) {
    $tmpFilePath = $_FILES['images']['tmp_name'][0];

    $imageInfo = getimagesize($tmpFilePath);

    if ($imageInfo) {
        $width = $imageInfo[0];
        $height = $imageInfo[1];

        if ($width > MAX_IMAGE_WIDTH || $height > MAX_IMAGE_HEIGHT) {
            $logoForm->error(
                "image",
                "Image dimensions exceed the allowed size (" . MAX_IMAGE_WIDTH . "x" . MAX_IMAGE_HEIGHT . ")."
            )->throw();
        }
    } else {
        $logoForm->error(
            "image",
            "Unable to get image dimensions."
        )->throw();
    }
} else {
    $logoForm->error(
        "image",
        "No file uploaded or upload error."
    )->throw();
}

// Get original logo
$origLogo = App::resolve(Logo::class)->fetchLogoById($_POST["id"]);

// Upload Image
if (reset($existingImage) != $_POST["image"]) {
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];
    $_POST["image"] = reset($fileuploadResult);
} else {
    $_POST["image"] = $origLogo["image"];
}

unset($_POST["_method"]);
unset($_POST["existing_images"]);
if ($origLogo) {
    // Update Logo
    App::resolve(Logo::class)->updateLogo($_POST);

    // Delete old image
    App::resolve(FileUploadHandler::class)->deleteFile($origLogo["image"]);
} else {
    // Create New
    unset($_POST["id"]);
    App::resolve(Logo::class)->createLogo($_POST);
}

redirect('/admin/settings/logo');
