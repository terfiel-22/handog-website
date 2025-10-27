<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;

$facilities = App::resolve(Facility::class)->fetchFacilities();
$errors = Session::get('errors', []);

view(
    "admin/promo/create.view.php",
    compact('errors', 'facilities')
);
