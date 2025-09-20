<?php

// TODO: Add Validation Before Adding to Database

use Core\App;
use Http\Models\EntranceRates;

App::resolve(EntranceRates::class)->createEntranceRates($_POST);

redirect("/admin/settings/entrance-rates");
