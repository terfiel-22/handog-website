<?php

// TODO: Add Validation Before Adding to Database

use Core\App;
use Http\Models\EntranceRates;

$_POST["senior_pwd_discount"] = $_POST["senior_pwd_discount"] / 100;

App::resolve(EntranceRates::class)->createEntranceRates($_POST);

redirect("/admin/settings/entrance-rates");
