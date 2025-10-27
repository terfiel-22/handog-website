<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Promo;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$promo = App::resolve(Promo::class)->fetchPromoById($id);
$promo["facilities"] = explode(',', $promo["facilities"]);
$facilities = App::resolve(Facility::class)->fetchFacilities();

view(
    "admin/promo/edit.view.php",
    compact('promo', 'facilities', 'errors')
);
