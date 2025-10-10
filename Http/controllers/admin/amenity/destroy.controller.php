<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Models\Amenity;

$amenity = App::resolve(Amenity::class)->fetchSingleAmenityWithImagesById($_POST["item_id"]);

// Delete Image Files
$images = explode(',', $amenity["images"]);
foreach ($images as $image) {
    App::resolve(FileUploadHandler::class)->deleteFile($image);
}

App::resolve(Amenity::class)->deleteAmenity($amenity["id"]);

redirect("/admin/amenities");
