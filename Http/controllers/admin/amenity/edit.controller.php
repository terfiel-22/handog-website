<?php

use Core\App;
use Core\Session;
use Http\Models\Amenity;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$amenity = App::resolve(Amenity::class)->fetchSingleAmenityWithImagesById($id);
$images = explode(',', $amenity["images"]);
$readableImagePaths = [];
foreach ($images as $image) {
    $readableImagePaths[] = handleFilePath($image);
}

view(
    "admin/amenity/edit.view.php",
    compact('amenity', 'readableImagePaths', 'errors')
);
