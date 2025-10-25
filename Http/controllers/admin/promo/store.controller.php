<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\AmenityForm;
use Http\Models\Amenity;
use Http\Models\AmenityImage;

// Add the first image name on images.
$_POST["image"] = $_FILES["images"]["name"][0];

// Validate Form
AmenityForm::validate($_POST);
unset($_POST["image"]);

/** START Add Amenity Data on Database **/
$amenityId = App::resolve(Amenity::class)->createAmenity($_POST);
/** END Add Amenity Data on Database **/

/** START Upload the files and save to database. */
$fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];
foreach ($fileuploadResult as $image) {
    $amenityImage = [
        "amenity_id" => $amenityId,
        "image" => $image
    ];

    App::resolve(AmenityImage::class)->createAmenityImage($amenityImage);
}
/** END Upload the files and save to database. */

redirect("/admin/amenities");
