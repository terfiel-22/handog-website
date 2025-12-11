<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\FacilityForm;
use Http\Models\Facility;
use Http\Models\FacilityImage;

// Add the first image name on images.
$_POST["image"] = $_FILES["images"]["name"][0];

// Validate Form
FacilityForm::validate($_POST);
unset($_POST["image"]);

dd($_POST);
/** START Add Facility Data on Database **/
$facilityId = App::resolve(Facility::class)->createFacility($_POST);
/** END Add Facility Data on Database **/

/** START Upload the files and save to database. */
$fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];
foreach ($fileuploadResult as $image) {
    $facilityImage = [
        "facility_id" => $facilityId,
        "image" => $image
    ];

    App::resolve(FacilityImage::class)->createFacilityImage($facilityImage);
}
/** END Upload the files and save to database. */

redirect("/admin/facilities");
