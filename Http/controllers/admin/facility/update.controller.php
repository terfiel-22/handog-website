<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\FacilityForm;
use Http\Models\Facility;
use Http\Models\FacilityImage;

// Check if facility exists
$origFacility = App::resolve(Facility::class)->fetchSingleFacilityWithImagesById($_POST["id"]);
$origFacilityImages = explode(',', $origFacility["images"]);

// Add image
$existing = json_decode($_POST['existing_images'], true);
$_POST["image"] = $existing[0] ?? $_FILES["images"]["name"][0];

// Validate Form
FacilityForm::validate($_POST);

/** START Update Facility Data on Database **/
unset($_POST["_method"]);
unset($_POST["existing_images"]);
unset($_POST["image"]);
App::resolve(Facility::class)->updateFacility($origFacility["id"], $_POST);
/** END Update Facility Data on Database **/


/** START Handle Uploaded New Images */
$isAddedNewImage = !empty($_FILES['images']['name'][0]);
if ($isAddedNewImage && empty($existing)) {
    // Add new uploaded images
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];
    foreach ($fileuploadResult as $image) {
        $facilityImage = [
            "facility_id" => $_POST["id"],
            "image" => $image
        ];

        App::resolve(FacilityImage::class)->createFacilityImage($facilityImage);
    }

    // Remove old images
    foreach ($origFacilityImages as $oldImage) {
        App::resolve(FileUploadHandler::class)->deleteFile($oldImage);
        App::resolve(FacilityImage::class)->deleteFacilityImageByPath($oldImage);
    }
}
/** END Handle Uploaded New Images */


redirect("/admin/facilities");
