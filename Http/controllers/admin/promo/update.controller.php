<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\AmenityForm;
use Http\Models\Amenity;
use Http\Models\AmenityImage;

// Check if amenity exists
$origAmenity = App::resolve(Amenity::class)->fetchSingleAmenityWithImagesById($_POST["id"]);
$origAmenityImages = explode(',', $origAmenity["images"]);

// Add image
$existing = json_decode($_POST['existing_images'], true);
$_POST["image"] = $existing[0] ?? $_FILES["images"]["name"][0];

// Validate Form
AmenityForm::validate($_POST);


/** START Update Amenity Data on Database **/
unset($_POST["_method"]);
unset($_POST["existing_images"]);
unset($_POST["image"]);
App::resolve(Amenity::class)->updateAmenity($origAmenity["id"], $_POST);
/** END Update Amenity Data on Database **/

/** START Handle Uploaded New Images */
$isAddedNewImage = !empty($_FILES['images']['name'][0]);
if ($isAddedNewImage && empty($existing)) {
    // Add new uploaded images
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];
    foreach ($fileuploadResult as $image) {
        $amenityImage = [
            "amenity_id" => $_POST["id"],
            "image" => $image
        ];

        App::resolve(AmenityImage::class)->createAmenityImage($amenityImage);
    }

    // Remove old images
    foreach ($origAmenityImages as $oldImage) {
        App::resolve(FileUploadHandler::class)->deleteFile($oldImage);
        App::resolve(AmenityImage::class)->deleteAmenityImageByPath($oldImage);
    }
}
/** END Handle Uploaded New Images */


redirect("/admin/amenities");
