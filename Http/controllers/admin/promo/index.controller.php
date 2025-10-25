<?php

use Core\App;
use Http\Models\Promo;

$promos = App::resolve(Promo::class)->fetchPromos();

view(
    "admin/promo/index.view.php",
    compact('promos')
);
