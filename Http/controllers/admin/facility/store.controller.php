<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\FacilityForm;

// Add the first image name on images.
$_POST["image"] = $_FILES["images"]["name"][0];

// FacilityForm::validate($_POST);

$result = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images']);
dd($result);
