<?php

use Http\Forms\AmenityForm;

$_POST["image"] = $_FILES["images"]["name"][0];
AmenityForm::validate($_POST);
unset($_POST["image"]);

dd($_POST);
