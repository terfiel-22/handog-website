<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Models\Facility;

$facility = App::resolve(Facility::class)->fetchSingleFacilityWithImagesById($_POST["item_id"]);

// Delete Image Files
$images = explode(',', $facility["images"]);
foreach ($images as $image) {
    App::resolve(FileUploadHandler::class)->deleteFile($image);
}

App::resolve(Facility::class)->deleteFacility($facility["id"]);

redirect("/admin/facilities");
