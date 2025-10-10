<?php

use Core\App;
use Http\Forms\FacilityForm;
use Http\Models\Facility;

// Check if facility exists
$origFacility = App::resolve(Facility::class)->fetchSingleFacilityWithImagesById($_POST["id"]);

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


/** START Handle Uploaded and Existing Images */
$isAddedNewImage = !empty($_FILES['images']['name'][0]);
if ($isAddedNewImage && empty($existing)) {
    // User replaced all images.
} else {
    // User kept all existing images.
}
/** END Handle Uploaded and Existing Images */


dd($_POST);

redirect("/admin/facilities");
