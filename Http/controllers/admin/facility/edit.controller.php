<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$facility = App::resolve(Facility::class)->fetchSingleFacilityWithImagesById($id);

$images = explode(',', $facility["images"]);
$readableImagePaths = [];
foreach ($images as $image) {
    $readableImagePaths[] = handleImage($image);
}

view(
    "admin/facility/edit.view.php",
    compact('facility', 'readableImagePaths', 'errors')
);
