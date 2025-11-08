<?php

use Core\App;
use Http\Forms\PromoForm;
use Http\Models\Promo;
use Http\Models\PromoFacility;

PromoForm::validate($_POST);

$facilities = $_POST["facilities"];
unset($_POST["facilities"]);
$promo_id = App::resolve(Promo::class)->createPromo($_POST);

foreach ($facilities as $facility_id) {
    App::resolve(PromoFacility::class)->createPromoFacility(compact('promo_id', 'facility_id'));
}

redirect("/admin/promos");
