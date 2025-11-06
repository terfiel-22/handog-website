<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\LogoForm;
use Http\Models\Logo;

// Get current logo and icon
$existingLogo = json_decode($_POST['existing_logo'], true);
$existingIcon = json_decode($_POST['existing_icon'], true);

// Pass to $_POST
$_POST["logo"] = $existingLogo[0] ?? $_FILES["logo"]["name"][0];
$_POST["icon"] = $existingIcon[0] ?? $_FILES["icon"]["name"][0];

// Validate form and image size
$logoForm = LogoForm::validate($_POST);

// Validate logo
if (isset($_FILES['logo']) && $_FILES['logo']['error'][0] === 0) {
    $tmpFilePath = $_FILES['logo']['tmp_name'][0];

    $imageInfo = getimagesize($tmpFilePath);

    if ($imageInfo) {
        $width = $imageInfo[0];
        $height = $imageInfo[1];

        if ($width > MAX_LOGO_WIDTH || $height > MAX_LOGO_HEIGHT) {
            $logoForm->error(
                "logo",
                "Image dimensions exceed the allowed size (" . MAX_LOGO_WIDTH . "x" . MAX_LOGO_HEIGHT . ")."
            )->throw();
        }

        if ($width < LOGO_WIDTH || $height < LOGO_HEIGHT) {
            $logoForm->error(
                "logo",
                "Image dimensions should atleast the allowed size (" . LOGO_WIDTH . "x" . LOGO_HEIGHT . ")."
            )->throw();
        }
    } else {
        $logoForm->error(
            "logo",
            "Unable to get logo dimensions."
        )->throw();
    }
}

// Validate icon
if (isset($_FILES['icon']) && $_FILES['icon']['error'][0] === 0) {
    $tmpFilePath = $_FILES['icon']['tmp_name'][0];

    $imageInfo = getimagesize($tmpFilePath);

    if ($imageInfo) {
        $width = $imageInfo[0];
        $height = $imageInfo[1];

        if ($width > MAX_ICON_WIDTH || $height > MAX_ICON_HEIGHT) {
            $logoForm->error(
                "icon",
                "Image dimensions exceed the allowed size (" . MAX_ICON_WIDTH . "x" . MAX_ICON_HEIGHT . ")."
            )->throw();
        }

        if ($width < ICON_WIDTH || $height < ICON_HEIGHT) {
            $logoForm->error(
                "icon",
                "Image dimensions should atleast the allowed size (" . ICON_WIDTH . "x" . ICON_HEIGHT . ")."
            )->throw();
        }
    } else {
        $logoForm->error(
            "icon",
            "Unable to get icon dimensions."
        )->throw();
    }
}

// Get original logo
$origLogo = App::resolve(Logo::class)->fetchLogoById($_POST["id"]);

// Upload Logo
if (reset($existingLogo) != $_POST["logo"]) {
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['logo'])["success"];
    $_POST["logo"] = reset($fileuploadResult);
} else {
    $_POST["logo"] = $origLogo["logo"];
}

// Upload Icon
if (reset($existingIcon) != $_POST["icon"]) {
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['icon'])["success"];
    $_POST["icon"] = reset($fileuploadResult);
} else {
    $_POST["icon"] = $origLogo["icon"];
}

unset($_POST["_method"]);
unset($_POST["existing_logo"]);
unset($_POST["existing_icon"]);

if ($origLogo) {
    // Delete old image
    if ($origLogo['logo'] != $_POST['logo'])
        App::resolve(FileUploadHandler::class)->deleteFile($origLogo["logo"]);
    if ($origLogo['icon'] != $_POST['icon'])
        App::resolve(FileUploadHandler::class)->deleteFile($origLogo["icon"]);

    // Update Logo
    App::resolve(Logo::class)->updateLogo($_POST);
} else {
    // Create New
    unset($_POST["id"]);
    App::resolve(Logo::class)->createLogo($_POST);
}

redirect('/admin/settings/logo');
