<?php

use Core\App;
use Http\Models\Promo;

$promo = App::resolve(Promo::class)->fetchPromoById($_POST["item_id"]);

App::resolve(Promo::class)->deletePromo($promo["id"]);

redirect("/admin/promos");
