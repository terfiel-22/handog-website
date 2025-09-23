<?php

// Add the first image name on images.

use Http\Forms\FacilityForm;

$_POST["image"] = $_FILES["images"]["name"][0];

FacilityForm::validate($_POST);

dd($_POST["image"]);
