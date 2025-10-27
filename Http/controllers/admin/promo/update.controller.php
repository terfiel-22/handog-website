<?php

use Core\App;
use Http\Forms\PromoForm;
use Http\Models\Promo;
use Http\Models\PromoFacility;

$origPromo = App::resolve(Promo::class)->fetchPromoById($_POST["id"]);
PromoForm::validate($_POST);
$facilities = $_POST["facilities"];
unset($_POST["facilities"]);
unset($_POST["_method"]);

$promo_id = $origPromo["id"];

App::resolve(Promo::class)->updatePromo($promo_id, $_POST);

App::resolve(PromoFacility::class)->deletePromoFacility($promo_id);

foreach ($facilities as $facility_id) {
    App::resolve(PromoFacility::class)->createPromoFacility(compact('promo_id', 'facility_id'));
}

redirect("/admin/promos");
