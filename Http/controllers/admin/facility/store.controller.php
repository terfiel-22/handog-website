<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Enums\FacilityRateTimeRange;
use Http\Forms\FacilityForm;
use Http\Models\Facility;
use Http\Models\FacilityImage;
use Http\Models\FacilityRates;

// Add the first image name on images.
$_POST["image"] = $_FILES["images"]["name"][0];

// Validate Form
FacilityForm::validate($_POST);

/** START Add Facility Data on Database **/
$newFacility = [
    "name" => $_POST["name"],
    "type" => $_POST["type"],
    "description" => $_POST["description"],
    "capacity" => $_POST["capacity"],
    "amenities" => $_POST["amenities"],
];
$facilityId = App::resolve(Facility::class)->createFacility($newFacility);
/** END Add Facility Data on Database **/

/** START Add Rates to Database **/
if (!empty($_POST["hourly_rate"])) {
    $hourlyRateData = [
        "facility_id" =>  $facilityId,
        "rate" =>  $_POST["hourly_rate"],
        "time_range" =>  FacilityRateTimeRange::HOURLY
    ];
    App::resolve(FacilityRates::class)->createFacilityRate($hourlyRateData);
}
if (!empty($_POST["8h_rate"])) {
    $per8HRateData = [
        "facility_id" =>  $facilityId,
        "rate" =>  $_POST["8h_rate"],
        "time_range" =>  FacilityRateTimeRange::PER_8_HOURS
    ];
    App::resolve(FacilityRates::class)->createFacilityRate($per8HRateData);
}
if (!empty($_POST["12h_rate"])) {
    $per12HRateData = [
        "facility_id" =>  $facilityId,
        "rate" =>  $_POST["12h_rate"],
        "time_range" =>  FacilityRateTimeRange::PER_12_HOURS
    ];
    App::resolve(FacilityRates::class)->createFacilityRate($per12HRateData);
}
if (!empty($_POST["1d_rate"])) {
    $per1DRateData = [
        "facility_id" =>  $facilityId,
        "rate" =>  $_POST["1d_rate"],
        "time_range" =>  FacilityRateTimeRange::PER_1_DAY
    ];
    App::resolve(FacilityRates::class)->createFacilityRate($per1DRateData);
}
/** END Add Rates to Database **/

// Upload the files and save to database.
$fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];
foreach ($fileuploadResult as $image) {
    $facilityImage = [
        "facility_id" => $facilityId,
        "image" => $image
    ];

    App::resolve(FacilityImage::class)->createFacilityImage($facilityImage);
}

redirect("/admin/facilities");
